<x-jet-dropdown align="{{ $align ?? 'left' }}" width="48">
    <x-slot name="trigger">
        <x-jet-secondary-button variant='white'>
            <svg xmlns="http://www.w3.org/2000/svg" class="{{ $size ?? 'h-5 w-5' }}" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z" />
            </svg>
        </x-jet-secondary-button>
    </x-slot>

    <x-slot name="content">
        {{-- <x-jet-dropdown-link class="flex items-center" target='_blank'
            href="https://www.facebook.com/sharer/sharer.php?u={{ route('post.show', $post->slug) }}">
            <svg fill="#1877F2" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                class="w-4 h-4 mr-2" viewBox="0 0 24 24">
                <path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z">
                </path>
            </svg>
            {{ __('Facebook') }}
        </x-jet-dropdown-link>
        <x-jet-dropdown-link
            href="https://twitter.com/share?ref_src={{ route('post.show', $post->slug) }}"
            target='_blank' class="flex items-center twitter-share-button" data-show-count="true">
            <svg fill="#1DA1F2" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                class="w-4 h-4 mr-2" viewBox="0 0 24 24">
                <path
                    d="M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 00-7.86 3v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2c9 5 20 0 20-11.5a4.5 4.5 0 00-.08-.83A7.72 7.72 0 0023 3z">
                </path>
            </svg>
            {{ __('Twitter') }}
        </x-jet-dropdown-link>
        <x-jet-dropdown-link class="flex items-center" target="_blank"
            href="https://www.linkedin.com/sharing/share-offsite/?url={{ route('post.show', $post->slug) }}">
            <svg fill="#0A66C2" stroke=" currentColor" stroke-linecap="round" stroke-linejoin="round"
                stroke-width="0" class="w-4 h-4 mr-2" viewBox="0 0 24 24">
                <path stroke="none"
                    d="M16 8a6 6 0 016 6v7h-4v-7a2 2 0 00-2-2 2 2 0 00-2 2v7h-4v-7a6 6 0 016-6zM2 9h4v12H2z">
                </path>
                <circle cx="4" cy="4" r="2" stroke="none"></circle>
            </svg>
            {{ __('Linked In') }}
        </x-jet-dropdown-link> --}}
        <x-jet-dropdown-link class="flex items-center" href="https://api.whatsapp.com/send?text={{ urlencode($whatsapp) }}"
            target="_blank">
            <svg fill="#25D366" class="h-4 w-4 mr-2" role="img" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z" />
            </svg>
            {{ __('Whatsapp') }}
        </x-jet-dropdown-link>
        <x-jet-dropdown-link data-clipboard-text="{{ $copy }}" class="flex items-center copy-link">
            <svg class="h-4 w-4 mr-2" role="img" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" />
            </svg>
            {{ __('Copy Link') }}
        </x-jet-dropdown-link>
    </x-slot>
</x-jet-dropdown>
