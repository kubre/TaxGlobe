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

    public $hideable = 'select';

    public $exportable = true;

    public $showOnlyReported = false;

    public function builder()
    {
        return Post::when($this->showOnlyReported, function ($query) {
            $query->whereNotNull('reported_at');
        });
    }

    public function columns()
    {
        $disk = 'posts';

        $columns = [
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
                ->excludeFromExport()
                ->width(30),

            Column::name('type')
                ->filterable(['post', 'article', 'image'])
                ->width(40),

            NumberColumn::name('like_count')
                ->filterable()
                ->hide()
                ->width(100),

            NumberColumn::name('comment_count')
                ->filterable()
                ->hide()
                ->width(100),

            Column::name('user.name')
                ->searchable()
                ->filterable()
                ->label('Author')
                ->width(40),

            DateColumn::name('created_at')
                ->filterable(),
        ];

        if ($this->showOnlyReported) {
            $columns = array_merge($columns, [
                Column::name('reported_reason')
                    ->filterable(Post::$reportReasons)
                    ->width(100)
            ]);
        }
        return \array_merge($columns, [
            Column::callback(['id', 'slug'], function ($id, $slug) {
                return view('table-views.actions-post', \compact('id', 'slug'));
            })
                ->label('Actions')
                ->width(50)
                ->excludeFromExport()
                ->unsortable()
        ]);
    }
}
