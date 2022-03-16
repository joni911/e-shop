<div class="card-footer card-comments">
    <div class="card-comment">
        <!-- User image -->
        @forelse ($komentar as $k)
            <img class="img-circle img-sm" src="" alt="!">

        <div class="comment-text">
            <span class="username">
                {{$k->nama_user}}
                <span class="text-muted float-right">{{$k->created_at}}</span>
            </span>
            <!-- /.username -->
            {{$k->komentar   }}
        </div>
        @empty

        @endforelse

        <!-- /.comment-text -->
    </div>
    <!-- /.card-comment -->
</div>

<form action="{{ route('komentar.store') }}" method="post">
    @csrf

    <input type="text" class="form-control" name="id" value="{{$barang->id}}" id=""
        aria-describedby="helpId" placeholder="" hidden>

    <div class="form-group">
        <label for="">Komentar</label>
        <textarea class="form-control" name="komentar" id="komentar" rows="3"></textarea>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </div>
</form>
