<div class="h-10 w-10">
    @if ($image)
        <img class="w-full h-full object-fit rounded cursor-pointer"
            src="{{ Storage::disk($disk ?? 'public')->url($image) }}"
            onclick="openImage('{{ Storage::disk($disk ?? 'public')->url($image) }}')" title="click to view">
    @else
        <div class="w-full h-full rounded bg-gray-400 text-gray-100 pt-3 text-center">NA</div>
    @endif
</div>
