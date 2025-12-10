<div {{ $attributes->merge(['class' => 'stat-card ' . ($variant ?? '')]) }}>
    <div class="flex items-center justify-between">
        <div>
            <p class="text-sm font-medium text-gray-500 mb-1">{{ $title }}</p>
            <h3 class="text-2xl font-bold {{ $valueClass ?? 'text-gradient' }}">{{ $value }}</h3>
            @if(isset($subtitle))
                <p class="text-xs text-gray-400 mt-1">{{ $subtitle }}</p>
            @endif
        </div>
        <div class="icon-container {{ $iconVariant ?? 'primary' }}">
            {{ $icon }}
        </div>
    </div>
</div>