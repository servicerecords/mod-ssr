<?php

namespace App\View\Components;

use Illuminate\Support\ViewErrorBag;
use Illuminate\View\Component;

class ErrorSummary extends Component
{
    public $errors;

    /**
     * Create a new component instance.
     *
     * @param ViewErrorBag $errors
     */
    public function __construct(ViewErrorBag $errors)
    {
        if (count($errors)) {
            $this->errors = $errors;
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return $this->errors ? view('components.error-summary') : '';
    }
}
