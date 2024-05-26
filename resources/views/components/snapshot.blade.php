<figure 
    {{ $attributes }}
    x-data="{active: false}"
    x-init="active = selectedId == $el.id"
    class="relative max-w-xs bg-gray-600 py-4 pl-4 pr-6 transition-transform duration-[20ms]">
    <span x-show="active" class="absolute right-0 top-0 size-3 bg-primary"></span>
    {{ $slot }}
</figure>