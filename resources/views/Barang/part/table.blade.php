{{-- <div class="card">
    <div class="card-header">
      <h3 class="card-title">Tabel Barang</h3>
      <br>
      <a name="" id="" class="btn btn-primary" href="{{ route('barang.create') }}" role="button">Tambah</a>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th style="width: 10px">No</th>
            <th>Nama</th>
            <th>Jumlah</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
            @forelse ($barang as $no => $b)

                <tr>
                    <td scope="row">{{$no}}</td>

                    <td> <a href="{{ route('barang.show', [$b->id]) }}">{{$b->nama}}</a></td>
                    <td>{{$b->inventory_barang->jumlah}}</td>
                    <td>
                        <a name="" id="" class="btn btn-primary" href="{{ route('barang.edit', [$b->id]) }}" role="button">Edit</a>
                    </td>
                  </tr>
            @empty
                <tr>
                    <td colspan="3" align="center">Kosong</td>
                </tr>
            @endforelse


        </tbody>
      </table>
    </div>
    <!-- /.card-body -->
    <div class="card-footer clearfix">
      <ul class="pagination pagination-sm m-0 float-right">
        <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
        <li class="page-item"><a class="page-link" href="#">1</a></li>
        <li class="page-item"><a class="page-link" href="#">2</a></li>
        <li class="page-item"><a class="page-link" href="#">3</a></li>
        <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
      </ul>
    </div>
  </div> --}}

  

  <!doctype html>
  <html lang="en">
    <head>
      <title>Table 06</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,700' rel='stylesheet' type='text/css'>
  
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <link rel="stylesheet" href="{{ asset('assets/css/style.css')}}"> 
  
    </head>
    <body>
      {{-- <div>
        <h3 class="card-title">Tabel Barang</h3>
        <br>
        <a name="" id="" class="btn btn-primary" href="{{ route('barang.create') }}" role="button">Tambah</a>
      </div> --}}
    
      <div class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              
                <h4 class="card-title" style="margin-left: 20px; margin-top: 20px;" >Tabel Barang</h4>
              
              <div class="update ml-3">
                
                <a type="submit" class="btn btn-primary" href="{{ route('barang.create') }}" role="button" style="margin-left: 5px; margin-top: 20px;" ><b>+ Tambah</b></a>
                
              </div>
              <div class="card-body">
                <div class="table-responsive">
          
              <table class="table">
                <thead class="thead-primary">
                  <tr>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>total</th>
                    <th>&nbsp;</th>
                  </tr>
                </thead>
                <tbody>
                  <tr class="alert" role="alert">
                    <td>
                      <label class="checkbox-wrap checkbox-primary">
                        <input type="checkbox" checked>
                        <span class="checkmark"></span>
                      </label>
                    </td>
                    <td>
                      <div class="img" style="background-image: url(images/product-1.png);"></div>
                    </td>
                    <td>
                      <div class="email">
                        <span>Sneakers Shoes 2020 For Men </span>
                        <span>Fugiat voluptates quasi nemo, ipsa perferendis</span>
                      </div>
                    </td>
                    <td>$44.99</td>
                    <td class="quantity">
                      <div class="input-group">
                         <input type="text" name="quantity" class="quantity form-control input-number" value="2" min="1" max="100">
                      </div>
                    </td>
                    <td>$89.98</td>
                    <td>
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true"><i class="fa fa-close"></i></span>
                      </button>
                    </td>
                  </tr>
  
                  <tr class="alert" role="alert">
                    <td>
                      <label class="checkbox-wrap checkbox-primary">
                        <input type="checkbox">
                        <span class="checkmark"></span>
                      </label>
                    </td>
                    <td>
                      <div class="img" style="background-image: url(images/product-2.png);"></div>
                    </td>
                    <td>
                      <div class="email">
                        <span>Sneakers Shoes 2020 For Men </span>
                        <span>Fugiat voluptates quasi nemo, ipsa perferendis</span>
                      </div>
                    </td>
                    <td>$30.99</td>
                    <td class="quantity">
                      <div class="input-group">
                         <input type="text" name="quantity" class="quantity form-control input-number" value="1" min="1" max="100">
                      </div>
                    </td>
                    <td>$30.99</td>
                    <td>
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true"><i class="fa fa-close"></i></span>
                      </button>
                    </td>
                  </tr>
  
                  <tr class="alert" role="alert">
                    <td>
                      <label class="checkbox-wrap checkbox-primary">
                        <input type="checkbox">
                        <span class="checkmark"></span>
                      </label>
                    </td>
                    <td>
                      <div class="img" style="background-image: url(images/product-3.png);"></div>
                    </td>
                    <td>
                      <div class="email">
                        <span>Sneakers Shoes 2020 For Men </span>
                        <span>Fugiat voluptates quasi nemo, ipsa perferendis</span>
                      </div>
                    </td>
                    <td>$35.50</td>
                    <td class="quantity">
                      <div class="input-group">
                         <input type="text" name="quantity" class="quantity form-control input-number" value="1" min="1" max="100">
                      </div>
                    </td>
                    <td>$35.50</td>
                    <td>
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true"><i class="fa fa-close"></i></span>
                      </button>
                    </td>
                  </tr>
  
                  <tr class="alert" role="alert">
                    <td>
                      <label class="checkbox-wrap checkbox-primary">
                        <input type="checkbox">
                        <span class="checkmark"></span>
                      </label>
                    </td>
                    <td>
                      <div class="img" style="background-image: url(images/product-4.png);"></div>
                    </td>
                    <td>
                      <div class="email">
                        <span>Sneakers Shoes 2020 For Men </span>
                        <span>Fugiat voluptates quasi nemo, ipsa perferendis</span>
                      </div>
                    </td>
                    <td>$76.99</td>
                    <td class="quantity">
                      <div class="input-group">
                         <input type="text" name="quantity" class="quantity form-control input-number" value="1" min="1" max="100">
                      </div>
                    </td>
                    <td>$76.99</td>
                    <td>
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true"><i class="fa fa-close"></i></span>
                      </button>
                    </td>
                  </tr>
  
                  <tr class="alert" role="alert">
                    <td class="border-bottom-0">
                      <label class="checkbox-wrap checkbox-primary">
                        <input type="checkbox">
                        <span class="checkmark"></span>
                      </label>
                    </td>
                    <td class="border-bottom-0">
                      <div class="img" style="background-image: url(images/product-1.png);"></div>
                    </td>
                    <td class="border-bottom-0">
                      <div class="email">
                        <span>Sneakers Shoes 2020 For Men </span>
                        <span>Fugiat voluptates quasi nemo, ipsa perferendis</span>
                      </div>
                    </td>
                    <td class="border-bottom-0">$40.00</td>
                    <td class="quantity border-bottom-0">
                      <div class="input-group">
                         <input type="text" name="quantity" class="quantity form-control input-number" value="1" min="1" max="100">
                      </div>
                    </td>
                    <td class="border-bottom-0">$40.00</td>
                    <td class="border-bottom-0">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true"><i class="fa fa-close"></i></span>
                      </button>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      
    </div>
  </div>
        
    
  
    <script src="{{ asset('assets/js/jquery.min.js')}}"></script> 
    <script src="{{ asset('assets/js/popper.js')}}"></script> 
    <script src="{{ asset('assets/js/bootstrap.min.js')}}"></script> 
    <script src="{{ asset('assets/js/main.js')}}"></script> 
  
    </body>
  </html>
  
  