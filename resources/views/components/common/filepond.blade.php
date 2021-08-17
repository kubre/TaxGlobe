@props(['files'])
<div wire:ignore x-data x-init="
        () => {
            const post = FilePond.create($refs.{{ $attributes->get('ref') ?? 'input' }});
            post.setOptions({
                allowMultiple: {{ $attributes->has('multiple') ? 'true' : 'false' }},
                files: {{ isset($files) ? json_encode($files) : '[]' }},
                server: {
                    process:(fieldName, file, metadata, load, error, progress, abort, transfer, options) => {
                        @this.upload('{{ $attributes->whereStartsWith('wire:model')->first() }}', file, load, error, progress)
                    },
                    revert: (filename, load) => {
                        {{-- post.removeFile(); --}}
                        @this.removeUpload('{{ $attributes->whereStartsWith('wire:model')->first() }}', filename, load)
                    },

                },
                allowImagePreview: {{ $attributes->has('allowFileTypeValidation') ? 'true' : 'false' }},
                imagePreviewMaxHeight: {{ $attributes->has('imagePreviewMaxHeight') ? $attributes->get('imagePreviewMaxHeight') : '256' }},
                filePosterHeight: {{ $attributes->has('filePosterHeight') ? $attributes->get('filePosterHeight') : '256' }},
                allowFileTypeValidation: {{ $attributes->has('allowFileTypeValidation') ? 'true' : 'false' }},
                acceptedFileTypes: {!! $attributes->get('acceptedFileTypes') ?? 'null' !!},
                allowFileSizeValidation: {{ $attributes->has('allowFileSizeValidation') ? 'true' : 'false' }},
                maxFileSize: {!! $attributes->has('maxFileSize') ? "'" . $attributes->get('maxFileSize') . "'" : 'null' !!}
            });
        }
    ">
    <input type="file" x-ref="{{ $attributes->get('ref') ?? 'input' }}" />
</div>

@push('styles')
    @once
        <link href="{{ asset('css/vendor/filepond.css') }}" rel="stylesheet">
        <link href="{{ asset('css/vendor/filepond-image.css') }}" rel="stylesheet">
        {{-- <link href="{{ asset('css/vendor/filepond-poster.css') }}" rel="stylesheet" /> --}}
    @endonce
@endpush

@push('scripts')
    @once
        <script src="{{ asset('js/vendor/filepond-size.js') }}"></script>
        <script src="{{ asset('js/vendor/filepond-type.js') }}"></script>
        <script src="{{ asset('js/vendor/filepond-image-preview.js') }}"></script>
        {{-- <script src="{{ asset('js/vendor/filepond-poster.js') }}"></script> --}}
        <script src="{{ asset('js/vendor/filepond.js') }}"></script>
        <script>
            FilePond.registerPlugin(FilePondPluginFileValidateType);
            FilePond.registerPlugin(FilePondPluginFileValidateSize);
            FilePond.registerPlugin(FilePondPluginImagePreview);
            // FilePond.registerPlugin(FilePondPluginFilePoster);
        </script>
    @endonce
@endpush
