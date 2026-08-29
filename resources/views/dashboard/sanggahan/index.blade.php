@extends(auth()->user()->hak_akses == 'admin' ? 'layouts.admin' : 'layouts.peserta')

@section('title', 'Sanggahan')

@section('content')
<div class="page-header">
    <h1>Sanggahan</h1>
    <div class="breadcrumb">
        <a href="{{ route('home') }}">Beranda</a> / <span>Sanggahan</span>
    </div>
</div>

@include('global.alert')

<x-card title="Daftar Pengadaan">
    <x-table :head="['No', 'Nama', 'Aksi']">
        @forelse($data as $no => $b)
            <tr>
                <td>{{ $no + 1 }}</td>
                <td class="fw-medium">{{ $b->nama }}</td>
                <td>
                    <x-button label="Sanggahan" href="{{ route('sanggahan.show', [$b->id]) }}" variant="warning" icon="fas fa-comment"/>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="3" class="table-empty">Kosong</td>
            </tr>
        @endforelse
    </x-table>

    @if(method_exists($data, 'links'))
        <div class="d-flex justify-content-end mt-4">{{ $data->links() }}</div>
    @endif
</x-card>
@endsection