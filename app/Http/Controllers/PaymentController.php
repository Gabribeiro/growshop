<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Epmnzava\Crdb\Crdb;
use Omnipay\Common\CreditCard;
use Omnipay\Omnipay;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Redirect;
use Omnipay\Common\Message\RedirectResponseInterface;
use Srmklive\PayPal\Facades\PayPal;
use Stripe\Stripe;
use Illuminate\Support\Facades\Mail;




class PaymentController extends Controller
{



    public function makePayment(Order $order)
    {
        $gateway = $this->createPaypalGateway();

        $data = [];
        $data['items'] = Session::get('products');
        $data['invoice_id'] = $order->id;
        $data['invoice_description'] = "Order #{$data['invoice_id']} Invoice";
        $data['description'] = "Order payment";
        $data['return_url'] = url('/payment/success');
        $data['cancel_url'] = url('/cart');
        $data['amount'] = Session::get('total_price');
        $data['currency'] = env('PAYMENT_CURRENCY');


        try {
            $response = $gateway->purchase($data)->send();

            if ($response->isRedirect()) {
                $response->redirect();
            } else {
                $response->getMessage();
            }
        } catch (\Throwable $error) {
            $error->getMessage();
        }
    }

    public function successPayment(Request $request, $session_id)
    {





        $stripe = new \Stripe\StripeClient("sk_test_CHAVE_API_STRIPE_GENERICA");

        $checkout_session = $stripe->checkout->sessions->retrieve($session_id, [
            'expand' => ['line_items'],
        ]);
        $orderData = Session::get('orderId');

        if ($checkout_session['payment_status'] == 'paid') {
            $adresses = Session::get('adresses');
            /*Create ship*/

            $curl = curl_init();

            curl_setopt_array($curl, [
                CURLOPT_URL => "https://public-api.easyship.com/2024-09/shipments",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => json_encode([
                    'origin_address' => [
                        'line_1' => 'Rua Exemplo',
                        'line_2' => 'Bairro Exemplo',
                        'state' => 'Estado Exemplo',
                        'city' => 'Cidade Exemplo',
                        'postal_code' => '12345-678',
                        'country_alpha2' => 'BR',
                        'contact_name' => 'Potiguara Grow',
                        'company_name' => 'Potiguara Grow',
                        'contact_phone' => '+5511999999999',
                        'contact_email' => 'contato@potiguaragrow.com.br'
                    ],
                    'destination_address' => [
                        'country_alpha2' => 'BR',
                        'line_1' => $adresses['address1'],
                        'line_2' => $adresses['address2'],
                        'state' => $adresses['state'],
                        'city' => $adresses['city'],
                        'postal_code' => $adresses['postalCode'],
                        'contact_name' => $adresses['firstName'],
                        'company_name' => null,
                        'contact_phone' => $adresses['phone'],
                        'contact_email' => $adresses['email'],
                    ],
                    'regulatory_identifiers' => [
                        'eori' => 'DE 123456789 12345',
                        'ioss' => 'IM1234567890',
                        'vat_number' => 'EU1234567890'
                    ],
                    'buyer_regulatory_identifiers' => [
                        'ein' => '12-3456789',
                        'vat_number' => 'EU1234567890',
                        'ssn' => '123-45-6789'
                    ],
                    'incoterms' => 'DDU',
                    'insurance' => [
                        'is_insured' => false
                    ],
                    'order_data' => [
                        'buyer_selected_courier_name' => 'Production',
                        'platform_name' => 'Laravel plat_form',
                        'order_created_at' => '2024-01-31T18:00:00Z'
                    ],
                    'courier_settings' => [
                        'allow_fallback' => false,
                        'apply_shipping_rules' => true
                    ],
                    'shipping_settings' => [
                        'additional_services' => [
                            'qr_code' => 'none'
                        ],
                        'units' => [
                            'weight' => 'kg',
                            'dimensions' => 'cm'
                        ],
                        'buy_label' => false,
                        'buy_label_synchronous' => false,
                        'printing_options' => [
                            'format' => 'png',
                            'label' => '4x6',
                            'commercial_invoice' => 'A4',
                            'packing_slip' => '4x6'
                        ]
                    ],
                    'parcels' => [
                        [
                            'total_actual_weight' => 1,
                            'box' => null,
                            'items' => [
                                [
                                    'description' => 'item',
                                    'category' => null,
                                    'hs_code' => '123456',
                                    'contains_battery_pi966' => true,
                                    'contains_battery_pi967' => true,
                                    'contains_liquids' => true,
                                    'sku' => 'sku',
                                    'origin_country_alpha2' => 'HK',
                                    'quantity' => 2,
                                    'dimensions' => [
                                        'length' => 1,
                                        'width' => 2,
                                        'height' => 3
                                    ],
                                    'actual_weight' => 10,
                                    'declared_currency' => 'AUD',
                                    'declared_customs_value' => 20
                                ]
                            ]
                        ]
                    ]
                ]),
                CURLOPT_HTTPHEADER => [
                    "accept: application/json",
                    "authorization: Bearer EASYSHIP_API_TOKEN_GENERICO",
                    "content-type: application/json"
                ],
            ]);

            $response = curl_exec($curl);
            $err = curl_error($curl);

            curl_close($curl);

            if ($err) {
                echo "cURL Error #:" . $err;
            } else {
                $getdata = json_decode($response);


                /**/




                $order = Order::find(Session::get('orderId'));



                $order->update([
                    'payment_method' => "Stripe",
                    'is_paid' => true,
                    'shipping_id' => $getdata->shipment->easyship_shipment_id,
                    'paid_at' => date("Y-m-d h:i:s", $checkout_session['created']),
                    'status' => "Delivering",
                ]);


                $to      = $adresses['email'];
                $subject = 'Order successfully Placed';
                $message = '<div style="margin-top: 50px; text-align: center;">
                <img style="height: 150px;" src="/img/logo.png" alt="Potiguara Grow Logo">
                <h1 style="color: #333;">Order Successfully Placed</h1>
                <p style="font-size: 16px; color: #555;">
                    Welcome to Potiguara Grow world!
                </p>
                <p style="font-size: 16px; color: #555;">
                    Hello ' . $adresses['firstName'] . ', <br> 
                    We have received your Order Number: <strong>' . $orderData . '</strong> and we are processing it. You can start tracking <br>
                    the package soon.
                </p>
                <h4 style="color: #333;">Tracking Number: <strong>' . $getdata->shipment->easyship_shipment_id . '</strong></h4>
            </div>
            
            <div style="margin-top: 20px; text-align: center;">
                <h3 style="color: #333;">Order Details:</h3>
                <div style="margin: 20px auto; max-width: 800px; text-align: left;">';

                foreach ($order->products as $item) {
                    $message .= '<div style="display: flex; margin-bottom: 20px; align-items: center; border-bottom: 1px solid #ddd; padding-bottom: 10px;">
                    <img src="/storage/products/' . $item->product_image . '" 
                         alt="Product Image" 
                         style="height: 50px; margin-right: 20px;">
                    <div>';

                    // Check and display fields only if they have values
                    if (!empty($item->name)) {
                        $message .= '<p style="margin: 0;"><strong>Product Name:</strong> ' . ($item->name == 'Try Before Buy' ? $item->SKU : $item->name) . '</p>';
                    }
                    if (!empty($item->pivot->quantity)) {
                        $message .= '<p style="margin: 0;"><strong>Quantity:</strong> ' . $item->pivot->quantity . '</p>';
                    }
                    if (!empty($item->pivot->print_type)) {
                        $message .= '<p style="margin: 0;"><strong>Print Type:</strong> ' . $item->pivot->print_type . '</p>';
                    }
                    if (!empty($item->pivot->print_text)) {
                        $message .= '<p style="margin: 0;"><strong>Print Text:</strong> ' . $item->pivot->print_text . '</p>';
                    }
                    if (!empty($item->pivot->print_font)) {
                        $message .= '<p style="margin: 0;"><strong>Print Font:</strong> ' . $item->pivot->print_font . '</p>';
                    }
                    if (!empty($item->pivot->print_color)) {
                        $message .= '<p style="margin: 0;"><strong>Print Color:</strong> ' . $item->pivot->print_color . '</p>';
                    }
                    if (!empty($item->pivot->print_image)) {
                        $message .= '<p style="margin: 0;"><strong>Print Personalized Image:</strong> <br> 
                    <img src="/storage/personalizeImages/' . $item->pivot->print_image . '" 
                         alt="Print Personalized Image" 
                         style="height: 50px; margin-right: 20px;"></p>';
                    }

                    $message .= '</div>
                </div>';
                }

                $message .= '</div>
            </div>
            
            <div style="margin-top: 50px; text-align: center; color: #555;">
                <p>Entre em contato conosco pelo e-mail <a href="mailto:contato@potiguaragrow.com.br">contato@potiguaragrow.com.br</a> ou telefone <strong>(XX) XXXX-XXXX</strong> para qualquer necessidade urgente.</p>
                <p style="font-size: 14px;">www.potiguaragrow.com.br</p>
            </div>';


                $headers = 'MIME-Version: 1.0' . "\r\n";
                $headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
                $headers .= 'From: contato@potiguaragrow.com.br' . "\r\n" .
                    'Reply-To: contato@potiguaragrow.com.br' . "\r\n" .
                    'X-Mailer: PHP/' . phpversion();
                mail($to, $subject, $message, $headers);
                $adminMessage = '<div style="margin-top: 50px; text-align: center;">
    <img style="height: 150px;" src="/img/logo.png" alt="Potiguara Grow Logo">
    <h1 style="color: #333;">New Order Received</h1>
    <p style="font-size: 16px; color: #555;">
        A new order has been placed on Potiguara Grow.
    </p>
    <p style="font-size: 16px; color: #555;">
        Customer: <strong>' . $adresses['firstName'] . ' ' . $adresses['lastName'] . '</strong> <br>
        Email: <strong>' . $adresses['email'] . '</strong> <br>
        Phone: <strong>' . ($adresses['phone'] ?? 'N/A') . '</strong>
    </p>
    <h4 style="color: #333;">Order Number: <strong>' . $orderData . '</strong></h4>
    <h4 style="color: #333;">Tracking Number: <strong>' . $getdata->shipment->easyship_shipment_id . '</strong></h4>
</div>

<div style="margin-top: 20px; text-align: center;">
    <h3 style="color: #333;">Order Details:</h3>
    <div style="margin: 20px auto; max-width: 800px; text-align: left;">';

                foreach ($order->products as $item) {
                    $adminMessage .= '<div style="display: flex; margin-bottom: 20px; align-items: center; border-bottom: 1px solid #ddd; padding-bottom: 10px;">
        <img src="/storage/products/' . $item->product_image . '" 
             alt="Product Image" 
             style="height: 50px; margin-right: 20px;">
        <div>';

                    $adminMessage .= '<p style="margin: 0;"><strong>Product Name:</strong> ' . ($item->name == 'Try Before Buy' ? $item->SKU : $item->name) . '</p>';
                    $adminMessage .= '<p style="margin: 0;"><strong>Quantity:</strong> ' . $item->pivot->quantity . '</p>';

                    if (!empty($item->pivot->print_type)) {
                        $adminMessage .= '<p style="margin: 0;"><strong>Print Type:</strong> ' . $item->pivot->print_type . '</p>';
                    }
                    if (!empty($item->pivot->print_text)) {
                        $adminMessage .= '<p style="margin: 0;"><strong>Personalized Text:</strong> ' . $item->pivot->print_text . '</p>';
                    }
                    if (!empty($item->pivot->print_font)) {
                        $adminMessage .= '<p style="margin: 0;"><strong>Font:</strong> ' . $item->pivot->print_font . '</p>';
                    }
                    if (!empty($item->pivot->print_color)) {
                        $adminMessage .= '<p style="margin: 0;"><strong>Color:</strong> ' . $item->pivot->print_color . '</p>';
                    }
                    if (!empty($item->pivot->print_image)) {
                        $adminMessage .= '<p style="margin: 0;"><strong>Personalized Image:</strong> <br> 
        <img src="/storage/personalizeImages/' . $item->pivot->print_image . '" 
             alt="Print Personalized Image" 
             style="height: 50px; margin-right: 20px;"></p>';
                    }

                    $adminMessage .= '</div>
    </div>';
                }

                $adminMessage .= '</div>
</div>

<div style="margin-top: 50px; text-align: center; color: #555;">
    <p>Para mais informações, entre em contato conosco pelo e-mail <a href="mailto:contato@potiguaragrow.com.br">contato@potiguaragrow.com.br</a>.</p>
    <p style="font-size: 14px;">www.potiguaragrow.com.br</p>
</div>';

                // Send email to the administrator
                mail("contato@potiguaragrow.com.br", "Novo Pedido Recebido", $adminMessage, $headers);

                Session::forget('adresses');
                Session::forget('orderId');
                Session::forget('products');
                Session::forget('total_quantity');
                Session::forget('total_price');
            }
        } else {
            return "Payment is declined";
        }

        return view('thankyou', ['id' => $orderData, 'shipping_id' => $getdata->shipment->easyship_shipment_id]);
    }



    function createPaypalGateway()
    {
        $gateway = Omnipay::create('PayPal_Rest');

        $config = [
            'clientId' => env('PAYPAL_SANDBOX_CLIENT_ID', ''),
            'secret' => env('PAYPAL_SANDBOX_CLIENT_SECRET', ''),
            'token' => env('PAYPAL_SANDBOX_ACCESS_TOKEN'),
            'testMode' => true,
        ];
        return $gateway->initialize($config);
    }

    function createStripeGateway()
    {
        $gateway = Omnipay::create('Stripe');

        $config = [
            "apiKey" => "sk_test_CHAVE_API_STRIPE_GENERICA",
            "stripeVersion" => env('STRIPE_VERSION')
        ];

        return $gateway->initialize($config);
    }

    public function stripePayment(Request $request, Order $order)
    {

        $adresses = [];
        $adresses['delivery_strategies'] = $request->input('delivery_strategies');
        $adresses['firstName'] = $request->input('firstName');
        $adresses['firstName'] = $request->input('firstName');
        $adresses['lastName'] = $request->input('lastName');
        $adresses['company'] = $request->input('company');
        $adresses['address1'] = $request->input('address1');
        $adresses['address2'] = $request->input('address2');
        $adresses['city'] = $request->input('city');
        $adresses['state'] = $request->input('state');
        $adresses['postalCode'] = $request->input('postalCode');
        $adresses['phone'] = $request->input('phone');
        $adresses['email'] = $request->input('email');
        Session::put('adresses', $adresses);

        $stripe = new \Stripe\StripeClient("sk_test_CHAVE_API_STRIPE_GENERICA");

        $request->session()->put('line_items.0.price_data.unit_amount', 100 * round(Session::has('full_price') ?
            Session::get('full_price') : Session::get('total_price'), 2));

        $checkout_session =  $stripe->checkout->sessions->create([
            'success_url' => url('/payment/success/{CHECKOUT_SESSION_ID}'),
            'cancel_url' => url('/cart'),
            'payment_method_types' => ['link', 'card'],
            'line_items' => [
                '0' => Session::get('line_items')
            ],

            'mode' => 'payment',
            'allow_promotion_codes' => false
        ]);

        return redirect('/payment/redirect/' . urlencode($checkout_session['url']));
    }
}
