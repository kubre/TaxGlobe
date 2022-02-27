<?php

namespace App\Http\Livewire\Common;

use Livewire\Component;

class TaxWidgetPage extends Component
{
    public $isTaxPage = true;

    public function render()
    {
        return view('components.common.tax-widget-page');
    }
}
