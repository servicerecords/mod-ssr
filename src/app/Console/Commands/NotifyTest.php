<?php

namespace App\Console\Commands;

use Alphagov\Notifications\Client as Notify;
use GuzzleHttp\Client;
use Illuminate\Console\Command;
use Ramsey\Uuid\Uuid;

class NotifyTest extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notify:test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'run some notify tests';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $templateId = '68640434-bc34-4c0c-b8d4-de6d734661c6';
        $notify = new Notify([
            'apiKey' => env('NOTIFY_API_KEY', 'srrdigitaldev-8ae4b688-c5e2-45ff-a873-eb149b3e23ff-5372ddfc-dbe3-4e7f-a487-103a7f23fa53'),
            'httpClient' => new Client()
        ]);
        $template = $notify->getTemplate($templateId);
        $data = [];
        if ($template) {
            $properties = $template['personalisation'];

            print_r($properties);
//            foreach($properties as $property => $propertyValue) {
//                $data[$property] = session($property, 'n/a');
//            }
        }

//        $response = $notify->sendEmail(
//            'toby@codesure.co.uk',
//            $templateId,
//            $data,
//            Uuid::uuid4()
//        );

    }
}
