<?php

namespace App\View\Components;

use Illuminate\Support\Str;
use Illuminate\View\Component;

class Checkbox extends FormField
{
    /**
     * @var array|mixed
     */
    public $isGrouped = false;

    /**
     * @var array|mixed
     */
    public $children = [];

    public function __construct($field = null, $label = 'Option', $value = null, $hint = false, $selected = null,
                                $options = [], $labelExtra = null, $mandatory = true, $characterLimit = false,
                                $fullWidth = false, $autocomplete = false, $hideLabel = false, $children = [], $isGrouped = false)
    {

        parent::__construct($field, $label, $value, $hint, $selected, $options,
            $labelExtra, $mandatory, $characterLimit, $fullWidth, $autocomplete, $hideLabel);

        $this->isGrouped = $isGrouped;
        $this->children = $children;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.checkbox');
    }
}
