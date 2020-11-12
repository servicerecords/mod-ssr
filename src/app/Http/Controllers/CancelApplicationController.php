<?php

namespace App\Http\Controllers;

use App\Http\Requests\ApplicantDetailsRequest;
use App\Models\Application;
use App\Models\Constant;
use Illuminate\Http\Request;

class CancelApplicationController extends Controller
{
    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function index()
    {
        session()->flush();
        return redirect()->route('home');
    }
}
