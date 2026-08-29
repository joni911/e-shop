<x-table :head="['No', 'Nama Kontrak', 'Lokasi', 'Instansi', 'Alamat', 'No. Telepon', 'No. Kontrak', 'Tanggal Kontrak', 'Persentase Pelaksanaan', 'Tgl Selesai Kontrak', 'Tgl Serah Terima', 'Nilai Kontrak', 'File']">
    @forelse ($data->pengalaman as $no => $pe)
        <tr>
            <td>{{ $no + 1 }}</td>
            <td class="fw-medium">{{ $pe->pekerjaan }}</td>
            <td>{{ $pe->lokasi }}</td>
            <td>{{ $pe->instansi }}</td>
            <td>{{ $pe->alamat }}</td>
            <td>{{ $pe->no_hp }}</td>
            <td>{{ $pe->no_kontrak }}</td>
            <td>{{ $pe->tgl_kontrak }}</td>
            <td>{{ $pe->presentasi }} %</td>
            <td>{{ $pe->tgl_selesai_kontrak }}</td>
            <td>{{ $pe->tgl_serah_terima }}</td>
            <td>{{ $pe->nilai_kontrak }}</td>
            <td>
                @php
                    $pv = $pe; // path ->file
                    $pv_prefix = 'pengalaman';
                    $label = $pe->pekerjaan;
                @endphp
                <div class="d-flex gap-2 flex-wrap">
                    @include('tender_user.peserta.files.part.preview')
                    <x-button label="Download" href="/{{ $pe->file }}" :download="$label . ' ' . ($fn ?? '')" variant="primary" size="sm" icon="fas fa-download"/>
                </div>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="13" class="table-empty">Kosong</td>
        </tr>
    @endforelse
</x-table>