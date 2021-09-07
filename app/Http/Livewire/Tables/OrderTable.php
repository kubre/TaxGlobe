<?php

namespace App\Http\Livewire\Tables;

use App\Models\Order;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Mediconesystems\LivewireDatatables\NumberColumn;

class OrderTable extends LivewireDatatable
{

    public $model = Product::class;

    // public $sort = 'id|desc';

    public $hideable = 'select';

    public $exportable = true;

    public function builder()
    {
        return Order::query()->orderBy('id', 'DESC');
    }

    public function columns()
    {
        return [
            NumberColumn::name('id')
                ->width(120)
                ->hide()
                ->sortBy('id')
                ->filterable()
                ->label('ID'),

            Column::name('order_id')
                ->filterable()
                ->searchable()
                ->width(200),

            Column::name('product.title')
                ->filterable()
                ->width(200)
                ->searchable()
                ->truncate(200),

            // NumberColumn::name('amount')
            //     ->label('Amount Payable')
            //     ->filterable()
            //     ->width(100),

            NumberColumn::name('quantity')
                ->label('Quantity Ordered')
                ->filterable()
                ->width(100),

            Column::callback('status', 'computeReadbleStatus')
                ->label('Status')
                ->filterable(Order::$statusList)
                ->width(200),

            Column::name('user.name')
                ->label('Customer')
                ->filterable()
                ->searchable()
                ->width(200)
                ->truncate(200),

            DateColumn::name('created_at')
                ->label('Order Placed')
                ->filterable(),

            Column::callback(['id'], function ($id) {
                return view('table-views.actions-order', \compact('id'));
            })
                ->label('Actions')
                ->width(50)
                ->excludeFromExport()
                ->unsortable(),
        ];
    }

    public function computeReadbleStatus($status)
    {
        return Order::$statusList[$status] ?? 'Unknown';
    }
}
