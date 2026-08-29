<table class="table align-middle mb-0">
    <tbody>
        <tr>
            <th style="width: 220px;">Nama Perusahaan</th>
            <td>{{ $data->nama_pt }}</td>
        </tr>
        <tr>
            <th>Nama User</th>
            <td>{{ $data->user->name }}</td>
        </tr>
        <tr>
            <th>No HP</th>
            <td>{{ $data->no_hp }}</td>
        </tr>
        <tr>
            <th>Penawaran</th>
            <td>@currency(($pp->penawaran ?? 0))</td>
        </tr>
    </tbody>
</table>