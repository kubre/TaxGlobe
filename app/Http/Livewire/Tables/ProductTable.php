<?php

namespace App\Http\Livewire\Tables;

use App\Models\Product;
use Mediconesystems\LivewireDatatables\BooleanColumn;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Mediconesystems\LivewireDatatables\NumberColumn;

class ProductTable extends LivewireDatatable
{
    public $model = Product::class;

    public $sort = 'id|desc';

    public $hideable = 'select';

    public $exportable = true;

    public function columns()
    {
        // $disk = 'posts';

        return [
            NumberColumn::name('id')
                ->width(120)
                ->sortBy('id')
                ->filterable()
                ->label('ID'),

            Column::name('title')
                ->filterable()
                ->searchable()
                ->width(200),

            // Column::name('short_description')
            //     ->filterable()
            //     ->width(200)
            //     ->truncate(200),

            // Column::callback(['image'], function ($image) use ($disk) {
            //     return view('table-views.image-view', \compact('image', 'disk'));
            // })
            //     ->label('Image')
            //     ->unsortable()
            //     ->excludeFromExport()
            //     ->width(30),

            Column::name('type')
                ->filterable(['download', 'deliver'])
                ->width(40),

            NumberColumn::name('price')
                ->filterable()
                ->width(100),

            NumberColumn::name('discount')
                ->filterable()
                ->width(100),

            NumberColumn::raw('(products.price - products.discount)')
                ->label('Final Price')
                ->filterable()
                ->width(100),

            NumberColumn::name('stock')
                ->label('Stock')
                ->filterable()
                ->editable()
                ->width(20),

            BooleanColumn::name('is_hidden')
                ->label('Hide Listing')
                ->booleanFilterable()
                ->width(20),

            DateColumn::name('created_at')
                ->hide()
                ->filterable(),

            Column::callback(['id', 'slug'], function ($id, $slug) {
                return view('table-views.actions-product', \compact('id', 'slug'));
            })
                ->label('Actions')
                ->width(50)
                ->excludeFromExport()
                ->unsortable(),
        ];
    }
}
