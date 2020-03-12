<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PaymentRequest;
use GuzzleHttp\Client;

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

        // The params that will be posted to gov pay.
        $post_params = [
            'amount' => env('REQUEST_PRICE', 3000), //£30.00
            'reference' => $request->session()->get('reference'), //This is reference that is first created when the user chooses the service.
            'description' => $this->description, //description of the payment.
            'return_url' => env('GOV_PAY_RETURN_URL', 'https://mod-ssr.co.uk') . '/confirmation?uuid=' . $unique_id, //The URL the user gets returned to when payment has taken place, whetehr successfully or unsucessfully.
            //If not return is specified we default the local development domain.
            'email' => $request->session()->get('your_details.email') //The users email address, used to for GovPay to send a payment notification.
        ];

        //If the user selected that they wish to use their address from the their information page for their billing details
        //Then we pull that out of the session and send it with the post data from above.
        if($request->session()->get('your_details.use_billing') == 'Yes') {
            $post_params['prefilled_cardholder_details'] = [
                "cardholder_name" => '',
                "billing_address" => [
                    'line1' => null !== $request->session()->get('your_details.address_line_1') ? $request->session()->get('your_details.address_line_1') : '',
                    'line2' => null !== $request->session()->get('your_details.address_line_2') ? $request->session()->get('your_details.address_line_2') : '',
                    'postcode' => null !== $request->session()->get('your_details.address_postcode') ? $request->session()->get('your_details.address_postcode') : '',
                    'city' => null !== $request->session()->get('your_details.address_town') ? $request->session()->get('your_details.address_town') : '',
                    'country' => null !== $request->session()->get('your_details.country') ? $request->session()->get('your_details.country') : ''
                ]
            ];
        }

        //Set up the cURL request
        //@todo: Look at moving this to Guzzle to make it cleaner and less lines.
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://publicapi.payments.service.gov.uk/v1/payments",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode($post_params, JSON_UNESCAPED_SLASHES),
            CURLOPT_HTTPHEADER => array(
                "Accept: application/json",
                "Authorization: Bearer " . env('GOV_PAY_API_KEY', 'kiaer1kpiaolo3m7hc13p2jln7anjhi4v0ggcgluu1jqek4kr4pajq7cu4'), //This comes from the gov pay dashboard, if there isn't and API key in the ENV vars we default to sandbox.
                "Content-Type: application/json",
            ),
        ));


        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            //Everything looks to have worked ok, we can move them forward to the confirmation page, this is specified in the return URL.
            $response = json_decode($response, true);
            $request->session()->put($unique_id, $response['payment_id']);
            return redirect($response['_links']['next_url']['href']);
        }
    }
}
