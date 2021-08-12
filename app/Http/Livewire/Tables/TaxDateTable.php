<?php

namespace App\Http\Livewire\Tables;

use App\Models\TaxDate;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Mediconesystems\LivewireDatatables\NumberColumn;

class TaxDateTable extends LivewireDatatable
{
    public $model = TaxDate::class;

    public $sort = 'date_at|desc';

    public $exportable = true;

    public $hideable = 'select';

    public function columns()
    {
        return [
            NumberColumn::name('id')
                ->label('ID')
                ->width(100)
                ->filterable()
                ->alignRight(),

            DateColumn::name('date_at')
                ->label('Date')
                ->width(100)
                ->defaultSort()
                ->filterable(),

            Column::name('title')
                ->filterable()
                ->searchable()
                ->truncate(30),

            Column::name('description')
                ->filterable()
                ->searchable()
                ->truncate(100),

            Column::name('category')
                ->filterable($this->categories)
                ->truncate(60),

            Column::callback(['id'], function ($id) {
                return view('table-views.actions-tax-date', \compact('id'));
            })
                ->width(100)
                ->excludeFromExport()
                ->label('Actions'),
        ];
    }

    public function getCategoriesProperty()
    {
        return TaxDate::pluck('category')->filter();
    }
}
