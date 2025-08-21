<!-- Product Section Begin -->
<section class="product spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <ul class="filter__controls">
                    <li class="active" data-filter="*">Best Sellers</li>
                    <li data-filter=".new-arrivals">New Arrivals</li>
                    <li data-filter=".hot-sales">Hot Sales</li>
                </ul>
            </div>
        </div>

        <div class="row product__filter">
            @foreach ($products as $product)
            <div class="col-lg-3 col-md-6 col-sm-6 mix new-arrivals">
                <div class="product__item">
                    <!-- <span class="label">New</span> -->
                    <div class="product__item__pic set-bg" data-setbg="{{ asset($product->image) }}">
                        <ul class="product__hover">
                            <li>
                                <a href="javascript:void(0);"
                                    class="add-to-wishlist"
                                    data-product-id="{{ $product->id }}">
                                    <img src="{{ asset('img/icon/heart.png') }}" alt="wishlist">
                                </a>
                            </li>
                            <li><a href="{{url('product_details',$product->slug)}}"><img src="{{ asset('img/icon/search.png') }}" alt="view product" title="customize product"></a></li>
                        </ul>
                    </div>
                    <!-- <li><a href="#"><img src="{{ asset('img/icon/compare.png') }}" alt=""> <span>Compare</span></a></li> -->
                    <div class="product__item__text">
                        <h6>{{ $product->name }}</h6>
                        <form action="{{ url('add_cart', $product->id) }}" method="POST">
                            @csrf
                            <input type="hidden" name="quantity" value="1">
                            <input type="hidden" name="customImage" value="">
                            <button type="submit" class="btn btn-none add-cart">+ Add To Cart</button>
                        </form>
                        <div class="rating">
                            <i class="fa fa-star-o"></i>
                            <i class="fa fa-star-o"></i>
                            <i class="fa fa-star-o"></i>
                            <i class="fa fa-star-o"></i>
                            <i class="fa fa-star-o"></i>
                        </div>
                        <h5 class="product-price" data-usd-price="{{ $product->store_price }}">${{ $product->store_price }}</h5>

                        <div class="product__color__select">
                            <!-- <label for="pc-1">
                                <input type="radio" id="pc-1">
                            </label>
                            <label class="active black" for="pc-2">
                                <input type="radio" id="pc-2">
                            </label>
                            <label class="grey" for="pc-3">
                                <input type="radio" id="pc-3">
                            </label> -->
                            <li class="customize-btn" style="list-style: none;">
                                <a href="{{ url('product_details', $product->slug) }}" class="btn btn-outline-success">Customize Here</a>
                            </li>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Add to wishlist click handler (works for both home + details page)
            document.querySelectorAll(".add-to-wishlist").forEach(el => {
                el.addEventListener("click", function(e) {
                    e.preventDefault();

                    let productId = this.getAttribute("data-product-id");

                    fetch("{{ url('add_to_wishlist') }}", {
                            method: "POST",
                            headers: {
                                "X-CSRF-TOKEN": "{{ csrf_token() }}",
                                "Content-Type": "application/json"
                            },
                            body: JSON.stringify({
                                product_id: productId
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            alert(data.message); // show backend response

                            // update wishlist count if exists
                            if (data.wishlistCount !== undefined && document.getElementById("wishlistCount")) {
                                document.getElementById("wishlistCount").innerText = data.wishlistCount;
                            }
                        })
                        .catch(err => console.error(err));
                });
            });
        });
    </script>

</section>
<!-- Product Section End -->