@php
    // Tentukan nama tender aktif utk badge konteks.
    $tctxName = null;
    if (isset($tender) && $tender) {
        $tctxName = $tender->nama ?? null;
    } elseif (isset($peserta) && $peserta && $peserta->tender) {
        $tctxName = $peserta->tender->nama ?? null;
    }
    $ptRow = isset($peserta) && $peserta ? ($peserta->nama_pt ?? '') : '';
@endphp
@if($tctxName)
    <div class="tender-context-bar mb-3 p-2 px-3 border-start border-primary bg-light">
        <i class="fas fa-gavel text-primary me-2"></i>
        <strong>Tender:</strong> {{ $tctxName }}
        @if($ptRow)<span class="text-muted ms-3"><i class="fas fa-building me-1"></i>{{ $ptRow }}</span>@endif
    </div>
@endif
