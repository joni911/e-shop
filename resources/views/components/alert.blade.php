{{-- x-alert — Alert Bootstrap 5.3 tema orange (PRD v2, M8)
     Props: type (primary|success|warning|danger|info), dismissible, title, icon
     Slot: default (isi pesan)
     ----------
     type -> alert-{type} CSS. Icon default sesuai type. --}}
@props([
    'type' => 'info',
    'dismissible' => false,
    'title' => null,
    'icon' => null,
])

@php
    $icons = [
        'success' => ['M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z'],
        'warning' => ['M12 9v4m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z'],
        'danger'  => ['M12 8v4m0 4h.01M12 2a10 10 0 100 20 10 10 0 000-20z'],
        'info'    => ['M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z'],
        'primary' => ['M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z'],
    ];
    $defaultIcon = $icons[$type] ?? $icons['info'];
@endphp

<div class="alert alert-{{ $type }} {{ $dismissible ? 'alert-dismissible' : '' }}"
     @if($dismissible) data-dismiss-bs="alert" @endif
     {{ $attributes }}>
    <svg class="alert-icon" width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        @foreach($defaultIcon as $d)
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $d }}"/>
        @endforeach
    </svg>
    <div class="alert-content">
        @if($title)<strong class="d-block mb-1">{{ $title }}</strong>@endif
        {!! $slot !!}
    </div>
    @if($dismissible)
        <button type="button" class="alert-close" aria-label="Close">
            <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
        </button>
    @endif
</div>
