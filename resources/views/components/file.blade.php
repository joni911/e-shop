{{-- x-file — File Upload Bootstrap 5.3 tema orange (PRD v2, M8)
     Props: label, name, required, hint, accept, multiple,
            current (path file yang sudah diupload — menampilkan status "Sudah diisi"),
            download_label (label tombol download file existing)
     Fitur UX:
       - Status jelas: "Belum diisi" (abu-abu) vs "Sudah diisi" (hijau + ikon) jika ada current
       - Preview instan untuk gambar (img) & PDF (embed) begitu user memilih file
       - Nama file terpilih tampil di label
       - Error merah + pesan (server maupun client)
--}}
@props([
    'label' => null,
    'name' => null,
    'required' => false,
    'hint' => null,
    'accept' => null,
    'multiple' => false,
    'id' => null,
    'current' => null,
    'download_label' => null,
])

@php
    $fid = $id ?? ($name ? preg_replace('/[^A-Za-z0-9_]/', '_', Str::of($name)->replace(['.', '[]', '[', ']'], ['_', '', '_', ''])->toString()) : null);
    $hasCurrent = !empty($current);
    $currentExt = $hasCurrent ? strtolower(pathinfo($current, PATHINFO_EXTENSION)) : '';
    $isImage = in_array($currentExt, ['jpg', 'jpeg', 'png', 'gif', 'webp']);
    $isPdf = $currentExt === 'pdf';
@endphp

@if($label)
    <label class="form-label" for="{{ $fid }}">
        {{ $label }}
        @if($required)<span class="required"></span>@endif
        @if($hasCurrent)
            <span class="file-status-badge file-status-ok"><i class="fas fa-check-circle"></i> Sudah diisi</span>
        @else
            <span class="file-status-badge file-status-empty"><i class="fas fa-exclamation-circle"></i> Belum diisi</span>
        @endif
    </label>
@endif

<div class="form-file {{ $hasCurrent ? 'has-file' : '' }}">
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

{{-- Preview file existing --}}
@if($hasCurrent)
    <div class="file-preview mt-2" data-preview="existing">
        @if($isImage)
            <img src="/{{ $current }}" alt="{{ $label }}" class="file-preview-thumb">
        @elseif($isPdf)
            <div class="file-preview-pdf">
                <i class="fas fa-file-pdf text-danger"></i>
                <span>{{ basename($current) }}</span>
            </div>
        @else
            <div class="file-preview-pdf">
                <i class="fas fa-file"></i>
                <span>{{ basename($current) }}</span>
            </div>
        @endif
        @if($download_label)
            <a href="/{{ $current }}" class="btn btn-sm btn-outline-primary mt-1" download><i class="fas fa-download"></i> {{ $download_label }}</a>
        @else
            <a href="/{{ $current }}" class="btn btn-sm btn-outline-primary mt-1" download><i class="fas fa-download"></i> Download</a>
        @endif
    </div>
@endif

{{-- Preview instan file yang baru dipilih --}}
<div class="file-preview mt-2 d-none" data-preview="new"></div>

@if($hint)
    <small class="form-hint">{{ $hint }}</small>
@endif
@error($name)
    <div class="form-error">{{ $message }}</div>
@enderror
