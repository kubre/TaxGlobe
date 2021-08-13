<div class="border-b">

    @push('styles')
        <style>
            .ck-editor__editable {
                min-height: 600px;
            }

            .focus-grow:focus {
                height: 4rem;
            }

        </style>
    @endpush

    <x-partials.grid isCompact='{{ $isCompact }}'>
        <div class="{{ $isCompact ?? false ? 'px-4' : 'p-8' }}" x-data="postFormComponent()">

            <h4 class="text-lg text-bold mb-2">
                {{ is_null($postId) ? 'New Post' : 'Update Content' }}
            </h4>

            <form wire:submit.prevent="{{ is_null($postId) ? 'save' : 'save(' . $postId . ')' }}" method="post"
                enctype="multipart/form-data" x-cloak>
                @if ($type == \App\Models\Post::TYPE_ARTICLE)
                    <div class="flex justify-end">
                        <x-jet-button id='submit' class="">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            {{ __('Post') }}
                        </x-jet-button>
                    </div>
                    <div>
                        <x-jet-label for="title" value="{{ __('Title *') }}" />
                        <x-jet-input id="title" class="block mt-1 w-full" type="text" name="title"
                            wire:model.defer="title" autofocus />
                        <x-jet-input-error for='title' />
                    </div>
                    <div class="block mt-2">
                        <x-jet-label for="image" value="{{ __('Header Image') }}" />
                        @if (!is_null($postId))
                            <div x-show='!showUpdateImage' class='flex flex-col space-y-2 mb-2 items-center'>
                                <strong>Old Image</strong>
                                <div class="w-full bg-red-50 rounded-lg py-2 flex justify-center">
                                    <img src="{{ Storage::disk('posts')->url($oldImage) }}"
                                        class="rounded-lg object-fit" style="max-height: 256px">
                                </div>
                                <x-jet-secondary-button class='mt-2' @click='showUpdateImage=true' variant='warning'>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    <span>
                                        {{ __('Upload new Image') }}
                                    </span>
                                </x-jet-secondary-button>
                            </div>
                        @endif
                        <div class="flex flex-col space-y-2 mb-2" x-show='showUpdateImage'>
                            <strong>Upload an Image</strong>
                            <x-common.filepond wire:model.defer="image" allowImagePreview imagePreviewMaxHeight="200"
                                allowFileTypeValidation acceptedFileTypes="['image/jpeg']" allowFileSizeValidation
                                maxFileSize="2mb" />
                            <x-jet-input-error for='image' />
                        </div>
                    </div>
                    <div class="mt-4" wire:ignore>
                        <x-jet-label for="body" value="{{ __('Content *') }}" />
                        <textarea id="body" class="block mt-2" wire:model.defer='body'
                            name="body">{{ $body }}</textarea>
                        <x-jet-input-error for='body' />
                    </div>

                    @if (is_null($postId))
                        <div class="my-4">
                            <div>{{ count($attachments) }} file/files are uploaded</div>
                            <x-jet-label for="attachments" value="{{ __('Attachments') }}" />
                            <x-jet-input class="mt-1" type="file" multiple accept="application/pdf,image/jpeg" wire:model.defer="attachments" />
                            <x-jet-input-error for="attachments.*" />
                            <x-jet-input-error for="attachments" />
                        </div>
                    @endif
                @else
                    <div class="pt-2 pb-1" x-show="type === '{{ \App\Models\Post::TYPE_IMAGE }}'">
                        @if (!is_null($postId))
                            <div x-show='!showUpdateImage' class='flex flex-col space-y-2 mb-2 items-center'>
                                <strong>Old Image</strong>
                                <div class="w-full bg-red-50 rounded-lg py-2 flex justify-center">
                                    <img src="{{ Storage::disk('posts')->url($oldImage) }}"
                                        class="rounded-lg object-fit" style="max-height: 256px">
                                </div>
                                <x-jet-secondary-button class='mt-2' @click='showUpdateImage=true' variant='warning'>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    <span>
                                        {{ __('Upload new Image') }}
                                    </span>
                                </x-jet-secondary-button>
                            </div>
                        @endif
                        <div class="flex flex-col space-y-2 mb-2" x-show='showUpdateImage'>
                            <strong>Upload an Image</strong>
                            <x-common.filepond wire:model.defer="image" allowImagePreview imagePreviewMaxHeight="200"
                                allowFileTypeValidation acceptedFileTypes="['image/jpeg']" allowFileSizeValidation
                                {{-- :files="is_null($image) ? [] : [$image]" --}} maxFileSize="2mb" />
                            <x-jet-input-error for='image' />
                        </div>
                    </div>
                    <div>
                        <textarea x-model='post' x-init="resize(document.getElementById('title'))"
                            @input="resize(document.getElementById('title'))" id="title"
                            class="border-gray-300 focus:border-indigo-300 rounded-md shadow-sm w-full resize-none"
                            :class="{ 'ring ring-red-300 focus:ring focus:ring-red-300' : post.length > 500, 'h-11' : type === '{{ \App\Models\Post::TYPE_IMAGE }}' }"
                            type="text" name="title"
                            :placeholder="type === '{{ \App\Models\Post::TYPE_IMAGE }}' ? 'Caption' : 'Write a Post'"
                            wire:model.defer="title" autofoucs></textarea>
                        <div class='-mt-7 mr-2 text-gray-500 text-right' x-text='post.length + "/500"'>
                        </div>
                        <x-jet-input-error for='title' />
                    </div>
                @endif

                <div class="{{ $isCompact ?? false ? 'space-x-2 flex justify-between' : '' }} mt-4">
                    <x-jet-button id='submit' x-bind:disabled='post.length > 500'>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        {{ __('Post') }}
                    </x-jet-button>
                    @if ($isCompact ?? false)
                        <div class="space-x-2 flex">
                            @if ($type == \App\Models\Post::TYPE_IMAGE)
                                <x-jet-button type='button'
                                    wire:click="$set('type', '{{ \App\Models\Post::TYPE_POST }}')" wire:disabled
                                    x-data='{hover: false}' @mouseover='hover = true' @mouseleave='hover = false'>
                                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M16.3725 11.6213C17.9412 11.6213 19 12.7132 19 14.3309C19 15.7868 17.7843 17 16.1373 17C14.3333 17 13 15.5441 13 13.3199C13 8.26471 16.6863 6.24265 19 6L19 8.22426C17.4314 8.50735 15.6667 10.0846 15.5882 11.8235C15.6667 11.7831 15.9804 11.6213 16.3725 11.6213Z"
                                            fill="currentColor"></path>
                                        <path
                                            d="M8.37255 11.6213C9.94118 11.6213 11 12.7132 11 14.3309C11 15.7868 9.78431 17 8.13725 17C6.33333 17 5 15.5441 5 13.3199C5 8.26471 8.68627 6.24265 11 6V8.22426C9.43137 8.50735 7.66667 10.0846 7.58824 11.8235C7.66667 11.7831 7.98039 11.6213 8.37255 11.6213Z"
                                            fill="currentColor"></path>
                                    </svg>
                                    <span class='ml-2' x-show='hover'>
                                        {{ __('Post') }}
                                    </span>
                                </x-jet-button>
                            @elseif($type == \App\Models\Post::TYPE_POST)
                                <x-jet-secondary-button wire:click="readyFileUpload" wire:disabled variant='warning'
                                    x-data='{hover: false}' @mouseover='hover = true' @mouseleave='hover = false'>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    <span class='ml-2' x-show='hover'>
                                        {{ __('Image') }}
                                    </span>
                                </x-jet-secondary-button>
                            @endif
                            <x-jet-secondary-button
                                @click="window.location = '{{ route('posts.form', \App\Models\Post::TYPE_ARTICLE) }}'"
                                variant='success' class='self-end' type='button' x-data='{hover: false}'
                                class="transition duration-150" @mouseover='hover = true' @mouseleave='hover = false'>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                                <span x-show='hover' class='ml-2'>
                                    {{ __('Write article') }}
                                </span>
                            </x-jet-secondary-button>
                        </div>
                    @endif
                </div>
            </form>
        </div>
    </x-partials.grid>

    @push('scripts')
        <script>
            function postFormComponent() {
                return {
                    post: @entangle('title').defer,
                    type: @entangle('type').defer,
                    resize: function(el) {
                        if (this.type === '{{ \App\Models\Post::TYPE_POST }}') {
                            el.style.height = '76px';
                            el.style.height = (el.scrollHeight >= 74 && el.scrollHeight < 220) ? el.scrollHeight + 'px' :
                                '220px';
                        }
                    },
                    showUpdateImage: '{{ is_null($postId) || is_null($oldImage) }}'
                };
            }
        </script>
        @if ($type == \App\Models\Post::TYPE_ARTICLE)
            <script src="{{ asset('js/vendor/ckeditor.js') }}"></script>
            <script>
                if (document.querySelector('#body')) {
                    class MyUploadAdapter {
                        constructor(loader) {
                            this.loader = loader;
                        }

                        upload() {
                            return this.loader.file
                                .then(file => new Promise((resolve, reject) => {
                                    this._initRequest();
                                    this._initListeners(resolve, reject, file);
                                    this._sendRequest(file);
                                }));
                        }

                        _initRequest() {
                            const xhr = this.xhr = new XMLHttpRequest();

                            xhr.open('POST', '/imageUpload', true);
                            xhr.setRequestHeader('x-csrf-token', '{{ csrf_token() }}');
                            xhr.responseType = 'json';
                        }

                        _initListeners(resolve, reject, file) {
                            const xhr = this.xhr;
                            const loader = this.loader;
                            const genericErrorText = `Couldn't upload file: ${ file.name }.`;

                            xhr.addEventListener('error', () => reject(genericErrorText));
                            xhr.addEventListener('abort', () => reject());
                            xhr.addEventListener('load', () => {
                                const response = xhr.response;
                                if (!response || response.error) {
                                    return reject(response && response.error ? response.error.message :
                                        genericErrorText);
                                }

                                resolve({
                                    default: response.url
                                });
                            });

                            if (xhr.upload) {
                                xhr.upload.addEventListener('progress', evt => {
                                    if (evt.lengthComputable) {
                                        loader.uploadTotal = evt.total;
                                        loader.uploaded = evt.loaded;
                                    }
                                });
                            }
                        }

                        _sendRequest(file) {
                            const data = new FormData();

                            data.append('upload', file);

                            this.xhr.send(data);
                        }

                        abort() {
                            if (this.xhr) {
                                this.xhr.abort();
                            }
                        }
                    }

                    function MyCustomUploadAdapterPlugin(editor) {
                        editor.plugins.get('FileRepository').createUploadAdapter = (loader) => {
                            return new MyUploadAdapter(loader);
                        };
                    }

                    ClassicEditor
                        .create(document.querySelector('#body'), {
                            extraPlugins: [MyCustomUploadAdapterPlugin],
                            mediaEmbed: {
                                previewsInData: true
                            }
                        })
                        .then(function(editor) {

                            editor.plugins.get('FileRepository').createUploadAdapter = (loader) => {
                                return new MyUploadAdapter(loader);
                            };

                            document.getElementById('submit').addEventListener('click', function() {
                                @this.set('body', editor.getData());
                            })
                        })
                        .catch(function(error) {
                            console.error(error);
                        });
                }
            </script>
        @endif
    @endpush
</div>
