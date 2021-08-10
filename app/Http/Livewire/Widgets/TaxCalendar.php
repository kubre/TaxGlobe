<?php

namespace App\Http\Livewire\Widgets;

use App\Models\TaxDate;
use Illuminate\Support\Carbon;
use Livewire\Component;

class TaxCalendar extends Component
{
    public $years = [];

    public $finalYear;

    public $selectedMonth;
    public $selectedYear;

    public function mount()
    {
        $this->finalYear = (int)(optional(Carbon::parse(TaxDate::max('date_at')))->format('Y') ?? date('Y'));
        $this->selectedYear = (int)date('Y');
        $this->selectedMonth = (int)date('n');
    }

    public function render()
    {
        $startDate = Carbon::createFromDate((int)$this->selectedYear, (int)$this->selectedMonth)->startOfMonth();
        $endDate = Carbon::createFromDate((int)$this->selectedYear, (int)$this->selectedMonth)->endOfMonth();

        $taxDates = TaxDate::query()
            ->where('date_at', '>=', $startDate)
            ->where('date_at', '<=', $endDate)
            ->orderBy('date_at', 'ASC')
            ->get();

        for ($i = 2020; $i <= $this->finalYear; $i++) {
            $this->years[(string)$i] = (string)$i;
        }

        return view('components.widgets.tax-calendar', \compact('taxDates'));
    }
}
