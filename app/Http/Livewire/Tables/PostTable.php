<?php

namespace App\Http\Livewire\Tables;

use App\Models\Post;
use Illuminate\Support\Facades\Storage;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Mediconesystems\LivewireDatatables\NumberColumn;

class PostTable extends LivewireDatatable
{

    public $model = Post::class;

    public $sort = 'id|desc';

    public $exportable = true;

    public function builder()
    {
        return Post::query();
    }

    public function columns()
    {
        $disk = 'posts';

        return [
            NumberColumn::name('id')
                ->defaultSort(true)
                ->width(120)
                ->filterable()
                ->label('ID'),

            Column::name('title')
                ->filterable()
                ->searchable()
                ->truncate(60),

            Column::callback(['image'], function ($image) use ($disk) {
                return view('table-views.image-view', \compact('image', 'disk'));
            })
                ->label('Image')
                ->unsortable()
                ->width(30),

            Column::name('type')
                ->filterable(['post', 'article', 'image'])
                ->width(40),

            DateColumn::name('created_at')
                ->filterable(),

            Column::callback(['id', 'slug'], function ($id, $slug) {
                return view('table-views.actions-post', \compact('id', 'slug'));
            })
                ->label('Actions')
                ->width(50)
                ->excludeFromExport()
                ->unsortable(),
        ];
    }
}
