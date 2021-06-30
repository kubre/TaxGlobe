<div class="border-b">

    @push('styles')
        <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css"
            rel="stylesheet" />
        <link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet">
        <style>
            .ck-editor__editable {
                min-height: 300px;
            }

            .focus-grow:focus {
                height: 4rem;
            }

        </style>
    @endpush

    <x-partials.grid isCompact='{{ $isCompact }}'>
        <div class="{{ $isCompact ?? false ? 'px-4' : 'p-8' }}" x-data='{post: ""}'>
            <form wire:submit.prevent="save" method="post" enctype="multipart/form-data">
                @if ($type == \App\Models\Post::TYPE_ARTICLE)
                    <div>
                        <x-jet-label for="title" value="{{ __('Title') }}" />
                        <x-jet-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title')"
                            wire:model.defer="title" autofocus />
                        <x-jet-input-error for='title' />
                    </div>
                    <div class="mt-4" wire:ignore>
                        <x-jet-label for="body" value="{{ __('Body') }}" />
                        <textarea id="body" class="block mt-2" wire:model.defer='body' name="body"></textarea>
                        <x-jet-input-error for='body' />
                    </div>
                @elseif($type == \App\Models\Post::TYPE_POST)
                    <div>
                        <textarea x-model='post'
                            class="border-gray-300 focus:border-indigo-300 rounded-md shadow-sm w-full resize-none"
                            :class='{ "ring ring-red-300 focus:ring focus:ring-red-300" : post.length > 150 }'
                            type="text" name="title" placeholder='Write a Post' wire:model.defer="title"
                            autofoucs></textarea>
                        <div class='-mt-7 mr-2 text-gray-500 text-right' x-text='post.length + "/150"'>
                        </div>
                        <x-jet-input-error for='title' />
                    </div>
                @elseif($type == \App\Models\Post::TYPE_IMAGE)
                    <div class="pt-2 pb-1">
                        <input type="file" class="filepond" wire:model='image' />
                    </div>
                @endif

                <div class="{{ $isCompact ?? false ? 'space-x-2 flex justify-between' : '' }} mt-4">
                    <x-jet-button id='submit' x-bind:disabled='post.length > 150'>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        {{ __('Publish') }}
                    </x-jet-button>
                    @if ($isCompact ?? false)
                        <div class="space-x-2 hidden sm:flex">
                            <x-jet-secondary-button wire:click="$set('type', '{{ \App\Models\Post::TYPE_IMAGE }}')"
                                wire:disabled variant='warning'>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                {{ __('Image') }}
                            </x-jet-secondary-button>
                            <x-jet-secondary-button
                                @click="window.location = '{{ route('posts.form', \App\Models\Post::TYPE_ARTICLE) }}'"
                                variant='success' class='self-end' type='button'>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                                {{ __('Write article') }}
                            </x-jet-secondary-button>
                        </div>
                    @endif
                </div>
            </form>
        </div>
    </x-partials.grid>

    @push('scripts')

        <script src="https://cdn.ckeditor.com/ckeditor5/28.0.0/classic/ckeditor.js">
        </script>
        <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js">
        </script>
        <script src="https://unpkg.com/filepond/dist/filepond.js"></script>
        <script>
            FilePond.registerPlugin(FilePondPluginImagePreview);
            FilePond.parse(document.body);
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
                            .
                            if(!response || response.error) {
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
                        extraPlugins: [MyCustomUploadAdapterPlugin]
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
    @endpush
</div>
