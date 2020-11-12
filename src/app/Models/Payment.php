<?php


namespace App\Models;


use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Log;
use Ramsey\Uuid\Uuid;

class Payment
{
    private static $instance = null;
    private static $client = null;

    /**
     * Application constructor.
     */
    private function __construct()
    {
    }

    /**
     * @return Payment
     */
    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new Payment();
        }

        return self::$instance;
    }

    /**
     * @return string
     */
    public function getPaymentUrl()
    {
        session(['payment-reference' => str_replace('-', '', Uuid::uuid4()->toString())]);
        session(['application-reference' => Application::getInstance()->createReference()]);

        $data = [
            'amount' => 3000,
            'reference' => session('application-reference'),
            'description' => 'Service Record Request',
            'return_url' => env('APP_URL', 'https://srrdigital-sandbox.cloudapps.digital') . '/confirmation/' . session('payment-reference'),
            'email' => session('applicant-email-address', '')
        ];

        if (session('applicant-details-transfer', Constant::YES) === Constant::YES) {
            $data['prefilled_cardholder_details'] = [
                "cardholder_name" => session('applicant-name', ''),
                "billing_address" => [
                    'line1' => session('applicant-address-line-1', ''),
                    'line2' => session('applicant-address-line-2', ''),
                    'postcode' => session('applicant-address-postcode', ''),
                    'city' => session('applicant-address-town', ''),
                    'country' => session('applicant-address-country', '')
                ]
            ];
        }

        $pay = $this->client;

        try {
            $response = $pay->request('POST', 'payments', [
                'body' => json_encode($data, JSON_UNESCAPED_SLASHES)
            ]);

            $body = json_decode($response->getBody()->getContents());
            if ($response->getStatusCode() < 400) {
                session(['payment-id' => $body->payment_id]);
                return $body->_links->next_url->href;
            }
        } catch (GuzzleException $e) {
            Log::critical($e->getMessage());
        };
    }

    /**
     * @param $parameter
     * @return Client
     */
    public function __get($parameter)
    {
        if ($parameter === 'client') {
            if (self::$client === null) {
                return new Client([
                    'base_uri' => 'https://publicapi.payments.service.gov.uk/v1/',
                    'timeout' => 2.0,
                    'headers' => [
                        'Accept' => 'application/json',
                        'Authorization' => 'Bearer ' . env('GOV_PAY_API_KEY', 'kiaer1kpiaolo3m7hc13p2jln7anjhi4v0ggcgluu1jqek4kr4pajq7cu4'),
                        'Content-Type' => 'application/json'
                    ]
                ]);
            }
        }
    }

    /**
     * @param $uuid
     * @return bool
     */
    public function verifyPayment($uuid) {
        return ($this->client->get('payments/' . session($uuid, false))->getStatusCode() === 200);
    }
}
