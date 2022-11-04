@component('mail::message')
<h2>Penilaian</h2>

<h1 class="text-center">Penilaian</h1>

<h2>Penilian Administrasi</h2>
<p>{{$data['pa_s']}}</p>
<p>
    {{$data['pa_k']}}
</p>
<h2>Kualifikasi</h2>
<p>{{$data['pk_s']}}</p>
<p>
    {{$data['pk_k']}}
</p>
    Teknis
</h2>
<p>{{$data['pt_s']}}</p>
<p>
    {{$data['pt_k']}}
</p>
<h2>Peserta</h2>
<p>{{$data['pp_s']}}</p>
<p>
    {{$data['pp_k']}}
</p>

<p>{{$data['poin']}}</p>
{{--
    @if ($point>=4)
        <p>Selamat Anda Lulus dan akan masuk ke tahap selanjutnya</p>
    @else
       <p>Kami dari panitia tender menyampaikan bahwa saudara belum dapat dinyatakan lulus dalam seleksi administrasi</p>
    @endif --}}

{{-- @component('mail::button', ['url' => ''])
Button Text
@endcomponent --}}

Terimakasi telah mengikuti pengadaan ini,<br>
{{ config('app.name') }}
@endcomponent
