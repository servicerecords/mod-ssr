<?php

namespace App\Http\Controllers;


use App\Http\Requests\CookieTrackingRequest;
use Illuminate\Http\Request;

class HelpController extends Controller
{
    public function cookies(Request $request)
    {
        $tracking = session()->get('tracking', 'yes');
        return view('help.cookies', ['tracking' => $tracking]);
    }

    public function cookiesToggle(Request $request)
    {
        session()->put('tracking', $request->input('tracking', 'yes'));
        return redirect('/help/cookies');
    }

    public function privacy()
    {
        return view('help.privacy');
    }

    public function accessibility()
    {
        return view('help.accessibility');
    }

}
