<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    protected $cost;
    protected $description = "Service Record Request";
    protected $return_url;

    public function __construct()
    {
        $this->cost = env('REQUEST_PRICE');
    }

    /**
     * Process the payment and send it to Gov Pay.
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function processPayment(Request $request)
    {
        $unique_id = uniqid();

        $post_params = [
            'amount' => 3000,
            'reference' => $request->session()->get('reference'),
            'description' => $this->description,
            'return_url' => env('GOV_PAY_RETURN_URL', 'https://srrdigital-sandbox.cloudapps.digital') . '/confirmation?uuid=' . $unique_id,
            'email' => $request->session()->get('your_details.email', '')
        ];

        if ($request->session()->get('your_details.use_billing') == 'Yes') {
            $post_params['prefilled_cardholder_details'] = [
                "cardholder_name" => '',
                "billing_address" => [
                    'line1' => $request->session()->get('your_details.address_line_1', ''),
                    'line2' => $request->session()->get('your_details.address_line_2', ''),
                    'postcode' => $request->session()->get('your_details.address_postcode', ''),
                    'city' => $request->session()->get('your_details.address_town', ''),
                    'country' => $request->session()->get('your_details.country', '')
                ]
            ];
        }

        $client = new Client([
            'base_uri' => 'https://publicapi.payments.service.gov.uk/v1/',
            'timeout' => 2.0,
            'headers' => [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . env('GOV_PAY_API_KEY', 'kiaer1kpiaolo3m7hc13p2jln7anjhi4v0ggcgluu1jqek4kr4pajq7cu4'),
                'Content-Type' => 'application/json'
            ]
        ]);

        try {
            $response = $client->request('POST', 'payments', [
                'body' => json_encode($post_params, JSON_UNESCAPED_SLASHES)
            ]);

            $body = json_decode($response->getBody()->getContents());
            if ($response->getStatusCode() < 400) {
                $request->session()->put($unique_id, $body->payment_id);
                return redirect($body->_links->next_url->href);
            }
        } catch (GuzzleException $e) {
            Log::critical($e->getMessage());
        }
    }
}
