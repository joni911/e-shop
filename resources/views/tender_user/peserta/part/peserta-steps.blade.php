{{--
    Stepper wizard kelengkapan peserta (7 langkah: Data Perusahaan → Administrasi).
    Satu-satunya sumber markup stepper peserta — dipakai hub "Tender Saya" dan tiap halaman langkah.

    Input:
    - $steps     : Collection dari PesertaWizardService::steps($profil[, $activeKey])
    - $activeKey : key langkah yang sedang dibuka (null → mode hub, tanpa penanda aktif)

    Keputusan PRD: langkah aktif tetap <a> (bisa diklik), bebas lompat tanpa gating,
    langkah selesai diberi tanda ✓ (kelas `done` — konsisten dgn hub).
--}}
@isset($steps)
<div class="steps mb-2">
    @foreach ($steps as $i => $s)
        @if($i > 0)<div class="step-divider"></div>@endif
        <div class="step {{ !empty($s['done']) ? 'done' : '' }} {{ !empty($s['active']) ? 'active' : '' }}">
            <a class="step-link" href="{{ $s['url'] }}">
                <div class="step-number">@if(!empty($s['done'])) ✓ @else {{ $i + 1 }} @endif</div>
                <span>{{ $s['label'] }}</span>
            </a>
        </div>
    @endforeach
</div>
@endisset
