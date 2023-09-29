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
    <nav class="navbar navbar-expand-lg bg-primary mx-4 my-2 text-light rounded">
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
                    {{-- Halo, {{ Auth::user()->name }} --}}
                </div>
                <div class="logout">
                    <a href="" class="btn btn-danger text-light">Logout</a>
                </div>
            </div>
        </div>
    </nav>

    <div class="container text-center my-4">
        <div class="row">
            @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            <div class="col-lg-12 mb-4">
                <!-- Simple Tables -->
                <div class="card mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Data Products</h6>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th>Nama Product</th>
                                    <th>Deskripsi</th>
                                    <th>photo</th>
                                    <th>Price</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $n= 1;
                                @endphp
                                @foreach ($products as $product)
                                <tr>
                                    <td><a>{{ $product->product_name }}</a></td>
                                    <td>{{ $product->product_description }}</td>
                                    {{-- <td>{{ $product->photo }}</td> --}}
                                    <td><img style="width: 100px;height: 100px;object-fit: cover;border-radius: 20%;"
                                            src="{{ asset('storage/images/product/' . $product->photo) }}"
                                            alt="gambar product"></td>
                                    <td>{{ $product->price }}</td>
                                    <td>
                                        <a href="{{route('admin.product.edit', $product->id)}}" class="btn btn-primary btn-lg">Edit</a>
                                        <form action="{{route('admin.product.destroy', $product->id)}}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button style="margin-top:10px;" class="btn btn-danger"
                                                onclick="confirm('anda yakin ingin menghapus data ini? ')"
                                                type="submit">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                                @php
                                $n++;
                                @endphp
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer"></div>
                </div>
                <div class="card mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary ">Data Pengguna</h6>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Keterangan</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $n= 1;
                                @endphp
                                @foreach ($users as $user)
                                <tr>
                                    <td><a>{{ $user->name }}</a></td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->is_admin == 0 ? 'Pengguna' : 'Admin' }}</td>
                                    <td>
                                        <a href="" class="btn btn-primary btn-lg">Edit</a>
                                        <form action="" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button style="margin-top:10px;" class="btn btn-danger"
                                                onclick="confirm('anda yakin ingin menghapus data ini? ')"
                                                type="submit">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                                @php
                                $n++;
                                @endphp
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer"></div>
                </div>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
</body>

</html>
