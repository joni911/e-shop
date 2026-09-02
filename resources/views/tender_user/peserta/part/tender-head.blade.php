@php
    $hasCtx = isset($tender) && $tender;
    $ptName = isset($peserta) && $peserta ? ($peserta->nama_pt ?? '') : '';
@endphp
@if($hasCtx)
    <x-alert type="info" title="Konteks Pengisian" class="mb-4">
        <p class="mb-0">Mengisi <strong>{{ $tender->nama }}</strong> untuk peserta <strong>{{ $ptName }}</strong>. Data yang diisi tersimpan untuk tender ini.</p>
    </x-alert>
@endif
