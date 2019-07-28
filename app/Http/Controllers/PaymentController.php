<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PaymentRequest;
use GuzzleHttp\Client;

class PaymentController extends Controller
{
	protected $cost = 3000;
	protected $description = "Service Record Request";
	protected $return_url;

	public function payment(Request $request)
	{
		return view('payment', ['paying' => true]);
	}

    public function processPayment(Request $request)
	{
		//$validated = $request->validated();
//		$client = new Client();
//
//		$result = $client->post('https://publicapi.payments.service.gov.uk/v1/payments', [
//			'headers' => [
//				'Accept' => 'application/json',
//				'Content-Type' => 'application/json',
//				'Authorization' => env('GOV_PAY_API_KEY')
//			],
//			'form_params' => [
//				'amount' => 3000,
//				'reference' => time(),
//				'description' => $this->description,
//				'return_url' => env('GOV_PAY_RETURN_URL')
//			]
//		]);
//
//		die(print_r($result->getBody()->getContents()));
		//dd($request);
		$post_params = [
			'amount' => 3000,
			'reference' => $request->session()->get('reference'),
			'description' => $this->description,
			'return_url' => env('GOV_PAY_RETURN_URL') . '/' . $request->session()->get('reference')
		];

		//die(print_r(json_encode($post_params, JSON_UNESCAPED_SLASHES)));

		$curl = curl_init();

		//die(print_r($post_params));

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
				"Authorization: Bearer ea14ubq0m0sq5gsh1bi1o9qce5jt1rik59ej2m8gtk3ce045bef7f7fia9",
				"Content-Type: application/json",
			),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
			echo "cURL Error #:" . $err;
		} else {
			$response = json_decode($response, true);
			return redirect($response['_links']['next_url']['href']);
		}
	}
}
