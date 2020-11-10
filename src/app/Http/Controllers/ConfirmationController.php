<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Payment;
use Illuminate\Http\Request;

class ConfirmationController extends Controller
{
    /**
     * @param Request $request
     * @param $uuid
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function paid(Request $request, $uuid)
    {
        $payment  = Payment::getInstance()->verifyPayment($uuid);
        $application = Application::getInstance();

        if($payment && session('application-reference', false)) {
            $application->notifyBranch();
            $application->notifyApplicant();

            Application::getInstance()->cleanup();
            return redirect()->route('confirmation.complete');
        } else {
            return view('confirmation-error', ['message' => 'There is a problem verifying your payment.']);
        }
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function free() {
        $application = Application::getInstance();
        $application->notifyBranch();
        $application->notifyApplicant();

        Application::getInstance()->cleanup();
        return view('confirmation-success');
    }

    /**
     * Show completed session page
     */
    public function complete() {
        return view('confirmation-success');
    }
}
