<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HelpController extends Controller
{
    public function accessibility(Request $request) {
        return view('help.accessibility');
    }
}
