<h3 class="text-center">File Administrasi</h3>
<div class="d-flex gap-2 flex-wrap">
    @if ($admin)
        @forelse ($admin as $apf)
            @php
                $pv = $apf; // path ->file
                $pv_prefix = 'admin-file';
                $label = $apf->nama ?? 'File ' . $apf->id;
            @endphp
            @include('tender_user.peserta.files.part.preview')
            <x-button label="Download" href="/{{ $apf->file }}" :download="$label . ' ' . $fn" variant="primary" size="sm" icon="fas fa-download"/>
        @empty
            <p class="text-muted mb-0">Tidak ada file administrasi.</p>
        @endforelse
    @endif
</div>