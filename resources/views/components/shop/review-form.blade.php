<div class="mt-2" x-data="{ review: @entangle('reviewDraft').defer , rating: @entangle('rating').defer }">
    <form wire:submit.prevent="publishReview">
        <div class="flex flex-col space-y-4">
            <div class='flex-grow'>
                <textarea x-model='review'
                    class="border-gray-300 focus:border-indigo-300 rounded-md shadow-sm w-full resize-none h-16"
                    x-bind:class='{ "ring ring-red-300 focus:ring focus:ring-red-300" : (review && review.length > 500) }'
                    name="reviewDraft" id='reviewDraft' placeholder='Write a Review'
                    wire:model.defer="reviewDraft"></textarea>
                <div class='-mt-8 mr-2 text-gray-500 text-right' x-text='review ? review.length + "/500" : "0/500"'>
                </div>
            </div>

            <div class="flex space-x-4 justify-between items-center">
                <div class="flex space-x-1">
                    <input type="hidden" x-model="rating" wire:model.defer="rating">
                    <template x-for="i in [1, 2, 3, 4, 5]">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 fill-current text-gray-300"
                            x-bind:class="{ 'text-yellow-500' : i <= rating}" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" x-on:click="rating = i">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                        </svg>
                    </template>
                </div>
                <x-jet-secondary-button wire:loading.attr="disabled" type='submit' variant='secondary'>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 transform rotate-90" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                    </svg>
                    Submit
                </x-jet-secondary-button>
            </div>
        </div>
        @error('reviewDraft')
            <div class="text-red-500 text-sm mt-1">
                Review is requried and must be less than 500 characters.
            </div>
        @enderror
        @error('rating')
            <div class="text-red-500 text-sm mt-1">
                Rating is requried.
            </div>
        @enderror
    </form>
</div>
