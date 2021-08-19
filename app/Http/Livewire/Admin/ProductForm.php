<?php

namespace App\Http\Livewire\Admin;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithFileUploads;

class ProductForm extends Component
{
    use WithFileUploads;

    public $state = [];

    public $oldImages;

    public $messages = [
        'state.title.required' => 'Title is required.',
        'state.images.*.image' => 'Images should be only JPG and PNG.',
        'state.images.*.max' => 'Maximum each file can be 2MB for better loading.',
        'state.images.required' => 'Images of product are required.',
        'state.images.max' => 'Maximum 5 image of product can be uploaded.',
        'state.type.required' => 'Type for product is required.',
        'state.download.required_if' => 'File is required if type is set to download',
        // 'state.download.mimes' => 'File must be ony type PDF, DOCX, XLSX or ZIP',
        'state.short_description.max' => 'Short Description of product cannot be more than 500 characters long. ',
        'state.full_description.required' => 'Full Description of product is required.',
        'state.price.required' => 'Price is required.',
        'state.price.number' => 'Price must be a whole number.',
        'state.price.min' => 'Price should not be less than 0',
        'state.discount.required' => 'Discount is required.',
        'state.discount.number' => 'Discount must be a whole number.',
        'state.discount.min' => 'Discount should not be less than 0',
    ];

    public function rules()
    {
        $rules = [
            'state.title' => 'required',
            'state.type' => 'required',
            'state.short_description' => 'nullable|max:500',
            'state.full_description' => 'required',
            'state.price' => 'required|numeric|min:0',
            'state.discount' => 'nullable|numeric|min:0',
        ];
        if (!isset($this->state['id'])) {
            $rules = \array_merge($rules, [
                'state.images.*' => 'image|max:2000',
                'state.images' => 'required|max:5',
                'state.download' => 'required_if:state.type,download|file',
            ]);
        }
        return $rules;
    }

    public function mount(?Product $product)
    {
        $this->state = $product->toArray();
        if ($product->exists) {
            $this->oldImages = $product->getMedia('images');
        }
    }

    public function render()
    {
        return view('components.admin.product-form')
            ->layout('layouts.admin')
            ->slot('content');
    }

    public function save()
    {
        $this->validate();

        $product = new Product();

        if (isset($this->state['id'])) {
            $product = Product::find($this->state['id']);
        }

        $saved = $product->fill($this->state)->save();

        if ($saved) {
            if (isset($this->state['images'])) {
                if (isset($this->state['id'])) {
                    $product->getMedia('images')->each->delete();
                }
                foreach ($this->state['images'] as $image) {
                    $product
                        ->addMedia($image->getRealPath())
                        ->usingName($image->getClientOriginalName())
                        ->toMediaCollection('images');
                }
            }

            if (isset($this->state['download'])) {
                if (isset($this->state['id'])) {
                    optional($product->getMedia('download')->first())->delete();
                }
                $product
                    ->addMedia($this->state['download']->getRealPath())
                    ->usingName($this->state['download']->getClientOriginalName())
                    ->toMediaCollection('download');
            }
        }

        $this->dispatchBrowserEvent('toast', [
            'title' => 'Form saved successfully!',
            'icon' => 'success',
        ]);

        return \redirect()->route('admin.products.list');
    }
}
