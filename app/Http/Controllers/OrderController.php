<?php

namespace App\Http\Controllers;

use Omnipay\Omnipay;
use App\Models\Color;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Srmklive\PayPal\Services\PayPal;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class OrderController extends Controller
{
    function calculateTotal()
    {
        $total_price = 0;
        $total_quantity = 0;

        foreach (Session::get('products') as $product) {
            $price = $product['price'];
            $quantity = $product['quantity'];
            $total_price = $total_price + ($price * $quantity);
            $total_quantity = $total_quantity + $quantity;
        }

        if (!Session::has('adresses') || Session::get('adresses')['postalCode'] ==  '') {

            Session::forget('shipping_cost');
        }

        Session::put('total_price', $total_price);
        Session::put('total_price', $total_price);
        Session::put('total_price_w_coupon', $total_price);
        Session::put('total_quantity', $total_quantity);
        Session::put('discount_value', '');


        if (Session::has('shipping_cost') && Session::has('discount_value')) {
            Session::put('full_price', $total_price + (float)Session::get('shipping_cost') + (float)Session::get('discount_value'));
        } else if (Session::has('shipping_cost') && Session::get('discount_value') == '') {
            Session::put('full_price', $total_price + (float)Session::get('shipping_cost'));
        } else if (!Session::has('shipping_cost') && Session::get('discount_value') != '') {
            Session::put('full_price', $total_price  + (float)Session::get('discount_value'));
        } else {
            Session::put('full_price', $total_price);
        }
    }

    public function addToCart(Request $request, Product $product)
    {
        $incomingFields = $request->validate([
            'productId' => 'required',
            'quantity' => 'required',
            'color' => 'required',
            'flower_type' => 'required',
        ]);
    
        $incomingFields['print_type'] = $request->input('print_type');
        $incomingFields['print_text'] = $request->input('print_text');
        $incomingFields['print_font'] = $request->input('print_font');
        $incomingFields['print_color'] = $request->input('print_color');
        $incomingFields['productform'] = $request->input('productform');
    
        if ($incomingFields['print_type'] == "picture") {
            $incomingFields['print_image'] = $request['print_image'];
            $manager = new ImageManager(new Driver());
            $filename = $request->file('print_image')->getClientOriginalName();
            $imageData = $manager->read($incomingFields['print_image'])->encode();
            Storage::put('/public/personalizeImages/' . $filename, $imageData);
    
            $incomingFields['print_image'] = $filename;
        } else {
            $incomingFields['print_image'] = null;
        }
    
        $product = Product::find($incomingFields['productId']);
    
        // Handle product image logic
        $sel_colors = '';
        $eachcolor = json_decode($product->eachcolor_image);
        foreach ($eachcolor as $value) {
            $sel_colors = $value;
        }
    
        $productInfo = [
            'id' => $product->id,
            'sku' => $product->SKU,
            'name' => $product->name,
            'price' => $product->price,
            'quantity' => $incomingFields['quantity'],
            'color' => $incomingFields['color'],
            'image' => $sel_colors,
            'print_type' => $incomingFields['print_type'],
            'print_text' => $incomingFields['print_text'],
            'print_color' => $incomingFields['print_color'],
            'print_font' => $incomingFields['print_font'],
            'flower_type' => $incomingFields['flower_type'],
            'productform' => $incomingFields['productform'],
            'print_image' => $incomingFields['print_image'] ?? null,
        ];
    
        // Check if an identical product already exists in the cart
        $cart = $request->session()->get('products', []);
        $existingItemKey = null;
    
        foreach ($cart as $key => $item) {
            if (
                $item['sku'] === $productInfo['sku'] &&
                $item['color'] === $productInfo['color'] &&
                $item['print_type'] === $productInfo['print_type'] &&
                $item['print_text'] === $productInfo['print_text'] &&
                $item['print_color'] === $productInfo['print_color'] &&
                $item['print_font'] === $productInfo['print_font'] &&
                $item['flower_type'] === $productInfo['flower_type'] &&
                $item['print_image'] === $productInfo['print_image']
            ) {
                $existingItemKey = $key;
                break;
            }
        }
    
        if ($existingItemKey !== null) {
            // Update quantity if item already exists
            $cart[$existingItemKey]['quantity'] += $productInfo['quantity'];
        } else {
            // Add as a new item
            $cart[] = $productInfo;
        }
    
        $request->session()->put('products', $cart);
    
        // Stripe Content for Checkout
        $stripeContent = [
            [
                'price_data' => [
                    'product_data' => [
                        'name' => "Rose payment",
                    ],
                    'unit_amount' => 100 * Session::get('total_price'),
                    'currency' => 'AUD',
                ],
                'quantity' => 1,
            ]
        ];
    
        $request->session()->put('line_items', $stripeContent);
    
        $this->calculateTotal();
        return redirect('/cart');
    }
    

    public function removeFromCart(Request $request)
    {
        // Obtenha os produtos atuais da sessão
        $products = Session::get('products', []);
    
        // Parâmetros para identificar o produto
        $id = $request->query('id');
        $color = $request->query('color');
        $print_type = $request->query('print_type');
        $print_text = $request->query('print_text');
        $print_color = $request->query('print_color');
        $print_font = $request->query('print_font');
        $print_image = $request->query('print_image');
    
        // Filtrar produtos que NÃO correspondem ao item a ser removido
        $updatedProducts = array_filter($products, function ($product) use ($id, $color, $print_type, $print_text, $print_color, $print_font, $print_image) {
            return !(
                $product['id'] == $id &&
                $product['color'] === $color &&
                $product['print_type'] === $print_type &&
                $product['print_text'] === $print_text &&
                $product['print_color'] === $print_color &&
                $product['print_font'] === $print_font &&
                $product['print_image'] === $print_image
            );
        });
    
        // Reindexar o array
        $updatedProducts = array_values($updatedProducts);
    
        // Atualizar a sessão com os produtos restantes
        Session::put('products', $updatedProducts);
    
        // Recalcular o total
        $this->calculateTotal();
    
        return back();
    }
    


    public function showCheckout(Order $order)
    {

        //dd(Session::get('products'));
        $order = $order->find($order->id);
        if (Session::has('discount_code')) {
            $discount_code = Session::get('discount_code');
        } else {
            $discount_code = null;
        }

        if (Session::has('full_price')) {
            $full_price = Session::get('full_price');
        } else {
            $full_price = null;
        }

        $allFlowerTypes = array();

        $flowerTypes = Session::get('products');
        if ($flowerTypes != null) {
            foreach ($flowerTypes as $flowerType) {
                array_push($allFlowerTypes, $flowerType['flower_type']);
            }
        }
        

        $discount_value = Session::get('discount_value');
        if ($discount_value == '') {
        }

        return view('checkout', [
            'order' => $order,
            'full_price' => $full_price,
            'discount_code' => $discount_code,
            'discount_value' => $discount_value,
            'allFlowerTypes' => $allFlowerTypes
        ]);
    }


    public function createOrder(Request $request, Order $order)
    {
        $incomingFields = [
            'total_price' => Session::get('total_price'),
            'is_paid' => false,
            'shipping_id' => '',
            'is_delivered' => false,
            'status' => "Pending",
        ];
    
        if (auth()->check()) {
            $incomingFields['user_email'] = auth()->user()->email;
        }
    
        $newOrder = $order->create($incomingFields);
    
        foreach (session('products') as $item) {
            $product = Product::find($item['id']);
            $newOrder->products()->attach($product, [
                'quantity' => $item['quantity'],
                'print_type' => $item['print_type'],
                'print_text' => $item['print_text'],
                'print_color' => $item['print_color'],
                'print_font' => $item['print_font'],
                'print_image' => $item['print_image']
            ]);
        }
    
        $request->session()->put('orderId', $newOrder->id);
    
        // try {
        //     $this->createship();
        // } catch (\Exception $e) {
        //     // Lidar com falhas na criação do envio
        //     report($e);
        //     return redirect('/cart/checkout')->withErrors(['error' => 'Falha ao criar envio.']);
        // }
    
        return redirect('/cart/checkout/' . $newOrder->id);
    }
    
    

    public function resolveAccessToken()
    {
        $clientId = env('PAYPAL_SANDBOX_CLIENT_ID');
        $clientSecret = env('PAYPAL_SANDBOX_CLIENT_SECRET');
        $credentials = base64_encode("{$clientId}:{$clientSecret}");
        return "Basic {$credentials}";
    }

    public function decodeResponse($response)
    {
        return json_decode($response);
    }

    public function apiCreateOrder(Order $order)
    {
        $newOrder = $order->find(Session::get('orderId'));
        $createOrder = [
            'id' => Session::get('orderId'),
            'intent' => "CAPTURE",
            'payment_source' => uniqid(),
            'items' => Session::get('products'),
            'purchase_units' => [
                "reference_id" => "d9f8074",
                'amount' => [
                    'currency_code' => env('PAYMENT_CURRENCY'),
                    'value' => Session::get('total_price')
                ]
            ],
            "payment_source" => [
                "paypal" => [
                    "experience_context" => [
                        "payment_method_preference" => "IMMEDIATE_PAYMENT_REQUIRED",
                        "brand_name" => "EXAMPLE INC",
                        "locale" => "en-US",
                        "landing_page" => "/",
                        "shipping_preference" => "SET_PROVIDED_ADDRESS",
                        "user_action" => "PAY_NOW",
                        "return_url" => "/payment/success",
                        "cancel_url" => '/cart',
                    ]
                ]
            ],
            'currency' => env('PAYMENT_CURRENCY'),
            'description' => 'Order flower payment ' . Session::get('orderId'),
            'invoice_id' => $newOrder->id,
            'return_url' => url('/payment/success'),
            'cancel_url' => url('/cart')
        ];
        return response()->json($createOrder);
    }

    public function paymentConfirm(Request $request)
    {
        $response = $request->validate([
            'paymentToken' => 'required'
        ]);
        $paymentToken = $response['paymentToken'];

        $orderData = [];

        if ($request->input('paymentToken')) {
            $orderData = $response['paymentToken'];

            $order = Order::find(Session::get('orderId'));
            $order->update([
                'payment_method' => "Google Pay",
                'is_paid' => true,
                'paid_at' => Carbon::now()->toDateTimeString(),
                'status' => "Delivering",
            ]);

            Session::forget('orderId');
            Session::forget('products');
            Session::forget('total_quantity');
            Session::forget('total_price');
        } else {
            return "Payment is declined";
        }

        return response()->json(['id' => $order->id]);
    }


    public function showCartDetail()
    {
        return view('cart-detail');
    }

    public function showThanks()
    {
        return view('thankyou');
    }
    
}
