<?php

namespace App\View\Components;

use Illuminate\Support\Str;
use Illuminate\View\Component;

class BackButton extends Component
{
    public function render()
    {
        $referer = $_SERVER['HTTP_REFERER'] ?? false;

        if ($referer) {
            return view('components.back-button', [
                'link' => $referer
            ]);
        }
    }
}
