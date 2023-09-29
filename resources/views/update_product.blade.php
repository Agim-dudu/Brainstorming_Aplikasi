<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">


</head>

<body>
    <nav class="navbar navbar-expand-lg bg-primary  text-light fixed">
        <div class="container-fluid">
            <a class="navbar-brand text-light" href="#">AMC Tech</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-link active text-light" aria-current="page" href="{{ route('product') }}">Home</a>
                    @php
                    if (Auth::user()->is_admin == 1) {
                    @endphp
                    <a class="nav-link text-light" aria-current="page"
                        href="{{route('admin.tambah_data.create')}}">Tambah Data</a>
                    <a class="nav-link text-light" aria-current="page" href="{{route('admin.tabel_data.index')}}">Table
                        Data</a>
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
                <h2>Update Data</h2>
                {{-- <h3>Ini adalah halaman Dashboard</h3> --}}
            </div>
        </div>
    </div>

    <div class="row justify-content-center ">
        <div class="col-lg-11">
            <!-- Form Basic -->
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Update Data Products</h6>
                    @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                    @endif
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.product.update', $products->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @method('PUT')
                        @csrf

                        <div class="form-group mb-2">
                            <label for="product_name">Product Name</label>
                            <input type="text" class="form-control @error('product_name') is-invalid @enderror"
                                id="product_name" name="product_name" placeholder="Product Name"
                                value="{{ old('product_name', $products->product_name) }}">
                            @error('product_name')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-2">
                            <label for="product_description">Product Description</label>
                            <textarea class="form-control @error('product_description') is-invalid @enderror"
                                id="product_description" name="product_description" placeholder="Product Description"
                                required>{{ old('product_description', $products->product_description) }}</textarea>
                            @error('product_description')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-2">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="photo" name="photo">
                                <label class="custom-file-label mb-4" for="photo">{{ $products->photo }}</label>
                            </div>
                            @if ($products->photo)
                            <img src="{{ asset('storage/images/product/' . $products->photo) }}"
                                alt="{{ $products->product_name }} Photo" width="100">
                            @endif
                        </div>

                        <div class="form-group mb-2">
                            <label for="price">Price</label>
                            <input type="number" class="form-control @error('price') is-invalid @enderror" id="price"
                                name="price" placeholder="Price" value="{{ old('price', $products->price) }}">
                            @error('price')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Update Product</button>
                    </form>



                </div>
            </div>
        </div>



        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
        </script>
</body>

</html>
