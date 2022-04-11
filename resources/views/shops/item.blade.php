<section class="py-5">
    <div class="container px-4 px-lg-5 mt-5">
        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
            @forelse ($barang as $b)
            <div class="col mb-5">
                <div class="card h-100">
                    <!-- Sale badge-->
                    <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">Sale</div>
                    <!-- Product image-->
                    @forelse ($b->barang_photo as $bp)
                    <img class="card-img-top" src="{{$bp->foto}}" alt="..." width="450" height="300"/>
                    @break
                    @empty

                    @endforelse
                    <!-- Product details-->
                    <div class="card-body p-4">
                        <div class="text-center">
                            <!-- Product name-->
                            <h5 class="fw-bolder">{{$b->nama}}</h5>
                            <p class="text-justify">{{$b->keterangan}}</p>
                            <!-- Product reviews-->
                            <div class="d-flex justify-content-center small text-warning mb-2">
                                <div class="bi-star-fill"></div>
                                <div class="bi-star-fill"></div>
                                <div class="bi-star-fill"></div>
                                <div class="bi-star-fill"></div>
                                <div class="bi-star-fill"></div>
                            </div>
                            <!-- Product price-->
                           @currency($b->harga)
                        </div>
                    </div>
                    <!-- Product actions-->
                    <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                        <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="{{ route('shops.add', ['id'=>$b->id]) }}">Add to cart</a></div>
                    </div>
                </div>
            </div>
            @empty

            @endforelse
            <div class="clearfix text-right">
                {{ $barang->links('pagination::bootstrap-4') }}
            </div>

        </div>
    </div>
</section>
