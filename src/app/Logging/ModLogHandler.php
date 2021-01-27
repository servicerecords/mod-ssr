<?php

namespace App\Logging;

use Monolog\Handler\LogglyHandler;

/**
 * Class ModLogHandler
 *
 * Custom logger which logs to Loggly.
 *
 * We are extending the Loggly handler and overwriting the send method
 * due to Loggly issuing a self-signed certificate which causes a fault
 */
class ModLogHandler extends LogglyHandler
{
    protected function send(string $data, string $endpoint): void
    {
        $ch = $this->getCurlHandler($endpoint);

        $headers = ['Content-Type: application/json'];

        if (!empty($this->tag)) {
            $headers[] = 'X-LOGGLY-TAG: '.implode(',', $this->tag);
        }

        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        Curl\Util::execute($ch, 5, false);
    }
}
