<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Mediconesystems\LivewireDatatables\NumberColumn;

class UserTable extends LivewireDatatable
{
    public $model = User::class;

    public $sort = 'id|desc';

    public $exportable = true;

    public function builder()
    {
        return User::query();
    }

    public function columns()
    {
        return [
            NumberColumn::name('id')
                ->label('ID')
                ->width(100)
                ->filterable()
                ->alignRight(),

            Column::callback(['profile_photo_path'], function ($image) {
                return view('table-views.image-view', \compact('image'));
            })
                ->label('Profile Photo')
                ->unsortable()
                ->width(30),

            Column::name('name')
                ->filterable()
                ->searchable()
                ->truncate(30),

            Column::name('email')
                ->filterable()
                ->searchable()
                ->truncate(30),

            DateColumn::name('created_at')
                ->label('Creation Date')
                ->width(100)
                ->filterable(),

            // Column::callback(['id'], function ($id) {
            //     return view('table-views.actions-user', \compact('id'));
            // })
            //     ->width(50)
            //     ->label('Actions'),
        ];
    }
}
