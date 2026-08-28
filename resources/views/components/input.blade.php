{{-- x-input — Input Bootstrap 5.3 tema orange (PRD v2, M8)
     Props: label, name, type (text|email|number|date|password|tel|url), value, placeholder, required, hint
     Slot: default (isi value bila tidak pakai prop value) --}}
@props([
    'label' => null,
    'name' => null,
    'type' => 'text',
    'value' => '',
    'placeholder' => '',
    'required' => false,
    'hint' => null,
    'id' => null,
])

@php
    $fid = $id ?? ($name ? Str::of($name)->replace(['.', '[]', '[', ']'], ['_', '', '_', ''])->toString() : null);
    $fid = $fid ? preg_replace('/[^A-Za-z0-9_]/', '_', $fid) : null;
@endphp

@if($label)
    <label class="form-label" for="{{ $fid }}">
        {{ $label }}
        @if($required)<span class="required"></span>@endif
    </label>
@endif

<input type="{{ $type }}"
       @if($fid) id="{{ $fid }}" @endif
       name="{{ $name }}"
       class="form-control"
       value="{{ $value }}"
       placeholder="{{ $placeholder }}"
       @if($required) required @endif
       {{ $attributes }}>

@if($hint)
    <small class="form-hint">{{ $hint }}</small>
@endif
@error($name)
    <div class="form-error">{{ $message }}</div>
@enderror
