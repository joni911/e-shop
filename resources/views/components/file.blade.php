{{-- x-file — File Upload Bootstrap 5.3 tema orange (PRD v2, M8)
     Props: label, name, required, hint, accept, multiple --}}
@props([
    'label' => null,
    'name' => null,
    'required' => false,
    'hint' => null,
    'accept' => null,
    'multiple' => false,
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

<div class="form-file">
    <input @if($fid) id="{{ $fid }}" @endif type="file" name="{{ $name }}"
           @if($accept) accept="{{ $accept }}" @endif
           @if($multiple) multiple @endif
           @if($required) required @endif
           {{ $attributes }}>
    <div class="form-file-label">
        <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.9A5 5 0 1115.9 6h1.1a5 5 0 011 9.87M12 12v8m0-8l-3 3m3-3l3 3"/></svg>
        <span class="form-file-text">Pilih file...</span>
    </div>
</div>

@if($hint)
    <small class="form-hint">{{ $hint }}</small>
@endif
@error($name)
    <div class="form-error">{{ $message }}</div>
@enderror
