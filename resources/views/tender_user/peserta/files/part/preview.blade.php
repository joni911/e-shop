{{-- Preview file dalam modal custom (x-modal) — pengganti x-adminlte-modal
     Parameter (harus di-set sebelum include):
       $pv        : objek item file (->id, path ->files ATAU ->file)
       $label     : judul tombol/modal
       $pv_prefix : (PENTING) prefix unik per konteks agar id modal TIDAK duplikat
                    antar tabel (mis. 'berkas', 'penawaran', 'admin-file', 'pengalaman', 'ta', 'alat')
       $fn        : (opsional) nama tambahan untuk unduhan
--}}
@php
    $pv_prefix = $pv_prefix ?? 'fp';
    $pv_path = $pv->files ?? $pv->file ?? '';
    $pv_ext  = strtolower(pathinfo($pv_path, PATHINFO_EXTENSION));
    $pv_id   = $pv_prefix . '-' . ($pv->id ?? md5($pv_path));
    $pv_dl   = trim($label . ' ' . ($fn ?? ''));
@endphp

<x-button :label="$label" variant="warning" size="sm" icon="fas fa-eye" data-modal="{{ $pv_id }}"/>

<x-modal id="{{ $pv_id }}" :title="$label" size="lg">
    @if (!$pv_path)
        <p class="text-muted mb-0">File tidak tersedia.</p>
    @elseif (in_array($pv_ext, ['jpg', 'jpeg', 'png', 'gif', 'webp']))
        <img src="/{{ $pv_path }}" class="img-fluid rounded" alt="{{ $label }}">
    @elseif ($pv_ext === 'pdf')
        <object data="/{{ $pv_path }}" type="application/pdf" width="100%" height="480">Browser tidak mendukung preview PDF — gunakan tombol unduh.</object>
    @elseif (in_array($pv_ext, ['zip', 'rar', '7z']))
        <p class="mb-3">File arsip — gunakan tombol unduh untuk melihat isi.</p>
        <x-button label="Download File" href="/{{ $pv_path }}" variant="primary" icon="fas fa-download"/>
    @else
        <p class="mb-3">File: {{ $pv_path }}<br>Ekstensi {{ $pv_ext ?: '(tanpa ekstensi)' }} tidak didukung untuk preview — gunakan tombol unduh.</p>
        <x-button label="Download File" href="/{{ $pv_path }}" variant="primary" icon="fas fa-download"/>
    @endif

    <x-slot:footer>
        @if($pv_path)
            <x-button label="Download" href="/{{ $pv_path }}" :download="$pv_dl" variant="primary" icon="fas fa-download"/>
        @endif
        <x-button label="Tutup" variant="secondary" data-modal-close="{{ $pv_id }}"/>
    </x-slot:footer>
</x-modal>