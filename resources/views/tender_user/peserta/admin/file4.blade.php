<div class="d-flex gap-3 flex-wrap">
    @if ($file_rkk)
        @forelse ($file_rkk as $rkk)
            <div class="d-flex gap-2 flex-wrap">
                @if ($rkk->smkk)
                    @php
                        $pv = (object) ['id' => 'smkk-' . $rkk->id, 'files' => $rkk->smkk];
                        $label = 'SMKK';
                    @endphp
                    @include('tender_user.peserta.files.part.preview')
                @endif
                @if ($rkk->komitmen)
                    @php
                        $pv = (object) ['id' => 'komitmen-' . $rkk->id, 'files' => $rkk->komitmen];
                        $label = 'Pakta Komitmen SMKK';
                    @endphp
                    @include('tender_user.peserta.files.part.preview')
                @endif
            </div>
        @empty
            <p class="text-muted mb-0">Tidak ada file RKK.</p>
        @endforelse
    @endif
</div>