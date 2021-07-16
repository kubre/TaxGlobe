<?php

namespace App\Http\Livewire\SocialMedia;

use App\Models\Post as PostModel;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class PostForm extends Component
{
    use WithFileUploads;
    use AuthorizesRequests;

    public $type;

    public $postId;
    public $title = '';
    public $body;
    public $slug;
    public $image;
    public $oldImage;

    public bool $isCompact = false;

    protected $messages = [
        'title.required_if' => 'Post should not be empty!',
    ];

    protected function rules()
    {
        $isImage = $this->type === 'image';
        $isNew = is_null($this->postId);
        return [
            'title' => 'required_if:image,null|max:500',
            'body' => 'nullable',
            'image' => [
                function ($attribute, $value, $fail) use ($isImage, $isNew) {
                    if ($isImage && is_null($value) && $isNew) {
                        $fail('At least image is required');
                    }
                },
                'max:2048',
            ],
        ];
    }

    public function mount(string $type, PostModel $post)
    {
        if (!is_null($post->id)) {
            $this->authorize('update', $post);
            $this->postId = $post->id;
            $this->title = $post->title;
            $this->body = $post->body;
            $this->slug = $post->slug;
            $this->oldImage = $post->image;
        }
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
            if (!is_null($this->oldImage)) {
                Storage::disk('posts')->delete($this->oldImage);
            }
        }

        if (!\is_null($this->postId) && \is_null($this->image)) {
            $file = $this->oldImage;
        }

        $saved = $post->fill([
            'title' => $this->title,
            'body' => $this->body,
            'image' => $file ?? null,
            'slug' => $this->slug ?? Str::of($this->title)->limit(80)->slug()->append('-', Str::random(12)),
            'user_id' => \auth()->id(),
            'type' => $this->type,
        ])->save();

        if (!$saved && !is_null($this->image)) {
            Storage::disk('posts')->delete($file);
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
/*
$imageUrl = Storage::disk('posts')->url($post->image);
$this->image = [
    'source' => $imageUrl,
    'options' => [
        'type' => 'local',
        'file' => [
            'name' => $imageUrl,
            'size' => Storage::disk('posts')->size($post->image),
            'type' => Storage::disk('posts')->mimeType($post->image),
        ],
        'metadata' => [
            'poster' => $imageUrl,
        ],
    ],
];
*/
