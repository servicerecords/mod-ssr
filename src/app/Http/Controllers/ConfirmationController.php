<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;

class ConfirmationController extends Controller
{
    public function paid(Request $request, $uuid)
    {
        $payment  = Payment::getInstance()->verifyPayment($uuid);

        if($payment && session('application-reference', false)) {
            return view('confirmation-success');
        } else {
            return view('confirmation-error', ['message' => 'There is a problem verifying your payment.']);
        }
    }

    public function free() {}
}
