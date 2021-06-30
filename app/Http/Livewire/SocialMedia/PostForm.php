<?php

namespace App\Http\Livewire\SocialMedia;

use App\Models\Post;
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

    protected $rules = [
        'title' => 'nullable|max:150',
        'body' => 'nullable',
        'image' => 'nullable|image|max:2048',
    ];

    public function mount(string $type = 'article')
    {
        $this->type = $type;
    }

    public function render()
    {
        return view('components.social-media.post-form');
    }

    public function save(Post $post)
    {
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

        return \redirect()->route('feed.index');
    }
}
