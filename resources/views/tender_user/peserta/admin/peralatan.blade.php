<x-table :head="['No', 'Nama', 'Jumlah', 'Kapasitas', 'Merek/Tipe', 'Tahun', 'Kondisi', 'Lokasi', 'Kepemilikan', 'Bukti', 'Aksi']">
    @forelse ($data->peralatan as $no => $p)
        <tr>
            <td>{{ $no + 1 }}</td>
            <td class="fw-medium">{{ $p->nama }}</td>
            <td>{{ $p->jumlah }}</td>
            <td>{{ $p->kapasitas }}</td>
            <td>{{ $p->merk }}</td>
            <td>{{ $p->tahun }}</td>
            <td>{{ $p->kondisi }}</td>
            <td>{{ $p->lokasi }}</td>
            <td>{{ $p->kepemilikan }}</td>
            <td>{{ $p->bukti }}</td>
            <td>
                @php
                    $pv = $p; // path ->file
                    $label = $p->nama;
                @endphp
                <div class="d-flex gap-2 flex-wrap">
                    @include('tender_user.peserta.files.part.preview')
                    <x-button label="Download" href="/{{ $p->file }}" :download="$label . ' ' . ($fn ?? '')" variant="primary" size="sm" icon="fas fa-download"/>
                </div>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="11" class="table-empty">Kosong</td>
        </tr>
    @endforelse
</x-table>