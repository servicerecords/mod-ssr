<?php

namespace App\View\Components;

use Illuminate\View\Component;

class PostcodeField extends FormField
{
    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.postcode-field');
    }
}