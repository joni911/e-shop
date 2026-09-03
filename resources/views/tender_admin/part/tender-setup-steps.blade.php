{{--
    Satu sumber baris wizard "Langkah Pengaturan Tender" (7 langkah setup tender).
    Dipakai konsisten di: Data Tender (edit) → Tahapan → Syarat → File Tender →
    Persyaratan & Penawaran → Penawaran → Administrasi.

    Input:
    - $tender : objek Model tender (minimal ->id), dipakai sebagai param route {tender}/{id}
    - $active : int 1..7 — langkah yang sedang dibuka (badge aktif non-klik), default 1

    Semua URL memakai route() dinamis (bukan URL absolut).
--}}
@if (isset($tender) && $tender && $tender->id)
@php
    $active = (int) ($active ?? 1);
    $steps = [
        1 => ['label' => 'Data Tender',                'icon' => 'fas fa-file-alt',        'url' => route('tender_admin.edit', [$tender->id])],
        2 => ['label' => 'Tahapan',                    'icon' => 'fas fa-calendar-alt',    'url' => route('tender_admin.tahapan', [$tender->id])],
        3 => ['label' => 'Syarat',                     'icon' => 'fas fa-list-check',      'url' => route('tender_admin.syarat', [$tender->id])],
        4 => ['label' => 'File Tender',                'icon' => 'fas fa-folder-open',     'url' => route('tender_file.show', [$tender->id])],
        5 => ['label' => 'Persyaratan & Penawaran',    'icon' => 'fas fa-file-signature',  'url' => route('tender_persyarat.tender', [$tender->id])],
        6 => ['label' => 'Penawaran',                  'icon' => 'fas fa-hand-holding-usd','url' => route('penawaran.tender', [$tender->id])],
        7 => ['label' => 'Administrasi',               'icon' => 'fas fa-clipboard-check', 'url' => route('administrasi.tender', [$tender->id])],
    ];
@endphp
<x-card title="Langkah Pengaturan Tender" class="mb-4">
    <div class="d-flex flex-wrap gap-2">
        @foreach ($steps as $n => $s)
            @if ($n === $active)
                <span class="badge badge-primary px-3 py-2"><i class="{{ $s['icon'] }}"></i> {{ $n }}. {{ $s['label'] }}</span>
            @else
                <a href="{{ $s['url'] }}" class="badge badge-default px-3 py-2 text-decoration-none"><i class="{{ $s['icon'] }}"></i> {{ $n }}. {{ $s['label'] }}</a>
            @endif
        @endforeach
    </div>
</x-card>
@endif
