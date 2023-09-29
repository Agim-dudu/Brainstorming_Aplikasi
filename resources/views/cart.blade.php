<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Products</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-primary  text-light fixed">
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
    <div class="container-fluid my-2">
        @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <table class="table table-hover table-condensed">
            <thead>
                <tr>
                    <th style="width: 50%">Product</th>
                    <th style="width: 10%">Price</th>
                    <th style="width: 8%">Quantity</th>
                    <th style="width: 22%">Subtotal</th>
                    <th style="width: 10%">Subtotal</th>
                </tr>
            </thead>


            <tbody>
                @php
                    $total = 0;
                @endphp
                @foreach ((array)session('cart') as $id => $details)
                    @php
                        $total += $details['price'] * $details['quantity'];
                    @endphp
                    <tr data-id="{{ $id }}">
                        <td>
                            <div class="row">
                                <div class="col-sm-3"><img src="{{ asset('storage/images/product/')}}/{{ $details['photo'] }}" width="100" height="100" class="img-fluid"></div>
                                <div class="col-sm-9">
                                    <h4 class="m-0">{{ $details['product_name'] }}</h4>
                                </div>
                            </div>
                        </td>
                        <td>Rp. {{ $details['price'] }}</td>
                        <td class="text-center">{{ $details['quantity'] }}</td>
                        <td>Rp. {{ $details['price'] * $details['quantity'] }}</td>
                        <td>
                            <button class="btn btn-danger btn-sm cart-delete"><i class="fa fa-trash-o"></i> Delete</button>
                        </td>
                    </tr>
                    
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td class="text-end" colspan="5"><h3>Total: Rp. {{ $total }}</h3></td>
                </tr>
                <tr>
                    <td colspan="5" class="text-end">
                        <a href="{{ route('product') }}" class="btn btn-danger"><i class="fa fa-arrow-left"></i> Continue Shopping</a>
                        <button class="btn btn-success"><i class="fa fa-money"></i> Checkout</button>
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
    <script>
        $(".cart-delete").click(function (e){
            e.preventDefault();


            var ele =$(this);


            if (confirm("Apakah kamu benar ingin menghapus?")) {
                $.ajax({
                    type: "DELETE",
                    url: "{{ route('remove_from_cart') }}",
                    data: {
                        _token : '{{ csrf_token() }}',
                        id : ele.parents("tr").attr("data-id")
                    },
                    success: function (response) {
                        window.location.reload();  
                    }
                });
            }
        })
    </script>

</body>
</html>
