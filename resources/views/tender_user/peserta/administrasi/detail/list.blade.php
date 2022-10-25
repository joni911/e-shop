<?php
    $no = 1;
?>
<h2>File Yang Sudah Di Upload</h2>
@forelse ($list as $l)
    <p>{{$no++}}. <a href="/{{$l->file}}">{{$l->nama}}</a></p>
@empty

@endforelse
