<table class="table table-default table-inverse table-responsive">
    <thead class="thead-inverse">
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Mulai</th>
            <th>Slesai</th>
            <th>Keterangan</th>
            <th>Aksi</th>
        </tr>
        </thead>
        <tbody>
            <?php
                $i = 1;
            ?>
            @forelse ($tahapan as $t)
            <tr>
                <td scope="row">{{$i++}}</td>
                <td>{{$t->nama ?? ""}}</td>
                <td>{{$t->mulai ?? ""}}</td>
                <td>{{$t->akhir ?? ""}}</td>
                <th>{{$t->keterangan ?? ""}}
                    <br>
                    @if ($t->keterangan)
                    <a href="{{ route('perubahan.show', [$t->id]) }}">Periksa Perubahan</a>
                    @endif
                </th>
                <th>
                    <a name="" id="" class="btn btn-primary" href="{{ route('tahapan.edit', [$t->id]) }}" role="button">
                        <i class="fa fa-edit" aria-hidden="true"></i>
                    </a>
                </th>
            </tr>
            @empty
            <tr>
                <td colspan="4">Data Kosong</td>
            </tr>

            @endforelse

        </tbody>
</table>
