<?php

namespace App\Http\Livewire\SocialMedia;

use App\Models\Post as PostModel;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class PostForm extends Component
{
    use WithFileUploads;

    public $type;

    public $title;
    public $body;
    public $image;

    public bool $isCompact = false;

    protected function rules()
    {
        $isImage = $this->type === 'image';
        return [
            'title' => 'required_if:image,null|max:500',
            'body' => 'nullable',
            'image' => [
                function ($attribute, $value, $fail) use ($isImage) {
                    if ($isImage && is_null($value)) {
                        $fail('At least image is required');
                    }
                },
                'max:2048',
            ],
        ];
    }

    protected $messages = [
        'title.required_if' => 'Post should not be empty!',
    ];

    public function mount(string $type = 'article')
    {
        $this->type = $type;
    }

    public function render()
    {
        return view('components.social-media.post-form');
    }

    public function save(PostModel $post)
    {
        $this->validate();

        if (!is_null($this->image)) {
            $file = $this->image->store('/', 'posts');
        }

        $saved = $post->fill([
            'title' => $this->title,
            'body' => $this->body,
            'image' => $file ?? null,
            'slug' => Str::of($this->title)->limit(80)->slug()->append('-', Str::random(12)),
            'user_id' => \auth()->id(),
            'type' => $this->type,
        ])->save();

        if (!$saved && !is_null($this->image)) {
            Storage::disk('posts')->delete($file);
        }

        if ($saved) {
            \auth()->user()->increment('points');
        }

        return \redirect()->route('feed.index');
    }


    public function readyFileUpload($imageOnly = true)
    {
        if ($imageOnly) {
            $this->type = PostModel::TYPE_IMAGE;
        }

        $this->emit('initFilepond');
    }
}
