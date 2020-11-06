<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ErrorMessage extends Component
{
    public $field;

    /**
     * Create a new component instance.
     *
     * @param string $field
     */
    public function __construct($field = '')
    {
        $this->field = $field;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.error-message');
    }
}
