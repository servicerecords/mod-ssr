<?php

namespace App\Http\Controllers;

use App\Http\Requests\ServiceSelectRequest;
use App\Models\ServiceBranch;

class ServiceController extends Controller
{
    /**
     * @return mixed
     */
    public function index()
    {
        return view('service', [
            'branches' => ServiceBranch::getInstance()->getOptionList()
        ]);
    }

    /**
     * @param ServiceSelectRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function save(ServiceSelectRequest $request)
    {
        session(['service' => $request->get('service')]);
        session(['serviceperson-service' => ServiceBranch::getInstance()->getName($request->get('service'))]);

        return redirect()->route('death-in-service');
    }
}
