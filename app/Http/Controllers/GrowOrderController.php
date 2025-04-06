<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class GrowOrderController extends Controller
{
    /**
     * Cria um novo pedido a partir dos dados do checkout
     */
    public function createOrder(Request $request)
    {
        Log::info('GrowOrderController::createOrder - Iniciando criação de pedido', [
            'request_data' => $request->all(),
            'session_data' => session('checkout_data')
        ]);
        
        // Obter dados do checkout da sessão
        $checkoutData = session('checkout_data');
        
        // Se não tiver dados na sessão, tentar usar os dados do request
        if (!$checkoutData && $request->isMethod('post')) {
            Log::info('GrowOrderController::createOrder - Usando dados do request em vez da sessão');
            
            $checkoutData = $request->all();
            session(['checkout_data' => $checkoutData]);
        }
        
        if (!$checkoutData) {
            Log::error('GrowOrderController::createOrder - Dados de checkout não encontrados');
            return redirect()->route('grow.checkout')
                ->with('error', 'Dados de checkout não encontrados. Por favor, preencha o formulário novamente.');
        }

        // Obter carrinho da sessão
        $cart = session('cart', []);
        if (empty($cart)) {
            Log::error('GrowOrderController::createOrder - Carrinho vazio');
            return redirect()->route('grow.cart')
                ->with('error', 'Seu carrinho está vazio.');
        }

        // Calcular total do pedido
        $total = 0;
        foreach ($cart as $item) {
            if (isset($item['price']) && isset($item['quantity'])) {
                $total += $item['price'] * $item['quantity'];
            }
        }
        
        Log::info('GrowOrderController::createOrder - Total calculado', [
            'total' => $total,
            'cart' => $cart
        ]);

        // Criar o pedido
        $order = new Order();
        // Usar status para armazenar o número do pedido já que não existe coluna order_number
        $order->status = 'Pendente';
        $order->total_price = $total;
        $order->payment_method = $checkoutData['payment_method'];
        $order->is_paid = false;
        $order->is_delivered = false;
        
        // Associar e-mail do usuário
        if (Auth::check()) {
            $order->user_id = Auth::id();
            $order->user_email = Auth::user()->email;
        } else {
            $order->user_email = $checkoutData['email'];
        }
        
        // Salvar endereço de entrega
        if (isset($checkoutData['address_id']) && Auth::check()) {
            // Usar endereço existente
            $addressId = $checkoutData['address_id'];
            // Buscar o endereço diretamente pelo modelo Address
            $userAddress = \App\Models\Address::where('user_id', Auth::id())
                                              ->where('id', $addressId)
                                              ->first();
            
            if ($userAddress) {
                $order->shipping_address = json_encode([
                    'name' => $checkoutData['first_name'] . ' ' . $checkoutData['last_name'],
                    'company' => $userAddress->company,
                    'address' => $userAddress->address1,
                    'address2' => $userAddress->address2,
                    'city' => $userAddress->city,
                    'state' => $userAddress->country,
                    'postalCode' => $userAddress->postal,
                    'phone' => $checkoutData['phone'],
                    'email' => $checkoutData['email']
                ]);
            }
        } else {
            // Usar endereço do formulário
            $order->shipping_address = json_encode([
                'name' => $checkoutData['first_name'] . ' ' . $checkoutData['last_name'],
                'address' => $checkoutData['address'] . ', ' . $checkoutData['number'],
                'complement' => $checkoutData['complement'] ?? '',
                'neighborhood' => $checkoutData['neighborhood'] ?? '',
                'city' => $checkoutData['city'],
                'state' => $checkoutData['state'],
                'postalCode' => $checkoutData['cep'],
                'phone' => $checkoutData['phone'],
                'email' => $checkoutData['email']
            ]);
        }
        
        // Salvar o pedido
        $order->save();
        
        Log::info('GrowOrderController::createOrder - Pedido criado', ['order_id' => $order->id]);
        
        // Associar produtos ao pedido
        foreach ($cart as $item) {
            $product = Product::find($item['id']);
            if ($product) {
                // Associar produto ao pedido com dados adicionais
                $order->products()->attach($product->id, [
                    'quantity' => $item['quantity'],
                    'price' => $item['price']
                ]);
            }
        }
        
        // Guardar o ID do pedido na sessão para uso posterior
        session(['grow_order_id' => $order->id]);
        
        // Independente do método de pagamento, redirecionar para confirmação
        // No futuro, podemos implementar diferentes fluxos de pagamento
        return redirect()->route('grow.order-confirmation', ['order' => $order->id])
            ->with('success', 'Pedido registrado com sucesso!');
    }
    
    /**
     * Exibe a confirmação do pedido
     */
    public function showConfirmation($orderId)
    {
        $order = Order::findOrFail($orderId);
        
        // Verificar se o pedido pertence ao usuário logado ou se foi criado na sessão atual
        if (Auth::check() && $order->user_email !== Auth::user()->email && session('grow_order_id') != $orderId) {
            return redirect()->route('grow.home')
                ->with('error', 'Você não tem permissão para acessar este pedido.');
        }
        
        // Limpar o carrinho - garantir que seja limpo
        session()->forget('cart');
        session()->forget('checkout_data');
        session()->save(); // Forçar a gravação da sessão
        
        Log::info('GrowOrderController::showConfirmation - Pedido confirmado e carrinho limpo', ['order_id' => $order->id]);
        
        return view('grow.order-confirmation', [
            'order' => $order
        ]);
    }
    
    /**
     * Processa pagamento via PIX
     */
    public function processPix()
    {
        $orderId = session('grow_order_id');
        if (!$orderId) {
            return redirect()->route('grow.home')
                ->with('error', 'Pedido não encontrado.');
        }
        
        $order = Order::find($orderId);
        if (!$order) {
            return redirect()->route('grow.home')
                ->with('error', 'Pedido não encontrado.');
        }
        
        // Gerar QR Code PIX (simulado)
        $pixCode = 'PIX' . rand(1000000, 9999999);
        $order->payment_details = json_encode(['pix_code' => $pixCode]);
        $order->save();
        
        return view('grow.pix-payment', [
            'order' => $order,
            'pixCode' => $pixCode
        ]);
    }
    
    /**
     * Processa pagamento via Boleto
     */
    public function processBoleto()
    {
        $orderId = session('grow_order_id');
        if (!$orderId) {
            return redirect()->route('grow.home')
                ->with('error', 'Pedido não encontrado.');
        }
        
        $order = Order::find($orderId);
        if (!$order) {
            return redirect()->route('grow.home')
                ->with('error', 'Pedido não encontrado.');
        }
        
        // Gerar código de barras do boleto (simulado)
        $boletoCode = '34191.79001 01043.510047 91020.150008 9 88950026000';
        $order->payment_details = json_encode(['boleto_code' => $boletoCode]);
        $order->save();
        
        return view('grow.boleto-payment', [
            'order' => $order,
            'boletoCode' => $boletoCode
        ]);
    }
    
    /**
     * Lista todos os pedidos do usuário logado
     */
    public function listOrders()
    {
        if (!Auth::check()) {
            return redirect()->route('grow.login')
                ->with('error', 'Você precisa estar logado para acessar seus pedidos.');
        }
        
        $orders = Order::where('user_id', Auth::id())
                       ->orderBy('created_at', 'desc')
                       ->get();
        
        return view('grow.orders', [
            'orders' => $orders
        ]);
    }
    
    /**
     * Exibe os detalhes de um pedido específico
     */
    public function showOrder($orderId)
    {
        if (!Auth::check()) {
            return redirect()->route('grow.login')
                ->with('error', 'Você precisa estar logado para acessar seus pedidos.');
        }
        
        $order = Order::where('id', $orderId)
                      ->where('user_email', Auth::user()->email)
                      ->firstOrFail();
        
        return view('grow.order-detail', [
            'order' => $order
        ]);
    }
}
