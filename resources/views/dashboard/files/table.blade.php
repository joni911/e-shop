<table class="table table-default table-inverse table-responsive">
    <thead class="thead-inverse">
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Keterangan</th>
            <th>Aksi</th>
        </tr>
        </thead>
        <tbody>
            <?php
                $i = 1;
            ?>
            @forelse ($table as $t)
            <tr>
                <td scope="row">{{$i++}}</td>
                <td>{{$t->nama ?? ""}}</td>
                <th>{{$t->keterangan ?? ""}}
                </th>
                <th>
                    <a name="" id="" class="btn btn-primary" href="{{ route('tender_file.edit', [$t->id]) }}" role="button">
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
