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
                <h2>Tambah Data</h2>
                {{-- <h3>Ini adalah halaman Dashboard</h3> --}}
            </div>
        </div>
    </div>

    <div class="row justify-content-center ">
        <div class="col-lg-6">
            <!-- Form Basic -->
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Tambah Data Products</h6>
                    @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                    @endif
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.tambah_data.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-2">
                            <label for="product_name">Product Name</label>
                            <input type="text" class="form-control @error('product_name') is-invalid @enderror"
                                id="product_name" name="product_name" placeholder="Product Name">
                            @error('product_name')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-2">
                            <label for="product_description">Product Description</label>
                            <textarea class="form-control @error('product_description') is-invalid @enderror"
                                id="product_description" name="product_description" placeholder="Product Description"
                                required></textarea>
                            @error('product_description')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-2">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="photo" name="photo">
                                <label class="custom-file-label" for="photo"></label>
                            </div>
                        </div>
                        <div class="form-group mb-2">
                            <label for="price">Price</label>
                            <input type="number" class="form-control @error('price') is-invalid @enderror" id="price"
                                name="price" placeholder="Price">
                            @error('price')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Create Product</button>
                    </form>

                </div>
            </div>
        </div>
        <div class="col-lg-5">
            <!-- Form Basic -->
            <div class="card mb-4 mx-2">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Tambah Data Pengguna</h6>
                </div>
                <div class="card-body">
                    <form action="{{route('register.store')}}" method="post">
                        @csrf
                        <div class="form-group mb-2">
                            <label for="exampleInputEmail1">Username</label>
                            <input type="text" class="form-control @error('UsernameInput') is-invalid @enderror"
                                placeholder="Username" required id="UsernameInput" name="UsernameInput"
                                value="{{ old('UsernameInput') }}">
                            @error('UsernameInput')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group mb-2">
                            <label for="exampleInputPassword1">Email</label>
                            <input type="email" class="form-control @error('emailInput') is-invalid @enderror"
                                placeholder="Email" required id="emailInput" name="emailInput"
                                value="{{ old('emailInput') }}">
                            <small id="emailHelp" class="form-text text-muted">We'll never share your
                                Email with anyone else.</small>
                            @error('emailInput')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group mb-2">
                            <label for="exampleInputPassword1">Password</label>
                            <input type="password" class="form-control @error('passwordInput') is-invalid @enderror"
                                placeholder="Password" required id="passwordInput" name="passwordInput">
                            @error('passwordInput')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group mb-2">
                            <label for="exampleInputPassword1">Confirm Password</label>
                            <input type="password"
                                class="form-control @error('passwordInput_confirmation') is-invalid @enderror"
                                placeholder="Konfirmasi Password" required id="passwordInput_confirmation"
                                name="passwordInput_confirmation">
                            @error('passwordInput_confirmation')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        {{-- <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input"
                                    id="customControlAutosizing">
                                <label class="custom-control-label"
                                    for="customControlAutosizing">Remember me</label>
                            </div>
                        </div> --}}
                        <button type="submit" class="btn btn-primary">Create User</button>
                    </form>
                </div>
            </div>
        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
</body>

</html>
