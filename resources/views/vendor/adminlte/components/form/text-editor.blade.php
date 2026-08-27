{{-- Override adminlte::components.form.text-editor — textarea Bootstrap 5.3 (M3 PRD_UI_MIGRATION)
     Pengganti Summernote: textarea plain tema orange, konten HTML tetap tersimpan. --}}
@php
    $fid = $id ?? str_replace(['.', '[]', '[', ']'], ['_', '', '_', ''], $name);
    $errKey = $errorKey ?? $name;
@endphp
<div class="form-group {{ $fgroupClass ?? '' }}">
    @if(isset($label) && $label)
        <label class="form-label {{ $labelClass ?? '' }}" for="{{ $fid }}">{{ $label }}</label>
    @endif
    <textarea id="{{ $fid }}" name="{{ $name }}" rows="8" {{ $attributes->merge(['class' => 'form-control']) }}>{{ old($errKey, $slot->isNotEmpty() ? $slot : '') }}</textarea>
    @error($errKey)
        <div class="form-error">{{ $message }}</div>
    @enderror
</div>
