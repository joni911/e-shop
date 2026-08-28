{{-- x-textarea — Textarea Bootstrap 5.3 tema orange (PRD v2, M8)
     Props: label, name, rows, value, placeholder, required, hint
     Slot: default (isi value bila tidak pakai prop value) --}}
@props([
    'label' => null,
    'name' => null,
    'rows' => 4,
    'value' => '',
    'placeholder' => '',
    'required' => false,
    'hint' => null,
    'id' => null,
])

@php
    $fid = $id ?? ($name ? preg_replace('/[^A-Za-z0-9_]/', '_', Str::of($name)->replace(['.', '[]', '[', ']'], ['_', '', '_', ''])->toString()) : null);
@endphp

@if($label)
    <label class="form-label" for="{{ $fid }}">
        {{ $label }}
        @if($required)<span class="required"></span>@endif
    </label>
@endif

<textarea @if($fid) id="{{ $fid }}" @endif name="{{ $name }}" rows="{{ $rows }}"
          class="form-textarea" placeholder="{{ $placeholder }}"
          @if($required) required @endif
          {{ $attributes }}>{{ $value ?: $slot }}</textarea>

@if($hint)
    <small class="form-hint">{{ $hint }}</small>
@endif
@error($name)
    <div class="form-error">{{ $message }}</div>
@enderror
