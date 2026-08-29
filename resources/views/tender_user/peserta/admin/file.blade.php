<div class="d-flex gap-2 flex-wrap">
    @forelse ($berkas as $tfd)
        @php
            $pv = $tfd;
            $label = $tfd->tender_file->nama ?? 'File ' . $tfd->id;
        @endphp
        @include('tender_user.peserta.files.part.preview')
        <x-button label="Download" href="/{{ $tfd->files }}" :download="$label . ' ' . $fn" variant="primary" size="sm" icon="fas fa-download"/>
    @empty
        <p class="text-muted mb-0">Tidak ada berkas.</p>
    @endforelse
</div>