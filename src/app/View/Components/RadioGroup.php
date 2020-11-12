<?php

namespace App\View\Components;

use Illuminate\View\Component;

class RadioGroup extends FormField
{
    /**
     * @var bool|mixed
     */
    public $hideLegend = false;

    /**
     * @var bool|mixed
     */
    public $hasConditionals = false;

    public function __construct($field = null, $label = 'Option', $value = null, $hint = false, $selected = null,
                                $options = [], $labelExtra = null, $mandatory = true, $characterLimit = false,
                                $fullWidth = false, $autocomplete = false, $hideLabel = false, $hideLegend = false, $hasConditionals = false)
    {

        parent::__construct($field, $label, $value, $hint, $selected, $options,
            $labelExtra, $mandatory, $characterLimit, $fullWidth, $autocomplete, $hideLabel);

        $this->hideLegend = $hideLegend;
        $this->hasConditionals = $hasConditionals;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.radio-group');
    }
}
