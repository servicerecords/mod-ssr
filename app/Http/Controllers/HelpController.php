<?php

namespace App\Http\Controllers;

class HelpController extends Controller
{
    public function cookies()
    {
        return view('help.cookies');
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
