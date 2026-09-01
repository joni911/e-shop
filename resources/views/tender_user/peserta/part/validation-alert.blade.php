{{-- Ringkasan error validasi — menjelaskan ke user apa yang harus diperbaiki --}}
@if ($errors->any())
    @php
        $count = $errors->count();
    @endphp
    <x-alert type="danger" dismissible title="Terdapat {{ $count }} kesalahan pada form">
        <p class="mb-2">Mohon periksa kembali isian Anda sebelum menyimpan. Field yang bermasalah ditandai dengan <strong>kotak merah</strong> dan pesan di bawahnya.</p>
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </x-alert>
@endif
