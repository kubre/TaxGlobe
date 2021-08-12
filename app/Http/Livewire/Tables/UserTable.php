<?php

namespace App\Http\Livewire\Tables;

use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Mediconesystems\LivewireDatatables\BooleanColumn;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Mediconesystems\LivewireDatatables\NumberColumn;

class UserTable extends LivewireDatatable
{
    public $model = User::class;

    public $sort = 'id|desc';

    public $hideable = 'select';

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
                ->defaultSort()
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

            Column::name('username')
                ->filterable()
                ->hide()
                ->truncate(50),

            Column::name('profession')
                ->filterable()
                ->hide()
                ->truncate(50),

            Column::name('bio')
                ->filterable()
                ->searchable()
                ->hide()
                ->truncate(50),

            Column::name('gender')
                ->filterable(['Male', 'Female', 'Transgender', 'Other'])
                ->hide()
                ->truncate(50),

            Column::name('address')
                ->filterable()
                ->hide()
                ->width(150),

            Column::name('city')
                ->filterable()
                ->hide()
                ->width(150),

            Column::name('state')
                ->filterable()
                ->hide()
                ->width(150),

            Column::name('area')
                ->filterable()
                ->hide()
                ->width(150),

            Column::name('professional_email')
                ->filterable()
                ->hide()
                ->width(150),

            NumberColumn::name('contact')
                ->filterable()
                ->hide()
                ->width(150),

            NumberColumn::name('whatsapp_contact')
                ->filterable()
                ->hide()
                ->width(150),

            NumberColumn::name('points')
                ->filterable()
                ->width(150),

            // Column::name('role')
            //     ->filterable([1 => 'User', 2 => 'Admin'])
            //     ->hide()
            //     ->width(150),

            BooleanColumn::name('deleted_at')
                ->filterable()
                ->label('Is Banned')
                ->width(150),

            DateColumn::name('created_at')
                ->label('Creation Date')
                ->width(100)
                ->filterable(),

            Column::callback(['id'], function ($id) {
                return view('table-views.actions-user', \compact('id'));
            })
                ->width(50)
                ->excludeFromExport()
                ->label('Actions'),
        ];
    }
}
