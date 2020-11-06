<?php

namespace App\Http\Controllers;


use App\Http\Requests\ServicepersonDetailsRequest;

class HelpController extends Controller
{
    /**
     * @return mixed
     */
    public function cookiePolicy()
    {
        return view('cookie-policy');
    }

    /**
     * @return mixed
     */
    public function privacyPolicy()
    {
        return view('privacy-policy');
    }

    /**
     * @return mixed
     */
    public function accessibilityStatement()
    {
        return view('accessibility-statement');
    }
}
