<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">


</head>
<body>
    <nav class="navbar navbar-expand-lg bg-primary mx-4 my-2 text-light rounded">
        <div class="container-fluid">
            <a class="navbar-brand text-light" href="#">AMC Tech</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-link active text-light" aria-current="page" href="{{ route('product') }}">Home</a>
                    @php
                        if (Auth::user()->is_admin == 1) {
                    @endphp
                        <a class="nav-link text-light" aria-current="page" href="{{route('admin.tambah_data.create')}}">Tambah Data</a>
                        <a class="nav-link text-light" aria-current="page" href="{{route('admin.tabel_data.index')}}">Table Data</a>
                    @php
                        }
                    @endphp
                </div>
            </div>
            <div class="text-end d-flex align-items-center">
                <div class="user me-3">
                    Halo, {{ Auth::user()->name }}
                </div>
                <div class="logout">
                    <a href="{{ route('login.logout') }}" class="btn btn-danger text-light">Logout</a>
                </div>
            </div>
        </div>
    </nav>

    <div class="container text-center my-4">
        <div class="row">
            <div class="col">
                <h2>Selamat Datang, {{ Auth::user()->name }}</h2>
                {{-- <h3>Ini adalah halaman Dashboard</h3> --}}
            </div>
        </div>
    </div>

    <div class="container my-4">
        <div class="row justify-content-end">
            <div class="col">
                <div class="dropdown">
                    <button class="btn btn-primary" data-bs-toggle="dropdown">
                        <i class="fa fa-shopping-cart" aria-hidden="true"></i> Cart <span class="badge text-bg-danger">{{ count((array) session('cart')) }}</span>
                    </button>
                    <div class="dropdown-menu w-25">
                        <div class="row m-2">
                            @php
                                $total = 0;
    
                                foreach ((array) session('cart') as $id => $details) {
                                    $total+= $details['price'] * $details['quantity'];
                                }
                            @endphp
                            <div class="col-12 text-right">
                                <p>Total: Rp. {{ $total }}</p>
                            </div>
                        </div>


                        @if (session('cart'))
                            @foreach (session('cart') as $id => $details)
                                <div class="row p-3">
                                    <div class="col-4">
                                        <img src="{{ asset('storage/images/product/')}}/{{ $details['photo'] }}" class="img-fluid">
                                    </div>
                                    <div class="col-8">
                                        <p class="m-0">{{ $details['product_name'] }}</p>
                                        <span class="price text-info">Rp. {{ $details['price'] }}</span> <span class="count"> Quantity: {{ $details['quantity'] }}</span>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                        
                        <div class="row m-2">
                            <div class="d-grid gap-2">
                                <a href="{{route('cart')}}" class="btn btn-primary">View all</a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="container">
        @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <div class="row">
            @foreach ($products as $product)
                <div class="col-md-3 col-sm-6 mt-3">
                    <div class="img_thumbnail productlist">
                        <img src="{{ asset('storage/images/product/' . $product->photo) }}" class="img-fluid">
                        <div class="caption">
                            <h4>{{ $product->product_name }}</h4>
                            <p>{{ $product->product_description }}</p>
                            <p><strong>Price: </strong>Rp. {{ $product->price }}</p>
                            <p class="btn-holder">
                                <a href="{{ route('add_to_cart', $product->id) }}" class="btn btn-primary btn-block text-center" role="button">
                                    Add to cart
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
  


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>