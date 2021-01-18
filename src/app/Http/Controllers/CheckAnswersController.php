<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Constant;
use App\Models\Payment;


class CheckAnswersController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $application = Application::getInstance();
        $application->markSectionComplete(Constant::SECTION_CHECK_ANSWERS);

        return view('check-answers', [
            'serviceperson' => $application->getServiceperson(),
            'applicant' => $application->getApplicant(),
        ]);
    }

    /**
     * Customer wishes to amend an answer. We will route the use back to the required page and
     * reference the form field to provide accessibility WCAG 2.1 AA standards
     */
    public function changeAnswer()
    {
        $route = route(request()->get('route'));
        $field = request()->get('field');

        return redirect($route . '#' . $field);
    }

    /**
     * Customer has confirmed their answers. we either forward to Pay or mark as Confirmation dependant
     * on whether the customer needs to make a payment or receives this service for free
     */
    public function save()
    {
        Application::getInstance()->createReference();
        return (Application::getInstance()->isFree()) ? redirect('confirmation') : redirect(Payment::getInstance()->getPaymentUrl());
    }
}
