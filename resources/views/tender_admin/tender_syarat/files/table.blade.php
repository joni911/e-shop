<table class="table table-default table-inverse table-responsive">
    <thead class="thead-inverse">
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Download</th>
            {{-- <th>Aksi</th> --}}
        </tr>
        </thead>
        <tbody>
            <?php
                $i = 1;
            ?>
            @forelse ($persyaratan->tender_persyaratan_file as $t)
            <tr>
                @php
                    $ext = pathinfo($t->file, PATHINFO_EXTENSION)
                @endphp
                <td scope="row">{{$i++}}</td>
                <td>{{$t->nama ?? ""}}</td>
                <th><a href="/{{$t->file ?? ""}}" download="{{$t->nama}}">Download </a>
                </th>
                <th>
                    @if ($admin->hak_akses == 'admin')
                        <form method="POST" action="{{ route('tender_persyaratan_file.destroy', $t->id) }}">
                            @csrf
                            @method("DELETE")
                            <button type="submit" onclick="return confirm('Are you sure?')" class="btn btn-danger" data-toggle="tooltip" title='Delete'><i class="fas fa-trash    "></i></button>
                        </form>
                    @endif
                    {{-- <a name="" id="" class="btn btn-primary" href="{{ route('tender_file.edit', [$t->id]) }}" role="button">
                        <i class="fa fa-edit" aria-hidden="true"></i>
                    </a> --}}
                </th>
            </tr>
            @empty
            <tr>
                <td colspan="4">Data Kosong</td>
            </tr>

            @endforelse

        </tbody>
</table>
