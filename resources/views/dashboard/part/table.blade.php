<x-card title="Tabel Tender (Pemeriksaan)">
    <x-slot:actions>
        <x-button label="Tambah" href="{{ route('dashboard.create') }}" variant="primary" icon="fas fa-plus"/>
    </x-slot:actions>

    <x-table :head="['No', 'Nama', 'Jumlah Peserta', 'Aksi']">
        @forelse ($data as $no => $b)
            <tr>
                <td>{{ $no }}</td>
                <td>{{ $b->nama }}</td>
                <td>{{ $b->daftar_peserta->count() ?? 0 }}</td>
                <td>
                    <div class="actions">
                        <x-button label="Periksa" href="{{ route('dashboard.show', [$b->id]) }}" variant="warning" icon="fas fa-eye"/>
                    </div>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="4" class="table-empty">Kosong</td>
            </tr>
        @endforelse
    </x-table>

    @if(method_exists($data, 'links'))
        <div class="d-flex justify-content-end mt-4">{{ $data->links() }}</div>
    @endif
</x-card>
