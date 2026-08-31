{{-- Sidebar Admin — menu lengkap (master + kelola tender + pemeriksaan) --}}
<nav class="sidebar-nav">
    <div class="nav-section">
        <div class="nav-section-title">Menu Utama</div>
        <a href="{{ route('peserta.create') }}" class="nav-link">
            <i class="fas fa-file nav-icon"></i>
            <span class="nav-text">Peserta</span>
        </a>
        <a href="{{ route('home') }}" class="nav-link">
            <i class="fas fa-home nav-icon"></i>
            <span class="nav-text">Beranda Tender</span>
        </a>
        <a href="{{ route('tender_admin.index') }}" class="nav-link">
            <i class="fas fa-list nav-icon"></i>
            <span class="nav-text">Kelola Tender</span>
        </a>
    </div>
    <div class="nav-section">
        <div class="nav-section-title">Master</div>
        <a href="{{ route('jenis_pengadaan.index') }}" class="nav-link"><i class="fas fa-boxes nav-icon"></i><span class="nav-text">Jenis Pengadaan</span></a>
        <a href="{{ route('jenis_kontrak.index') }}" class="nav-link"><i class="fas fa-certificate nav-icon"></i><span class="nav-text">Jenis Kontrak</span></a>
        <a href="{{ route('metode_pengadaan.index') }}" class="nav-link"><i class="fas fa-route nav-icon"></i><span class="nav-text">Metode Pengadaan</span></a>
        <a href="{{ route('status_tender.index') }}" class="nav-link"><i class="fas fa-info-circle nav-icon"></i><span class="nav-text">Status Tender</span></a>
        <a href="{{ route('tahapan.index') }}" class="nav-link"><i class="fas fa-tasks nav-icon"></i><span class="nav-text">Tahapan</span></a>
    </div>
    <div class="nav-section">
        <div class="nav-section-title">Pemeriksaan</div>
        <a href="{{ route('dashboard.index') }}" class="nav-link"><i class="fas fa-search nav-icon"></i><span class="nav-text">Pemeriksaan</span></a>
    </div>
</nav>