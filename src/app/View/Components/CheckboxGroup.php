<?php

namespace App\View\Components;

use Illuminate\View\Component;

class CheckboxGroup extends FormField
{
    /**
     * @var array|mixed
     */
    public $children = [];

    public function __construct($field = null, $label = 'Option', $value = null, $hint = false, $selected = null,
                                $options = [], $labelExtra = null, $mandatory = true, $characterLimit = false,
                                $fullWidth = false, $autocomplete= false,$hideLabel = false, $children = [])
    {

        parent::__construct($field, $label, $value, $hint, $selected, $options,
            $labelExtra, $mandatory, $characterLimit, $fullWidth, $autocomplete, $hideLabel);

        $this->children = $children;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.checkbox-group');
    }
}
