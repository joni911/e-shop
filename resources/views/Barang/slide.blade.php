<div class="container my-4">
    <!--Carousel Wrapper-->
    <div id="carousel-thumb" class="carousel slide carousel-fade carousel-thumbnails" data-ride="carousel">
      <!--Slides-->
      <div class="carousel-inner" role="listbox">
        @foreach ($barang->barang_photo as $key => $bp)
            @if ($loop->first)
                <div class="carousel-item active">
                    <img class="d-block w-100" src="/{{$bp->foto}}" alt="First slide" width="360" height="240">
                </div>
            @else
            <div class="carousel-item">
                <img class="d-block w-100" src="/{{$bp->foto}}" alt="First slide" width="360" height="240">
            </div>
            @endif
        @endforeach
      </div>
      <!--/.Slides-->
      <!--Controls-->
      <a class="carousel-control-prev" href="#carousel-thumb" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#carousel-thumb" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
      <!--/.Controls-->
      <ol class="carousel-indicators">
          @php
              $i = 0;
          @endphp
        @foreach ($barang->barang_photo as $key => $bp)
        @if ($loop->first)
        <li data-target="#carousel-thumb" data-slide-to="{{$i++}}" class="active"> <img class="d-block w-100" src="/{{$bp->foto}}"
            class="img-fluid" width="36" height="24"></li>
        @else
        <li data-target="#carousel-thumb" data-slide-to="{{$i++}}"><img class="d-block w-100" src="/{{$bp->foto}}"
            class="img-fluid" width="36" height="24"></li>
        @endif
        @endforeach

      </ol>
    </div>
    <!--/.Carousel Wrapper-->

  </div>
