<!DOCTYPE html>
<html lang="en">

<head>
    @include('Admin.headTag')

</head>

<body>
    @include('Admin.header')

    <div class="d-flex align-items-stretch">
        @include('Admin.sidebar')

        <div class="page-content">
            <div class="page-header">
                <div class="container-fluid">
                    <h2 class="h5 no-margin-bottom">View Products</h2>
                </div>
            </div>

            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card shadow border-0 rounded-4 bg-dark">
                            <div class="card-body p-5">
                                <h2 class="text-center fw-bold mb-4 text-light">Product List</h2>

                                <div class="container mb-4">
                                    <form action="{{ url('product_search') }}" method="GET" class="row g-2 justify-content-center">
                                        @csrf
                                        <div class="col-md-6">
                                            <input type="text" name="search" class="form-control bg-light" placeholder="Search by Product Name or Code, Category, or Brand">
                                        </div>
                                        <div class="col-auto">
                                            <button type="submit" class="btn btn-success">Search</button>
                                        </div>
                                        <div class="col-auto">
                                            <a href="{{ url('view_product') }}" class="btn btn-warning">Reset</a>
                                        </div>
                                    </form>
                                </div>

                                <div class="table-responsive">
                                    <table class="table table-bordered text-center align-middle table-hover text-white" style="border-color: white;">
                                        <thead class="table-secondary text-dark">
                                            <tr>
                                                <th>S.No</th>
                                                <th>Product Name</th>
                                                <th>Product Code</th>
                                                <th>Image</th>
                                                <th>Description</th>
                                                <th>Original Price</th>
                                                <th>Market Price</th>
                                                <th>Category</th>
                                                <th>Brand</th>
                                                <th>Size</th>
                                                <th>Color</th>
                                                <th>Quantity</th>
                                                <th>Status</th>
                                                <th>Trending</th>
                                                <th>Featured</th>
                                                <th>Update</th>
                                                <th>Delete</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($products as $product)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $product->name }}</td>
                                                <td>{{ $product->product_code }}</td>
                                                <td>
                                                    <a href="{{ asset($product->image) }}" target="_blank">
                                                        <img src="{{ asset($product->image) }}" alt="Product Image" class="img-fluid cursor-pointer" title="View full view to click the image">
                                                    </a>
                                                </td>

                                                <td>{!! Str::words($product->description, 7) !!}</td>
                                                <td>{{ $product->store_price }}</td>
                                                <td>{{ $product->original_price }}</td>
                                                <td>{{ $product->category }}</td>
                                                <td>{{ $product->brand }}</td>
                                                <td>{{ $product->size }}</td>
                                                <td>{{ $product->color }}</td>
                                                <td>{{ $product->quantity }}</td>
                                                <td>{{ $product->status }}</td>
                                                <td>{{ $product->trending }}</td>
                                                <td>{{ $product->featured }}</td>
                                                <td>
                                                    <a href="{{ url('update_product', $product->slug) }}" class="btn btn-sm btn-info">Update</a>
                                                </td>
                                                <td>
                                                    <a href="{{ url('delete_product', $product->id) }}" class="btn btn-sm btn-danger" onclick="confirmDelete(event, this)">
                                                        Delete
                                                    </a>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                <!-- Pagination -->
                                <div class="d-flex flex-column align-items-center mt-4">
                                    <div class="mb-2">
                                        {{ $products->onEachSide(1)->links() }}
                                    </div>
                                    <div class="text-muted">
                                        Showing {{ $products->firstItem() }} to {{ $products->lastItem() }} of {{ $products->total() }} results
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('admincss/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('admincss/vendor/popper.js/umd/popper.min.js') }}"></script>
    <script src="{{ asset('admincss/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('admincss/vendor/jquery.cookie/jquery.cookie.js') }}"></script>
    <script src="{{ asset('admincss/vendor/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('admincss/vendor/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('admincss/js/charts-home.js') }}"></script>
    <script src="{{ asset('admincss/js/front.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function confirmDelete(event, element) {
            event.preventDefault();

            const url = element.getAttribute('href');

            Swal.fire({
                title: 'Are you sure you want to delete this product?',
                text: "This action cannot be undone.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, Delete it!',
                cancelButtonText: 'Cancel',
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = url;
                }
            });
        }
    </script>

</body>

</html>