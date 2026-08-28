<x-card title="Tabel Tender">
    <x-slot:actions>
        <x-button label="Tambah Tender" href="{{ route('tender_admin.create') }}" variant="primary" icon="fas fa-plus"/>
    </x-slot:actions>

    {{-- Search & Filter --}}
    <div class="card mb-4">
        <div class="card-body">
            <div class="row g-3 align-items-end">
                <div class="col-12 col-md-5">
                    <label class="form-label">Cari Tender</label>
                    <input type="text" class="form-control" placeholder="Nama tender..." data-table-search="tenderTable">
                </div>
                <div class="col-12 col-md-7">
                    <button class="btn btn-primary">Filter</button>
                </div>
            </div>
        </div>
    </div>

    <x-table :head="['No', 'Nama Paket', 'Jenis', 'Metode', 'Status', 'Pagu', 'HPS', 'Aksi']">
        @forelse ($data as $no => $b)
            <tr>
                <td>{{ $no }}</td>
                <td>
                    <div class="fw-medium">{{ $b->nama }}</div>
                    <div class="text-small text-muted">{{ $b->paket ?? '' }}</div>
                </td>
                <td>{{ $b->jenis_pengadaan->nama ?? '-' }}</td>
                <td>{{ $b->metode->nama ?? '-' }}</td>
                <td><span class="badge badge-primary">{{ $b->status_tender->nama ?? '' }}</span></td>
                <td>@currency($b->nilai_pagu)</td>
                <td>@currency($b->hps)</td>
                <td>
                    <div class="actions">
                        <x-button label="Edit" href="{{ route('tender_admin.edit', [$b->id]) }}" variant="secondary" icon="fas fa-pen"/>
                        <x-button label="Tahap" href="{{ route('tender_admin.tahapan', [$b->id]) }}" variant="secondary" icon="fas fa-tasks"/>
                        @if($b->default == false)
                            <form method="POST" action="{{ route('tender_admin.destroy', $b->id) }}" class="m-0">
                                @csrf
                                @method("DELETE")
                                <x-button label="Hapus" type="submit" variant="danger" icon="fas fa-trash"/>
                            </form>
                        @endif
                    </div>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="8" class="table-empty">Kosong</td>
            </tr>
        @endforelse
    </x-table>

    @if(method_exists($data, 'links'))
        <div class="d-flex justify-content-end mt-4">{{ $data->links() }}</div>
    @endif
</x-card>
