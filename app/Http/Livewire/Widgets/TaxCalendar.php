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
    public $selectedCategory = 'All';
    public $categoriesInMonth;
    public $fullPage = false;

    public function mount()
    {
        $this->finalYear = (int)(optional(Carbon::parse(TaxDate::max('date_at')))->format('Y') ?? date('Y'));

        $this->selectedYear = \request()->get('taxYear', (int)date('Y'));
        $this->selectedMonth = \request()->get('taxMonth', (int)date('n'));
        $this->selectedCategory = \request()->get('taxCategory', 'All');
        \abort_if(!\is_numeric($this->selectedMonth) || $this->selectedMonth < 1 || $this->selectedMonth > 12 || !\is_numeric($this->selectedYear), 404);
    }

    public function render()
    {
        $startDate = Carbon::createFromDate((int)$this->selectedYear, (int)$this->selectedMonth)->startOfMonth();
        $endDate = Carbon::createFromDate((int)$this->selectedYear, (int)$this->selectedMonth)->endOfMonth();

        $taxDates = TaxDate::query()
            ->where('date_at', '>=', $startDate)
            ->where('date_at', '<=', $endDate)
            // ->when($this->selectedCategory !== 'All' && $this->selectedCategory !== 'No Category', function ($query) {
            //     $query->where('category', $this->selectedCategory);
            // })
            // ->when($this->selectedCategory === 'No Category', function ($query) {
            //     $query->whereNull('category');
            // })
            ->orderBy('date_at', 'ASC')
            ->get();

        $this->categoriesInMonth = $taxDates->mapWithKeys(fn ($taxDate) => [$taxDate->category => $taxDate->category])
            ->filter()
            ->whenEmpty(fn ($c) => \collect([
                'All' => 'Show All',
                'No Category' => 'No Category',
            ]))
            ->whenNotEmpty(fn ($c) => $c->merge([
                'All' => 'Show All',
                'No Category' => 'No Category',
            ]))
            ->toArray();


        for ($i = 2020; $i <= $this->finalYear; $i++) {
            $this->years[(string)$i] = (string)$i;
        }

        return view('components.widgets.tax-calendar', \compact('taxDates'));
    }
}
