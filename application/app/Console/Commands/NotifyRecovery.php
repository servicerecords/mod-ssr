<?php

namespace App\Console\Commands;

use Alphagov\Notifications\Client;
use Alphagov\Notifications\Exception\ApiException;
use App\Http\Controllers\PaymentController;
use Illuminate\Console\Command;
use Illuminate\Http\FileHelpers;
use Illuminate\Support\Facades\Log;

class NotifyRecovery extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notify:recovery';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check for and retry sending failed emails when Notify goes down';

    protected $notify;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        $this->notify = new Client([
            'apiKey' => env('NOTIFY_API_KEY', 'srrdigitalproduction-8ae4b688-c5e2-45ff-a873-eb149b3e23ff-ed3db9dd-d928-4d4c-89dc-8d22b4265e75'),
            'httpClient' => new \Http\Adapter\Guzzle6\Client
        ]);
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $failures = storage_path('app/notify/failure.json');

        if (!($failures && file_exists($failures)))
            return;

        $failedEmails = json_decode(file_get_contents($failures));

        foreach ($failedEmails as $failedEmailIndex => $failedEmailData) {

            try {
                $this->notify->sendEmail(
                    $failedEmailData['email'],
                    $failedEmailData['template'],
                    $failedEmailData['data']
                );

                delete($failedEmails[$failedEmailIndex]);
            } catch (ApiException $e) {
            }
        }

        file_put_contents(json_encode($failedEmails));
    }
}




