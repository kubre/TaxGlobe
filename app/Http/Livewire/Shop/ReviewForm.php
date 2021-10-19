<?php

namespace App\Http\Livewire\Shop;

use App\Models\Review;
use Livewire\Component;

class ReviewForm extends Component
{

    public $reviewDraft;
    public $rating;

    public $productId;

    public $rules = [
        'reviewDraft' => ['required', 'max:500'],
        'rating' => ['required', 'numeric', 'max:5', 'min:1'],
    ];

    public $messages = [
        'reviewDraft.*' => 'Review is required and must be less than 500 charcters.',
        'rating.*' => 'Rating for a review is required.',
    ];

    public function mount()
    {
        $this->reviewDraft = '';
        $this->rating = 1;
    }

    public function render()
    {
        return view('components.shop.review-form');
    }

    public function publishReview()
    {
        $this->validate();

        Review::create([
            'user_id' => auth()->id(),
            'product_id' => $this->productId,
            'body' => $this->reviewDraft,
            'rating' => $this->rating,
        ]);

        $this->reviewDraft = '';
        $this->rating = 1;

        return $this->dispatchBrowserEvent('toast', [
            'icon' => 'success',
            'title' => 'You review has been published!'
        ]);
    }
}
