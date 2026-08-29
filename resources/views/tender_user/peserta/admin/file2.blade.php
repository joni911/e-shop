<h3 class="text-center">File Penawaran</h3>
<div class="d-flex gap-2 flex-wrap">
    @if ($pp)
        @forelse ($pp->penawaran_peserta_file as $ppf)
            @php
                $pv = $ppf; // path ->file, id ->id
                $label = $ppf->nama ?? 'File ' . $ppf->id;
            @endphp
            @include('tender_user.peserta.files.part.preview')
            <x-button label="Download" href="/{{ $ppf->file }}" :download="$label . ' ' . $fn" variant="primary" size="sm" icon="fas fa-download"/>
        @empty
            <p class="text-muted mb-0">Tidak ada file penawaran.</p>
        @endforelse
    @endif
</div>