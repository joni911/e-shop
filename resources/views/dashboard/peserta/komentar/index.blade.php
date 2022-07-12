@include('global.alert')
<div class="card-footer card-comments">
    @foreach ($komen as $k)
    <div class="card-comment">
        <!-- User image -->
        <img class="img-circle img-sm" src="{{ asset('default/user.png') }}" alt="">

        <div class="comment-text">
            <span class="username">
               {{$k->user}}
                <span class="text-muted float-right">{{$k->created_at->locale('id')->isoFormat('dddd D MMMM Y hh:mm:ss')}}</span>
            </span>
            <!-- /.username -->
            {{$k->komentar}}
        </div>
        <!-- /.comment-text -->
    </div>
    @endforeach

</div>
<!-- /.card-footer -->
<div class="card-footer">
    <form action="{{ route('komen.store') }}" method="post">
        @csrf
        <img class="img-fluid img-circle img-sm" src="{{ asset('default/user.png') }}" alt="">
        <!-- .img-push is used to add margin to elements next to floating images -->
        <div class="container">
            <div class="row">
                <div class="col-sm">
                    <input type="text" name="id" id="" value="{{$data->id}}" hidden>
                    <input type="text" name="komentar"class="form-control form-control-sm" placeholder="Tekan Kirim Untuk Mengirim Komentar">
                </div>
                <div class="col-sm">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-paper-plane    "></i> Kirim</button>
                </div>

            </div>
        </div>
    </form>
</div>
