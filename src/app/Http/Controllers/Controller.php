<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Constant;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

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
        session(['allow-usage' => Constant::NO]);
        if(isset($_COOKIE['cookies_policy'])) {
            $policy = $_COOKIE['cookies_policy'];
            if ($policy) {
                $policy = json_decode($policy, JSON_OBJECT_AS_ARRAY);
                if($policy['usage']) session(['allow-usage' => Constant::YES]);
            }
        }

        $application = Application::getInstance();
        $progress = [
            'service' => Constant::SECTION_SERVICE,
            'death-in-service' => Constant::SECTION_DIED_IN_SERVICE,
            'essential-information' => Constant::SECTION_ESSENTIAL_INFO,
            'serviceperson-details' => Constant::SECTION_SERVICEPERSON_DETAILS,
            'sending-documentation' => Constant::SECTION_DEATH_CERTIFICATE,
            'applicant-details' => Constant::SECTION_APPLICANT_DETAILS,
            'applicant-relationship' => Constant::SECTION_APPLICANT_RELATIONSHIP,
            'applicant-next-of-kin' => Constant::SECTION_APPLICANT_NEXT_OF_KIN,
            'check-answers' => Constant::SECTION_CHECK_ANSWERS,
        ];

        $currentRoute = Route::currentRouteName();
        if(array_key_exists($currentRoute, $progress)) {
            if(!$application->deathCertificateRequired()) {
                unset($progress['sending-documentation']);
            }

            foreach($progress as $name => $section) {
                if($section < $progress[$currentRoute]) {
                    if(!$application->sectionComplete($section)) {
                        return redirect()->route($name);
                    }
                }
            }
        }

        return parent::callAction($method, $parameters);
    }

}
