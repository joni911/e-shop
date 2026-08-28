{{-- x-button — Button Bootstrap 5.3 tema orange (PRD v2, M8)
     Props: label, icon, variant (primary|secondary|success|danger|warning|ghost|link), size (sm|lg), type, 
     Slot: default (isi label bila tidak pakai prop label)
     ----------
     variant -> CSS. Jika element adalah <a>, render <a>. Jika button, render <button>.
     Pastikan pass atribut data-* (mis. data-bs-toggle, data-bs-target, data-bs-dismiss) --}}
@props([
    'label' => null,
    'icon' => null,
    'variant' => 'primary',
    'size' => null,
    'type' => 'button',
    'href' => null,
    'download' => null,
])

@php
    $classes = collect(['btn'])
        ->push('btn-'.$variant)
        ->when($size, fn($c) => $c->push('btn-'.$size))
        ->implode(' ');
    $content = $label ?: $slot;
@endphp

@if($href)
    <a href="{{ $href }}" class="{{ $classes }}" @if($download) download="{{ $download }}" @endif {{ $attributes }}>
        @if($icon)<i class="{{ $icon }}"></i>@endif
        {!! $content !!}
    </a>
@else
    <button type="{{ $type }}" class="{{ $classes }}" {{ $attributes }}>
        @if($icon)<i class="{{ $icon }}"></i>@endif
        {!! $content !!}
    </button>
@endif
