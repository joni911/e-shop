<x-table :head="['No', 'Nama', 'Tgl Lahir', 'Jenis Kelamin', 'Alamat', 'Jabatan', 'Pengalaman', 'Aksi']">
    @forelse ($data->tenaga_ahli as $no => $ta)
        <tr>
            <td>{{ $no + 1 }}</td>
            <td class="fw-medium">{{ $ta->nama }}</td>
            <td>{{ $ta->tgl_lahir }}</td>
            <td>{{ $ta->jk }}</td>
            <td>{{ $ta->alamat }}</td>
            <td>{{ $ta->jabatan }}</td>
            <td>{{ $ta->pengalaman }}</td>
            <td>
                @php
                    $pv = $ta; // path ->file
                    $pv_prefix = 'ta';
                    $label = $ta->nama_file ?? $ta->nama;
                @endphp
                <div class="d-flex gap-2 flex-wrap">
                    @include('tender_user.peserta.files.part.preview')
                    <x-button label="Download" href="/{{ $ta->file }}" :download="$label . ' ' . ($fn ?? '')" variant="primary" size="sm" icon="fas fa-download"/>
                </div>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="8" class="table-empty">Kosong</td>
        </tr>
    @endforelse
</x-table>