<div>

    @push('styles')
        <style>
            .ck-editor__editable {
                min-height: 250px;
            }

            .ck-editor__main ul li {
                list-style-type: disc;
                margin-left: 20px;
            }

            .ck-editor__main ol li {
                list-style-type: decimal;
                margin-left: 20px;
            }

            .ck-editor__main ul li {
                list-style-type: disc;
                margin-left: 20px;
            }

            .ck-editor__main h2 {
                font-size: 1.5em;
                font-weight: bold;
            }

            .ck-editor__main h3 {
                font-size: 1.17em;
                font-weight: bold;
            }

            .ck-editor__main h4 {
                font-size: 1em;
                font-weight: bold;
            }

        </style>
    @endpush

    <x-slot name="title">
        {{ __('Product Form') }}
    </x-slot>
    <x-slot name="titleIcon">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewbox="0 0 24 24"
            stroke="currentcolor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M17 14v6m-3-3h6M6 10h2a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v2a2 2 0 002 2zm10 0h2a2 2 0 002-2V6a2 2 0 00-2-2h-2a2 2 0 00-2 2v2a2 2 0 002 2zM6 20h2a2 2 0 002-2v-2a2 2 0 00-2-2H6a2 2 0 00-2 2v2a2 2 0 002 2z" />
        </svg>
    </x-slot>
    {{-- basic info update section --}}
    <div class="my-4" x-data="productForm()">
        <x-jet-form-section submit="save">
            <x-slot name="title">
                {{ __('Details') }}
            </x-slot>

            <x-slot name="description">
                {{ __('Details of product') }}
            </x-slot>

            <x-slot name="form">

                <div class="col-span6 sm:col-span-4">
                    <x-jet-validation-errors class="mb-4" />
                </div>

                <div class="col-span-6 sm:col-span-4">
                    <x-jet-label for="type" value="{{ __('Product Type') }}" />
                    <x-widgets.select id="type" class="block mt-1 w-full" type="text" name="type" x-model="type"
                        wire:model.defer="state.type" default="--Select Type--" :options="[
                        'download' => 'Download',
                        'deliver' => 'Deliver',
                    ]">
                    </x-widgets.select>
                    <x-jet-input-error for='state.type' />
                </div>

                <div class="col-span-6 sm:col-span-4" x-show="type === 'download'">
                    <x-jet-label for="state.download" value="{{ __('File for download') }}" />
                    <x-jet-input class="mt-1" type="file" wire:model.defer="state.download" />
                    @isset($state['id'])
                        <div class="text-gray-500">If you want to change downloadble file upload new file, otherwise old
                            file will be used.</div>
                    @endisset
                    <x-jet-input-error for="state.download" />
                </div>

                <div class="col-span-6 sm:col-span-4">
                    <x-jet-label for="title" value="{{ __('Product Title') }}" />
                    <x-jet-input id="title" class="block mt-1 w-full" type="text" name="title"
                        wire:model.defer="state.title" />
                    <x-jet-input-error for='state.title' />
                </div>

                <div class="col-span-6 sm:col-span-4">
                    <x-jet-label for="state.images" value="{{ __('Images') }}" />
                    <x-jet-input class="mt-1" type="file" multiple accept="image/jpeg"
                        wire:model.defer="state.images" />
                    @isset($state['images'])
                        <div class="flex flex-wrap mt-2 space-x-2">
                            @foreach ($state['images'] as $image)
                                <div class="w-32 h-32 relative">
                                    <img class="rounded w-full h-full object-fill" src="{{ $image->temporaryUrl() }}">
                                    <x-jet-secondary-button class="absolute top-1 right-1 px-1 rounded-full"
                                        x-on:click="removeUpload('{{ $image->getFilename() }}')" variant="white">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </x-jet-secondary-button>
                                </div>
                            @endforeach
                        </div>
                    @endisset
                    @if (isset($state['id']) && empty($state['images']))
                        <div class="text-gray-500 mt">
                            Uploading new images will replace old ones.
                        </div>
                        <div class="flex space-x-2">
                            @foreach ($oldImages as $image)
                                <div class="w-32 h-32">
                                    <img class="rounded w-full h-full object-fill" src="{{ $image->getUrl() }}">
                                </div>
                            @endforeach
                        </div>
                    @endif
                    <div class="text-gray-600 text-sm mt-1">
                        600x600px or 1200x1200 JPG format images are best to suit all screen sizes.
                    </div>
                    <x-jet-input-error for="state.images.*" />
                    <x-jet-input-error for="state.images" />
                </div>

                <div class="col-span-6 sm:col-span-4">
                    <x-jet-label for="short_description" value="{{ __('Short Description') }}" />
                    <x-jet-input id="short_description" class="block mt-1 w-full" type="text" name="short_description"
                        wire:model.defer="state.short_description" />
                    <x-jet-input-error for='state.short_description' />
                </div>
                <div class="col-span-6 sm:col-span-4">
                    <x-jet-label for="price" value="{{ __('Price (in ₹)') }}" />
                    <x-jet-input id="price" class="block mt-1 w-full" type="number" name="price"
                        wire:model.defer="state.price" />
                    <x-jet-input-error for='state.price' />
                </div>
                <div class="col-span-6 sm:col-span-4">
                    <x-jet-label for="discount" value="{{ __('Discount (in ₹)') }}" />
                    <x-jet-input id="discount" class="block mt-1 w-full" name="discount" type="number"
                        wire:model.defer="state.discount" />
                    <x-jet-input-error for='state.discount' />
                </div>
                <div class="col-span-6 sm:col-span-4">
                    <x-jet-label for="stock" value="{{ __('Units in Stock') }}" />
                    <x-jet-input id="stock" class="block mt-1 w-full" type="number" name="stock"
                        wire:model.defer="state.stock" />
                    <x-jet-input-error for='state.stock' />
                </div>
                <div class="col-span-6 sm:col-span-4" wire:ignore>
                    <x-jet-label for="full_description" value="{{ __('Full Description') }}"
                        class="mb-2" />
                    <textarea id="full_description" class="block" wire:model.defer='state.full_description'
                        name="full_description">{!! $state['full_description'] ?? null !!}</textarea>
                    <x-jet-input-error for='state.full_description' />
                </div>
            </x-slot>
            <x-slot name="actions">
                <x-jet-action-message class="mr-3" on="saved">
                    {{ __('saved.') }}
                </x-jet-action-message>

                <x-jet-button wire:loading.attr="disabled" id="submit">
                    {{ __('save') }}
                </x-jet-button>
            </x-slot>
        </x-jet-form-section>
    </div>

    @push('scripts')
        <script src="{{ asset('js/vendor/ckeditor.js') }}"></script>
        <script>
            if (document.querySelector('#full_description')) {
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
                    .create(document.querySelector('#full_description'), {
                        extraPlugins: [MyCustomUploadAdapterPlugin],
                        mediaEmbed: {
                            previewsInData: true
                        }
                    })
                    .then(function(editor) {

                        editor.plugins.get('FileRepository').createUploadAdapter = (loader) => {
                            return new MyUploadAdapter(loader);
                        };


                        editor.model.document.on('change:data', () => {
                            console.log(editor.getData());
                        })

                        document.getElementById('submit').addEventListener('click', function() {
                            @this.set('state.full_description', editor.getData());
                        })
                    })
                    .catch(function(error) {
                        console.error(error);
                    });
            }
        </script>
        <script>
            function productForm() {
                return {
                    type: @entangle('state.type').defer,
                    removeUpload: function(filename) {
                        @this.removeUpload('state.images', filename);
                    }
                }
            }
        </script>
    @endpush
</div>
