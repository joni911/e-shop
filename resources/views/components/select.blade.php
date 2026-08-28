{{-- x-select — Select Bootstrap 5.3 tema orange (PRD v2, M8)
     Props: label, name, options (collection|array), value, placeholder, required, hint
     options: array|Collection of [id=>name] atau objek dengan ->id dan ->nama --}}
@props([
    'label' => null,
    'name' => null,
    'options' => [],
    'value' => '',
    'placeholder' => null,
    'required' => false,
    'hint' => null,
    'id' => null,
    'optionValue' => 'id',
    'optionLabel' => 'nama',
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

<select @if($fid) id="{{ $fid }}" @endif name="{{ $name }}"
        class="form-select"
        @if($required) required @endif
        {{ $attributes }}>
    @if($placeholder)
        <option value="" {{ $value === '' || $value === null ? 'selected' : '' }}>{{ $placeholder }}</option>
    @endif

    @foreach($options as $key => $option)
        @php
            if (is_object($option) || (is_array($option) && isset($option[$optionLabel]))) {
                if (is_object($option)) {
                    $optVal = data_get($option, $optionValue);
                    $optLabel = data_get($option, $optionLabel);
                } else {
                    $optVal = $option[$optionValue];
                    $optLabel = $option[$optionLabel];
                }
            } else {
                $optVal = $key;
                $optLabel = $option;
            }
            $selected = (string) $value === (string) $optVal ? 'selected' : '';
        @endphp
        <option value="{{ $optVal }}" {{ $selected }}>{{ $optLabel }}</option>
    @endforeach
</select>

@if($hint)
    <small class="form-hint">{{ $hint }}</small>
@endif
@error($name)
    <div class="form-error">{{ $message }}</div>
@enderror
