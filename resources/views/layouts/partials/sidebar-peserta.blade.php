{{-- Sidebar Peserta/User — menu terbatas --}}
<nav class="sidebar-nav">
    <div class="nav-section">
        <div class="nav-section-title">Menu Utama</div>
        <a href="{{ route('peserta.tenders') }}" class="nav-link">
            <i class="fas fa-file nav-icon"></i>
            <span class="nav-text">Tender Saya</span>
        </a>
        <a href="{{ route('home') }}" class="nav-link">
            <i class="fas fa-home nav-icon"></i>
            <span class="nav-text">Beranda Tender</span>
        </a>
        <a href="{{ route('sanggahan.index') }}" class="nav-link">
            <i class="fas fa-comments nav-icon"></i>
            <span class="nav-text">Sanggahan</span>
        </a>
    </div>
</nav>