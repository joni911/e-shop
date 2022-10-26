<table class="table">
    <tbody>
        <tr>
            <td scope="row">Nama Perusahaan</td>
            <td>{{$data->nama_pt}}</td>
        </tr>
        <tr>
            <td scope="row">Nama User</td>
            <td>{{$data->user->name}}</td>
        </tr>
            <td>No HP</td>
            <td>{{$data->no_hp}}</td>
        </tr>

        <tr>
            <td>Penawaran : </td>
            <td>
                @currency($pp->penawaran)
            </td>
        </tr>

    </tbody>
</table>
