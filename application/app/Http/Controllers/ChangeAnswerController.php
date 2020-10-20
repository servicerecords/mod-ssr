<?php

namespace App\Http\Controllers;


use App\Http\Requests\CookieTrackingRequest;
use Illuminate\Http\Request;

class ChangeAnswerController extends Controller
{
    /**
     * @param Request $request
     * @param $return_to
     */
    public function index(Request $request, $return_to)
    {
        session()->put('updating_answer', true);
        return redirect('/'. $return_to);
    }
}
