<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GrowController extends Controller
{
    /**
     * Exibe a página inicial
     */
    public function home()
    {
        $featuredProducts = Product::where('is_featured', true)
            ->orWhere('sold_amount', '>', 0)
            ->orderBy('sold_amount', 'DESC')
            ->take(4)
            ->get();
            
        $categories = Category::all();
            
        return view('grow.home', [
            'featuredProducts' => $featuredProducts,
            'categories' => $categories
        ]);
    }

    /**
     * Exibe todos os produtos
     */
    public function products(Request $request)
    {
        $query = Product::query();
        
        // Filtragem por categoria
        if ($request->has('categoria')) {
            $query->where('type_id', $request->categoria);
        }
        
        // Ordenação
        if ($request->has('ordem')) {
            switch ($request->ordem) {
                case 'preco-asc':
                    $query->orderBy('price', 'ASC');
                    break;
                case 'preco-desc':
                    $query->orderBy('price', 'DESC');
                    break;
                case 'nome-asc':
                    $query->orderBy('name', 'ASC');
                    break;
                case 'nome-desc':
                    $query->orderBy('name', 'DESC');
                    break;
                default:
                    $query->orderBy('sold_amount', 'DESC');
                    break;
            }
        } else {
            $query->orderBy('sold_amount', 'DESC');
        }
        
        $products = $query->paginate(12);
        $categories = Category::all();
        
        return view('grow.products', [
            'products' => $products,
            'categories' => $categories
        ]);
    }

    /**
     * Exibe detalhes de um produto específico
     */
    public function showProduct($id)
    {
        $product = Product::findOrFail($id);
        
        // Carregar o tipo corretamente caso exista
        if ($product->type_id) {
            $product->load('type');
        }
        
        $relatedProducts = Product::where('type_id', $product->type_id)
            ->where('id', '!=', $product->id)
            ->take(4)
            ->get();
            
        return view('grow.product-detail', [
            'product' => $product,
            'relatedProducts' => $relatedProducts
        ]);
    }

    /**
     * Exibe a página Sobre Nós
     */
    public function about()
    {
        return view('grow.about');
    }

    /**
     * Exibe a página de Contato
     */
    public function contact()
    {
        return view('grow.contact');
    }

    /**
     * Processa o formulário de contato
     */
    public function submitContact(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email',
            'phone' => 'nullable',
            'message' => 'required|min:10'
        ]);
        
        // Aqui poderíamos enviar e-mail, salvar no banco, etc.
        
        return redirect()->back()->with('success', 'Mensagem enviada com sucesso!');
    }

    /**
     * Exibe o carrinho de compras
     */
    public function cart()
    {
        $cart = session()->get('cart', []);
        
        // Corrigir itens sem a chave 'id'
        foreach ($cart as $product_id => $item) {
            if (!isset($item['id'])) {
                $cart[$product_id]['id'] = $product_id;
            }
        }
        
        // Atualizar a sessão com os itens corrigidos
        session()->put('cart', $cart);
        
        return view('grow.cart', compact('cart'));
    }

    /**
     * Adiciona um produto ao carrinho
     */
    public function addToCart(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1'
        ]);
        
        $product = Product::findOrFail($request->product_id);
        $cart = session()->get('cart', []);
        
        // Se o produto já existe no carrinho, atualize a quantidade
        if(isset($cart[$request->product_id])) {
            $cart[$request->product_id]['quantity'] += $request->quantity;
        } else {
            $cart[$request->product_id] = [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => $request->quantity,
                'image' => $product->image
            ];
        }
        
        session()->put('cart', $cart);
        
        return redirect()->back()->with('success', 'Produto adicionado ao carrinho!');
    }

    /**
     * Remove um produto do carrinho
     */
    public function removeFromCart(Request $request)
    {
        if($request->product_id) {
            $cart = session()->get('cart');
            if(isset($cart[$request->product_id])) {
                unset($cart[$request->product_id]);
                session()->put('cart', $cart);
            }
        }
        
        return redirect()->back();
    }

    /**
     * Exibe a página de checkout
     */
    public function checkout()
    {
        $cart = session()->get('cart', []);
        
        if(empty($cart)) {
            return redirect()->route('grow.cart')->with('error', 'Seu carrinho está vazio');
        }
        
        // Verifica se há um usuário logado
        $userData = null;
        $userAddress = null;
        $userAddresses = [];
        
        if (Auth::check()) {
            $user = Auth::user();
            $userData = [
                'first_name' => $user->firstName,
                'last_name' => $user->lastName,
                'email' => $user->email
            ];
            
            // Obtém o endereço padrão do usuário (se houver)
            $userAddress = $user->addresses()->where('default', 1)->first();
            
            // Obtém todos os endereços do usuário
            $userAddresses = $user->addresses()->get();
        }
        
        return view('grow.checkout', [
            'cart' => $cart,
            'userData' => $userData,
            'userAddress' => $userAddress,
            'userAddresses' => $userAddresses
        ]);
    }

    /**
     * Atualiza quantidade de um produto no carrinho
     */
    public function updateCart(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1'
        ]);
        
        $cart = session()->get('cart', []);
        
        if(isset($cart[$request->product_id])) {
            $cart[$request->product_id]['quantity'] = $request->quantity;
            session()->put('cart', $cart);
        }
        
        return redirect()->back()->with('success', 'Carrinho atualizado!');
    }

    /**
     * Exibe a página de login
     */
    public function login()
    {
        return view('grow.login');
    }

    /**
     * Exibe a página de cadastro
     */
    public function register()
    {
        return view('grow.register');
    }

    public function verifyEmail()
    {
        return view('grow.verify-email');
    }

    /**
     * Exibe a página de esqueci minha senha
     */
    public function forgotPassword()
    {
        return view('grow.forgot-password');
    }

    public function processCheckout(Request $request)
    {
        // Debug para garantir que este método está sendo chamado corretamente
        \Illuminate\Support\Facades\Log::info('processCheckout - Iniciado', [
            'dados' => $request->all(),
            'método' => $request->method(),
            'url' => $request->url()
        ]);
        
        // Validar os dados do formulário
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string',
            'payment_method' => 'required|string',
            // Verificamos se um endereço existente foi selecionado ou se um novo endereço está sendo informado
            'address_id' => 'required_without:cep',
            'cep' => 'required_without:address_id',
            'address' => 'required_without:address_id',
            'number' => 'required_without:address_id',
            'neighborhood' => 'required_without:address_id',
            'city' => 'required_without:address_id',
            'state' => 'required_without:address_id',
        ]);

        // Obter carrinho da sessão
        $cart = session('cart', []);
        if (empty($cart)) {
            return redirect()->route('grow.cart')->with('error', 'Seu carrinho está vazio.');
        }

        // Armazenar os dados de pedido na sessão para uso posterior
        session(['checkout_data' => $validatedData]);
        
        \Illuminate\Support\Facades\Log::info('processCheckout - Dados validados e método de pagamento:', [
            'payment_method' => $validatedData['payment_method']
        ]);

        // Processar de acordo com o método de pagamento
        if ($validatedData['payment_method'] === 'stripe') {
            \Illuminate\Support\Facades\Log::info('processCheckout - Redirecionando para finalizar compra', [
                'redirecionando_para' => '/criar-pedido'
            ]);
            return redirect('/criar-pedido')->withInput();
        } elseif ($validatedData['payment_method'] === 'pix') {
            \Illuminate\Support\Facades\Log::info('processCheckout - Redirecionando para finalizar compra (PIX)', [
                'redirecionando_para' => '/criar-pedido'
            ]);
            return redirect('/criar-pedido')->withInput();
        } elseif ($validatedData['payment_method'] === 'boleto') {
            \Illuminate\Support\Facades\Log::info('processCheckout - Redirecionando para finalizar compra (Boleto)', [
                'redirecionando_para' => '/criar-pedido'
            ]);
            return redirect('/criar-pedido')->withInput();
        }

        return back()->with('error', 'Método de pagamento inválido.');
    }
} 