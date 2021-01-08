<?php


namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\Support\Str;

abstract class FormField extends Component
{
    /**
     * @var string
     */
    public $_id;

    /**
     * @var string
     */
    public $field;

    /**
     * @var string
     */
    public $label;

    /**
     * @var string
     */
    public $labelExtra;

    /**
     * @var string
     */
    public $value;

    /**
     * @var false|mixed
     */
    public $hint;

    /**
     * @var mixed
     */
    public $selected;

    /**=
     * @var array
     */
    public $options = [];

    /**
     * @var bool
     */
    public $mandatory = true;

    /**
     * @var integer
     */
    public $characterLimit = false;

    /**
     * @var bool
     */
    public $fullWidth = false;

    /**
     * @var bool
     */
    public $autocomplete = false;

    /**
     * @var bool
     */
    public $hideLabel = false;

    /**
     * Create a new component instance.
     *
     * @param null $field
     * @param string $label
     * @param null $value
     * @param bool $hint
     * @param null $selected
     * @param array $options
     * @param null $labelExtra
     * @param bool $mandatory
     * @param int|false $characterLimit
     * @param bool $fullWidth
     * @param bool $autocomplete
     * @param bool $hideLabel
     */
    public function __construct($field = null, $label = 'Option', $value = null, $hint = false, $selected = null,
                                $options = [], $labelExtra = null, $mandatory = true, $characterLimit = false,
                                $fullWidth = false, $autocomplete = false, $hideLabel = false)
    {
        $this->field = $field;
        $this->label = $label;
        $this->labelExtra = $labelExtra;
        $this->value = $value;
        $this->selected = $selected;
        $this->options = $options;
        $this->mandatory = $mandatory;
        $this->characterLimit = $characterLimit;
        $this->fullWidth = $fullWidth;
        $this->autocomplete = $autocomplete;
        $this->hideLabel = $hideLabel;
        $this->_id = Str::lower(Str::snake(str_replace(['/'], ' or ', str_replace(['(', ')'], '', $label))));

        if($hint) {
            if(Str::endsWith($hint, '.')) {
                $this->hint = $hint;
            } else {
                $this->hint = $hint . '.';
            }
        }

    }
}
