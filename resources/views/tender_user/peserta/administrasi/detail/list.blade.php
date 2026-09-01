<x-card title="File Yang Sudah Di Upload">
    @forelse ($list as $no => $l)
        @php
            $pv = $l; // path ->file
            $pv_prefix = 'adm-detail';
            $label = $l->nama ?? 'Dokumen ' . $l->id;
        @endphp
        <div class="d-flex align-items-center gap-3 py-2 border-bottom">
            <span class="text-muted">{{ $no + 1 }}.</span>
            <div class="flex-grow-1 fw-medium">{{ $l->nama }}</div>
            <div class="d-flex gap-2">
                @include('tender_user.peserta.files.part.preview')
                <x-button label="Download" href="/{{ $l->file }}" :download="$l->nama" variant="primary" size="sm" icon="fas fa-download"/>
            </div>
        </div>
    @empty
        <p class="text-muted mb-0">Belum ada file yang diupload.</p>
    @endforelse
</x-card>
