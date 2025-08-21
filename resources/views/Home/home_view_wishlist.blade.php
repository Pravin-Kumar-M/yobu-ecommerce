<!DOCTYPE html>
<html lang="en">

<head>
    @include ('Home.home_headSection')

    <style>
        .product-item:hover {
            transform: scale(1.03);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .btn-outline-primary:hover {
            background-color: #0d6efd;
            color: #fff;
        }

        .btn-outline-danger:hover {
            background-color: #dc3545;
            color: #fff;
        }
    </style>
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    @include ('Home.home_header')

    <section class="wishlist-section spad">
        <div class="container">
            <h3 class="mb-4 text-center fw-bold">My Wishlist </h3>
            <div class="row">
                @forelse($wishlistItems as $item)
                <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                    <div class="product-item shadow-sm border rounded-4 p-3 h-100 transition-all" style="transition: transform 0.3s ease;">
                        <div class="pi-pic position-relative overflow-hidden rounded-3" style="height: 250px;">
                            <img src="{{ asset($item->product->image) }}" class="w-100 h-100 object-fit-cover" alt="{{ $item->product->name }}">
                            <span class="badge bg-danger position-absolute top-0 end-0 m-2"></span>
                        </div>
                        <div class="pi-text mt-3 text-center">
                            <h6 class="text-success">${{ $item->product->original_price }}</h6>
                            <p class="fw-bold text-dark mt-2">{{ $item->product->name }}</p>
                            <a href="{{ route('product_details', $item->product->slug) }}" class="btn btn-outline-primary btn-sm mt-2 transition-all">
                                View Product
                            </a>
                            <form action="{{ route('wishlist.delete', $item->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger btn-sm mt-2" onclick="return confirm('Remove from wishlist?')">
                                    <i class="bi bi-trash"></i> Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                @empty
                <div class="text-center col-12">
                    <p class="text-muted fs-5">No items in your wishlist</p>
                </div>
                @endforelse
            </div>
        </div>
    </section>


    @include ('Home.home_footer')


</body>

</html>