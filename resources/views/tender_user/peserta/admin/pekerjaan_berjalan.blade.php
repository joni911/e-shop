<x-table :head="['No', 'Nama Kontrak', 'Lokasi', 'Instansi', 'Alamat', 'No. Telepon', 'No. Kontrak', 'Tanggal Kontrak', 'Persentase Pelaksanaan', 'Tgl Selesai Kontrak', 'Tgl Serah Terima', 'Nilai Kontrak']">
    @forelse ($data->pekerjaan as $no => $pj)
        <tr>
            <td>{{ $no + 1 }}</td>
            <td class="fw-medium">{{ $pj->pekerjaan }}</td>
            <td>{{ $pj->lokasi }}</td>
            <td>{{ $pj->instansi }}</td>
            <td>{{ $pj->alamat }}</td>
            <td>{{ $pj->no_hp }}</td>
            <td>{{ $pj->no_kontrak }}</td>
            <td>{{ $pj->tgl_kontrak }}</td>
            <td>{{ $pj->presentasi }} %</td>
            <td>{{ $pj->tgl_selesai_kontrak }}</td>
            <td>{{ $pj->tgl_serah_terima }}</td>
            <td>{{ $pj->nilai_kontrak }}</td>
        </tr>
    @empty
        <tr>
            <td colspan="12" class="table-empty">Kosong</td>
        </tr>
    @endforelse
</x-table>