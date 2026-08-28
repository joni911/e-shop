<x-card :title="'Tabel Perubahan '.$tahapan->tender->nama">
    <x-slot:actions>
        @if(auth()->check() && auth()->user()->hak_akses == 'admin')
            <x-button label="Kembali" href="{{ route('tender_admin.tahapan', [$tahapan->tender->id]) }}" variant="secondary"/>
        @else
            <x-button label="Kembali" href="{{ route('home') }}" variant="secondary"/>
        @endif
    </x-slot:actions>

    <x-table :head="['No', 'Nama Tender', 'Tanggal Awal', 'Tanggal Akhir', 'Perubahan', 'Keterangan']">
        @forelse ($data as $no => $b)
            <tr>
                <td>{{ $no }}</td>
                <td>{{ $b->nama }}</td>
                <td>{{ $b->awal }}</td>
                <td>{{ $b->akhir }}</td>
                <td>{{ $b->created_at }}</td>
                <td>{{ $b->keterangan }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="6" class="table-empty">Tidak ada perubahan</td>
            </tr>
        @endforelse
    </x-table>

    @if(method_exists($data, 'links'))
        <div class="d-flex justify-content-end mt-4">{{ $data->links() }}</div>
    @endif
</x-card>
