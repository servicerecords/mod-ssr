<?php

namespace App\View\Components;

use Illuminate\Support\Str;
use Illuminate\View\Component;

class Country extends FormField
{
    /**
     * @var array
     */
    public $countries = [];

    public function __construct($field = null, $label = 'Option', $value = null, $hint = false, $selected = null,
                                $options = [], $labelExtra = null, $mandatory = true, $characterLimit = false,
                                $fullWidth = false, $autocomplete = false, $hideLabel = false)
    {
        parent::__construct($field, $label, $value, $hint, $selected, $options, $labelExtra,
            $mandatory, $characterLimit, $fullWidth, $autocomplete, $hideLabel);

        $jsonFile = public_path('assets/data/location-autocomplete-canonical-list.json');
        $this->countries = json_decode(file_get_contents($jsonFile));
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.country');
    }
}
