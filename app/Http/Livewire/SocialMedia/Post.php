<?php

namespace App\Http\Livewire\SocialMedia;

use Livewire\Component;
use App\Models\Post as PostModel;
use App\Traits\CustomWithPagination;

class Post extends Component
{
    use CustomWithPagination;

    public PostModel $post;

    public bool $fullPage = false;

    public bool $showComments = false;

    public string $commentDraft = '';

    private $comments;

    public $uniqueId;

    protected $listeners = ['commentChanged' => 'loadComments'];

    public $hasLiked = false;

    public $pageName = 'commentPage';

    public function mount()
    {
        if (auth()->check()) {
            $this->hasLiked = $this->post->likedUsers->isNotEmpty();
        }
    }

    public function render()
    {
        if ($this->showComments || $this->fullPage) {
            $this->loadComments();
        }
        return view('components.social-media.post', [
            'comments' => $this->comments,
        ]);
    }

    public function toggleLike()
    {
        if (!auth()->check()) {
            return;
        }
        $this->hasLiked = $this->post->toggleLikeFrom(\auth()->id());
        $this->emit('toggledLike', $this->post->id);
    }

    public function publishComment()
    {
        if (!auth()->check()) {
            return;
        }
        $this->validate([
            'commentDraft' => ['required', 'string', 'max:500'],
        ]);

        $this->post->addCommentFrom($this->commentDraft, \auth()->id());

        $this->resetPage();

        $this->emitSelf('commentChanged');
    }

    public function loadComments()
    {
        $this->commentDraft = '';
        $this->showComments = true;
        $this->comments = $this->post
            ->comments()
            ->with('user')
            ->orderBy('id', 'DESC')
            ->simplePaginate(5, ['*'], $this->pageName);

        $this->emitUp('commentsChanged');
    }
}
