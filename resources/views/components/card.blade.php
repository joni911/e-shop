{{-- x-card — Card Bootstrap 5.3 tema orange (PRD v2, M8)
     Props: title, subtitle, footer
     Slots: default (body), header (opsional, menggantikan title), footer (opsional), actions (kanan header)
     ----------
     <x-card title="..">body</x-card>
     <x-card><x-slot:header>..</x-slot:header>body<x-slot:footer>..</x-slot:footer></x-card> --}}
@props([
    'title' => null,
    'subtitle' => null,
])

<div {{ $attributes->merge(['class' => 'card']) }}>
    @isset($header)
        {{ $header }}
    @elseif($title || isset($actions))
        <div class="card-header">
            <div>
                <h3 class="mb-0">{{ $title }}</h3>
                @if($subtitle)<small class="text-muted">{{ $subtitle }}</small>@endif
            </div>
            @isset($actions)
                <div class="d-flex gap-2">{{ $actions }}</div>
            @endisset
        </div>
    @endif
    <div class="card-body">
        {{ $slot }}
    </div>
    @isset($footer)
        <div class="card-footer">{{ $footer }}</div>
    @endisset
</div>
