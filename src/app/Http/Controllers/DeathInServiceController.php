<?php

namespace App\Http\Controllers;

use App\Http\Requests\DeathInServiceRequest;
use App\Models\Constant;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class DeathInServiceController extends Controller
{
    /**
     * @var string[]
     */
    public $options = [
        [
            'label' => Constant::YES,
            'value' => Constant::YES,
            'children' => []
        ],
        [
            'label' => Constant::NO,
            'value' => Constant::NO,
            'children' => []
        ],
    ];

    /**
     * Fields which pertain to the form this controller is responsible for
     * @var string[]
     */
    protected $fields = [
        'serviceperson-died-in-service',
    ];

    /**
     * @return RedirectResponse|Request
     */
    public function index()
    {
        if(!session('service')) {
            return redirect()->route('service');
        }

        return view('death-in-service', [
            'options' => $this->options
        ]);
    }

    /**
     * @param DeathInServiceRequest $request
     * @return RedirectResponse
     */
    public function save(DeathInServiceRequest $request)
    {
        foreach($this->fields as $field) {
            session([$field => $request->input($field)]);
        }

        return redirect()->route('essential-information');
    }
}
