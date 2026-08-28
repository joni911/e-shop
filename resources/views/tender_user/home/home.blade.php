@extends(auth()->user()->hak_akses == 'admin' ? 'layouts.admin' : 'layouts.peserta')

@section('title', 'Daftar Tender')

@section('content')
<div class="page-header">
    <h1>Daftar Tender</h1>
    <div class="breadcrumb">
        <a href="{{ route('home') }}">Beranda</a> / <span>Daftar Tender</span>
    </div>
</div>

@if(session('success'))
    <x-alert type="success" dismissible>{{ session('success') }}</x-alert>
@endif

<div class="card mb-4">
    <div class="card-body">
        @if(auth()->check() && auth()->user()->hak_akses == 'admin')
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <a href="https://drive.google.com/file/d/1T9gFB1UPZzJ7unt2iCoyfTiLjMnWEVdN/view?usp=sharing" target="_blank" class="fw-semibold">
                        Link Tutorial Penggunaan Aplikasi
                    </a>
                </div>
                <x-button label="Tambah Tender" href="{{ route('tender_admin.create') }}" variant="primary" icon="fas fa-plus"/>
            </div>
        @else
            <a href="https://drive.google.com/file/d/1T9gFB1UPZzJ7unt2iCoyfTiLjMnWEVdN/view?usp=sharing" target="_blank" class="fw-semibold">
                Link Tutorial Penggunaan Aplikasi
            </a>
        @endif
    </div>
</div>

{{-- Grid Tender --}}
<div class="tender-grid">
    @forelse ($data as $d)
        @php
            $pendaftaranTahap = $d->tahapan->firstWhere('status', 1);
            $jadwalText = $pendaftaranTahap
                ? \Carbon\Carbon::parse($pendaftaranTahap->mulai)->format('d M Y') . ' - ' . \Carbon\Carbon::parse($pendaftaranTahap->akhir)->format('d M Y')
                : '-';
            // Peta status tender -> warna badge (label sesuai $d->stn asli)
            $badgeMap = [
                'Publish' => 'success',
                'Pendaftaran' => 'primary',
                'Pengambilan Dokumen' => 'info',
                'Aanwijzing' => 'info',
                'Penawaran' => 'primary',
                'Evaluasi' => 'warning',
                'Negosiasi' => 'warning',
                'Selesai' => 'default',
                'Batal' => 'danger',
                'Draft' => 'warning',
            ];
            $badgeColor = $badgeMap[$d->stn] ?? 'secondary';
            $statusBadge = '<span class="badge badge-' . $badgeColor . '">' . e($d->stn) . '</span>';
        @endphp
        <a href="{{ route('tender_home.show', [$d->id]) }}" class="tender-card">
            <div class="tender-card-header">
                <h3 class="tender-card-title">{{ $d->nama }}</h3>
                {!! $statusBadge !!}
            </div>
            <div class="tender-card-meta">
                <span>
                    <i class="fas fa-boxes"></i> {{ $d->jpn }}
                </span>
                <span>
                    <i class="fas fa-route"></i> {{ $d->mpn }}
                </span>
                <span>
                    <i class="fas fa-map-marker-alt"></i> {{ $d->lokasi }}
                </span>
            </div>
            <div class="tender-card-stats">
                <div class="tender-card-stat">
                    <div class="tender-card-stat-value">@currency($d->nilai_pagu)</div>
                    <div class="tender-card-stat-label">Pagu</div>
                </div>
                <div class="tender-card-stat">
                    <div class="tender-card-stat-value">@currency($d->hps)</div>
                    <div class="tender-card-stat-label">HPS</div>
                </div>
                <div class="tender-card-stat">
                    <div class="tender-card-stat-value">{{ $jadwalText }}</div>
                    <div class="tender-card-stat-label">Jadwal</div>
                </div>
                <div class="tender-card-stat">
                    <div class="tender-card-stat-value">{{ $d->tahun_anggaran }}</div>
                    <div class="tender-card-stat-label">Tahun</div>
                </div>
            </div>
        </a>
    @empty
        <div class="empty-state">
            <h3>Tidak ada tender tersedia</h3>
            <p>Belum ada tender yang dipublikasikan saat ini.</p>
        </div>
    @endforelse
</div>

@if(method_exists($data, 'links'))
    <div class="d-flex justify-content-end mt-4">
        {{ $data->links() }}
    </div>
@endif
@endsection
