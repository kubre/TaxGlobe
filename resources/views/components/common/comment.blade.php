<div class="flex flex-row items-center space-x-2 py-2">
    <img class='h-8 w-8 rounded-full' src="{{ $comment->user->profile_photo_url }}"
        alt="{{ $comment->user->name }}">
    <div>
        <span class="text-gray-700 mr-1">{{ $comment->user->name }}&nbsp;<span
                class="text-xs">({{ $comment->created_at->diffForHumans(null, false, true) }}):
            </span></span>
        {{ $comment->body }}
    </div>
</div>
