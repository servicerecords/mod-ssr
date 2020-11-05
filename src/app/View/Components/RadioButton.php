<?php

namespace App\View\Components;

use Illuminate\Support\Str;
use Illuminate\View\Component;

class RadioButton extends FormField
{
    /**
     * @var array|mixed
     */
    public $children = [];

    /**
     * RadioButton constructor.
     * @param null $field
     * @param string $label
     * @param null $value
     * @param false $hint
     * @param null $selected
     * @param array $options
     * @param null $labelExtra
     * @param bool $mandatory
     * @param false $characterLimit
     * @param false $fullWidth
     * @param false $autocomplete
     * @param false $hideLabel
     * @param array $children
     */
    public function __construct($field = null, $label = 'Option', $value = null, $hint = false,
                                $selected = null, $options = [], $labelExtra = null, $mandatory = true,
                                $characterLimit = false, $fullWidth = false, $autocomplete = false,
                                $hideLabel = false, $children = [])
    {
        parent::__construct($field, $label, $value, $hint, $selected, $options, $labelExtra,
            $mandatory, $characterLimit, $fullWidth, $autocomplete, $hideLabel);

        $this->children = $children;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.radio-button');
    }
}
