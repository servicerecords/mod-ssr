<?php

namespace App\Http\Controllers;

use App\Models\Constant;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Log;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public $backUrl = null;

    /**
     * @param string $method
     * @param array $parameters
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function callAction($method, $parameters)
    {
        $progression =array_merge(
            [
                '/',
                'service/death-in-service',
                'essential-information',
                'serviceperson-details',
            ],
            session('serviceperson-died-in-service') === Constant::YES ? ['sending-documentation'] : [],
            [
                'applicant-details',
                'applicant-relationship',
                'applicant-next-of-kin',
                'check-answers'
            ]
        );

        // code that runs before any action
        if (request()->method() === 'GET') {
            $pathEntry = array_search(request()->route()->uri, $progression);
            if ($pathEntry > 0) {
                $returnUrl = $progression[$pathEntry - 1];
                view()->composer('layouts.app', function ($view) use ($returnUrl) {
                    $view->with('returnUrl', $returnUrl);
                });
            }
        }

//        Log::info('Hekllo Word');

        return parent::callAction($method, $parameters);
    }
}
