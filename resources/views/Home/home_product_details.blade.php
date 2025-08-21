<!DOCTYPE html>
<html lang="en">

<head>
    @include ('Home.home_headSection')

    <style>
        .product-price .market-price {
            text-decoration: line-through;
            color: #999;
            font-weight: bold;
        }

        .product-price .original-price {
            text-decoration: none;
            color: #000;
            font-weight: bold;
        }

        .product__details__btns__option form button {
            display: inline-block;
            font-size: 13px;
            color: #3d3d3d;
            letter-spacing: 2px;
            text-transform: uppercase;
            font-weight: 700;
            margin-right: 20px;
        }
    </style>
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    @include ('Home.home_header')


    <!-- Shop Details Section Begin -->


    <section class="shop-details">
        <div class="product__details__pic">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="product__details__breadcrumb">
                            <a href="{{url('/dashboard')}}">Home</a>
                            <a href="{{url('/shop')}}">Shop</a>
                            <span>Product Details</span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <!-- image -->
                    <div class="col-lg-6 col-md-9">
                        <div class="tab-content">
                            <div class="tab-pane active" id="tabs-1" role="tabpanel">
                                <div class="product__details__pic__item text-center">
                                    <!-- Canvas for customization -->
                                    <canvas id="designCanvas" width="500" height="500" data-bg="{{ asset($products->image) }}"></canvas>

                                    <!-- Customization Controls -->
                                    <div class="mt-4 p-3 border rounded bg-light shadow-sm">
                                        <!-- Main Controls -->
                                        <div class="mb-3">
                                            <h6 class="fw-bold mb-2">Main Controls</h6>
                                            <div class="d-flex align-items-center justify-content-center flex-wrap " style="gap: 15px;">
                                                <button class="btn btn-primary btn-sm" onclick="showTextControls()">Add Text</button>
                                                <button class="btn btn-primary btn-sm" onclick="showImageControls()">Add Image</button>
                                                <button class="btn btn-primary btn-sm" onclick="showStickerControls()">Add Sticker</button>
                                            </div>
                                        </div>

                                        <!-- Text Tools Group -->
                                        <div class="mb-3" id="textControls" style="display:none;">
                                            <h6 class="fw-bold mb-2">Text Controls</h6>
                                            <div class="d-flex align-items-center flex-wrap" style="gap: 10px;">
                                                <button class="btn btn-dark btn-sm" onclick="addText()"> Add Text</button>
                                                <div id="textToolbar" class="d-flex align-items-center flex-wrap" style="display:none;gap:15px">
                                                    <button class="btn btn-dark btn-sm" onclick="toggleBold()"><strong>B</strong></button>
                                                    <button class="btn btn-dark btn-sm" onclick="toggleUnderline()"><u>U</u></button>
                                                    <select onchange="changeFontFamily(this.value)" class="form-select form-select-sm w-auto">
                                                        <option value="Arial" selected>Arial</option>
                                                        <option value="Courier New">Courier New</option>
                                                        <option value="Georgia">Georgia</option>
                                                        <option value="Times New Roman">Times New Roman</option>
                                                        <option value="Verdana">Verdana</option>
                                                    </select>
                                                    <div class="form-control-sm border rounded p-0">
                                                        <input type="color" onchange="changeTextColor(this.value)" class="form-control form-control-color border-0 p-1" title="Choose text color" style="height: 30px; width: 40px;">
                                                    </div>
                                                    <button class="btn btn-danger btn-sm" onclick="deleteSelectedObject()">Delete</button>
                                                </div>
                                                <button id="removeAllTextsBtn" class="btn btn-danger btn-sm" style="display: none;" onclick="removeAllTexts()">Remove All Texts</button>
                                            </div>
                                        </div>

                                        <!-- Image Controls -->
                                        <div class="mb-3" id="imageControls" style="display:none;">
                                            <h6 class="fw-bold mb-2">Image Controls</h6>
                                            <div class="d-flex align-items-center flex-wrap gap-2">
                                                <label for="uploadImage" class="btn btn-dark btn-sm">Add Image</label>
                                                <input type="file" id="uploadImage" onchange="addImage(event)" class="form-control-file d-none">
                                                <button id="removeAllImagesBtn" class="btn btn-danger btn-sm" style="display: none;" onclick="removeAllImages()">Remove All Images</button>
                                            </div>
                                        </div>

                                        <!-- Sticker Controls -->
                                        <div class="mb-3" id="stickerControls" style="display:none;">
                                            <h6 class="fw-bold mb-2">Sticker Controls</h6>
                                            <div class="d-flex align-items-center flex-wrap gap-2">
                                                <button class="btn btn-dark btn-sm" onclick="loadStickers()">Load Stickers</button>
                                                <button id="removeAllStickersBtn" class="btn btn-danger btn-sm" style="display: none;" onclick="removeAllStickers()">Remove All Stickers</button>
                                            </div>
                                            <div id="stickerPanel" class="mt-3 d-flex flex-wrap gap-2 border p-2 rounded bg-white shadow-sm" style="display: none;"></div>
                                        </div>
                                    </div>



                                    <!-- Global Delete Button -->
                                    <button id="deleteStickerBtn" class="btn btn-danger btn-sm" style="display: none;" onclick="deleteSelectedObject()">
                                        Delete Selected
                                    </button>

                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- customization -->
                    <div class="col-lg-6">
                        <div class="product__details__text" style="justify-content:start;">
                            <h3>{{$products->name}}</h3>
                            <div class="rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star-o"></i>
                                <span> - 5 Reviews</span>
                            </div>
                            <hr>

                            <p>{{$products->description}}</p>

                            <div class=" product__details__option">
                                <hr>
                                <div class="product__details__option__size">
                                    <span>Size:</span>
                                    <label for="xxl">xxl
                                        <input type="radio" id="xxl">
                                    </label>
                                    <label class="active" for="xl">xl
                                        <input type="radio" id="xl">
                                    </label>
                                    <label for="l">l
                                        <input type="radio" id="l">
                                    </label>
                                    <label for="sm">s
                                        <input type="radio" id="sm">
                                    </label>
                                </div>
                                <hr>
                                <div class="product__details__option__color">
                                    <span>Color:</span>
                                    <label class="c-1" for="sp-1">
                                        <input type="radio" name="productColor" id="sp-1" onclick="changeOverlayColor('#0b090c')"> <!-- black -->
                                    </label>
                                    <label class="c-2" for="sp-2">
                                        <input type="radio" name="productColor" id="sp-2" onclick="changeOverlayColor('#20315f')"> <!-- Green -->
                                    </label>
                                    <label class="c-3" for="sp-3">
                                        <input type="radio" name="productColor" id="sp-3" onclick="changeOverlayColor('#f1af4d')"> <!-- orange -->
                                    </label>
                                    <label class="c-4" for="sp-4">
                                        <input type="radio" name="productColor" id="sp-4" onclick="changeOverlayColor('#ed1c24')"> <!-- red -->
                                    </label>
                                    <label class="c-9" for="sp-9">
                                        <input type="radio" name="productColor" id="sp-9" onclick="changeOverlayColor('#ffffff')"> <!-- White -->
                                    </label>
                                </div>

                            </div>

                            <!-- price -->
                            @if($products->original_price)
                            <h3 class="product-price" data-usd-price="{{ $products->store_price }}">
                                <span class="original-price">
                                    ${{ $products->store_price }}
                                </span>
                                <span class="market-price">
                                    ${{ $products->original_price }}
                                </span>
                            </h3>
                            @else
                            <h3 class="product-price" data-usd-price="{{ $products->store_price }}">
                                ${{ $products->store_price }}
                            </h3>
                            @endif

                            <!-- add to cart -->
                            <form action="{{ url('add_cart', $products->id) }}" method="POST" id="cartForm">
                                @csrf
                                <input type="hidden" name="customImage" id="customImageInput">

                                <div class="product__details__cart__option">
                                    <div class="quantity">
                                        <div class="pro-qty">
                                            <input type="number" name="quantity" value="1" min="1" max="{{ $products->quantity }}">
                                        </div>
                                    </div>
                                    <button type="submit" class="primary-btn">Add to Cart</button>
                                </div>
                            </form>

                            <hr>

                            <!-- wishlist -->

                            <div class="product__details__btns__option">
                                <div class="product__details__btns__option">
                                    <button type="button"
                                        class="btn add-to-wishlist"
                                        data-product-id="{{ $products->id }}"
                                        style="border: none; background: none;">
                                        <i class="fa fa-heart"></i> Add to wishlist
                                    </button>
                                </div>

                                <!-- <a href="#"><i class="fa fa-exchange"></i> Add To Compare</a> -->
                            </div>



                            <div class="product__details__last__option">
                                <h5><span>Guaranteed Safe Checkout</span></h5>
                                <img src="{{asset('img/shop-details/details-payment.png')}}" alt="">
                                <ul>
                                    <li><span>SKU:</span> {{$products->product_code}}</li>
                                    <li><span>Categories:</span> {{$products->category}}</li>
                                    <li><span>Tag:</span> Clothes, Skin, Body</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- description -->
        <div class="product__details__content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="product__details__tab">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#tabs-5"
                                        role="tab">Description</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#tabs-6" role="tab">Customer
                                        Previews(5)</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#tabs-7" role="tab">Additional
                                        information</a>
                                </li>
                            </ul>
                            <!-- tab content -->
                            <div class="tab-content">
                                <div class="tab-pane active" id="tabs-5" role="tabpanel">
                                    <div class="product__details__tab__content">
                                        <p class="note">Nam tempus turpis at metus scelerisque placerat nulla deumantos
                                            solicitud felis. Pellentesque diam dolor, elementum etos lobortis des mollis
                                            ut risus. Sedcus faucibus an sullamcorper mattis drostique des commodo
                                            pharetras loremos.</p>
                                        <div class="product__details__tab__content__item">
                                            <h5>Products Infomation</h5>
                                            <p>A Pocket PC is a handheld computer, which features many of the same
                                                capabilities as a modern PC. These handy little devices allow
                                                individuals to retrieve and store e-mail messages, create a contact
                                                file, coordinate appointments, surf the internet, exchange text messages
                                                and more. Every product that is labeled as a Pocket PC must be
                                                accompanied with specific software to operate the unit and must feature
                                                a touchscreen and touchpad.</p>
                                            <p>As is the case with any new technology product, the cost of a Pocket PC
                                                was substantial during it’s early release. For approximately $700.00,
                                                consumers could purchase one of top-of-the-line Pocket PCs in 2003.
                                                These days, customers are finding that prices have become much more
                                                reasonable now that the newness is wearing off. For approximately
                                                $350.00, a new Pocket PC can now be purchased.</p>
                                        </div>
                                        <div class="product__details__tab__content__item">
                                            <h5>Material used</h5>
                                            <p>Polyester is deemed lower quality due to its none natural quality’s. Made
                                                from synthetic materials, not natural like wool. Polyester suits become
                                                creased easily and are known for not being breathable. Polyester suits
                                                tend to have a shine to them compared to wool and cotton suits, this can
                                                make the suit look cheap. The texture of velvet is luxurious and
                                                breathable. Velvet is a great choice for dinner party jacket and can be
                                                worn all year round.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="tabs-6" role="tabpanel">
                                    <div class="product__details__tab__content">
                                        <div class="product__details__tab__content__item">
                                            <h5>Products Infomation</h5>
                                            <p>A Pocket PC is a handheld computer, which features many of the same
                                                capabilities as a modern PC. These handy little devices allow
                                                individuals to retrieve and store e-mail messages, create a contact
                                                file, coordinate appointments, surf the internet, exchange text messages
                                                and more. Every product that is labeled as a Pocket PC must be
                                                accompanied with specific software to operate the unit and must feature
                                                a touchscreen and touchpad.</p>
                                            <p>As is the case with any new technology product, the cost of a Pocket PC
                                                was substantial during it’s early release. For approximately $700.00,
                                                consumers could purchase one of top-of-the-line Pocket PCs in 2003.
                                                These days, customers are finding that prices have become much more
                                                reasonable now that the newness is wearing off. For approximately
                                                $350.00, a new Pocket PC can now be purchased.</p>
                                        </div>
                                        <div class="product__details__tab__content__item">
                                            <h5>Material used</h5>
                                            <p>Polyester is deemed lower quality due to its none natural quality’s. Made
                                                from synthetic materials, not natural like wool. Polyester suits become
                                                creased easily and are known for not being breathable. Polyester suits
                                                tend to have a shine to them compared to wool and cotton suits, this can
                                                make the suit look cheap. The texture of velvet is luxurious and
                                                breathable. Velvet is a great choice for dinner party jacket and can be
                                                worn all year round.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="tabs-7" role="tabpanel">
                                    <div class="product__details__tab__content">
                                        <p class="note">Nam tempus turpis at metus scelerisque placerat nulla deumantos
                                            solicitud felis. Pellentesque diam dolor, elementum etos lobortis des mollis
                                            ut risus. Sedcus faucibus an sullamcorper mattis drostique des commodo
                                            pharetras loremos.</p>
                                        <div class="product__details__tab__content__item">
                                            <h5>Products Infomation</h5>
                                            <p>A Pocket PC is a handheld computer, which features many of the same
                                                capabilities as a modern PC. These handy little devices allow
                                                individuals to retrieve and store e-mail messages, create a contact
                                                file, coordinate appointments, surf the internet, exchange text messages
                                                and more. Every product that is labeled as a Pocket PC must be
                                                accompanied with specific software to operate the unit and must feature
                                                a touchscreen and touchpad.</p>
                                            <p>As is the case with any new technology product, the cost of a Pocket PC
                                                was substantial during it’s early release. For approximately $700.00,
                                                consumers could purchase one of top-of-the-line Pocket PCs in 2003.
                                                These days, customers are finding that prices have become much more
                                                reasonable now that the newness is wearing off. For approximately
                                                $350.00, a new Pocket PC can now be purchased.</p>
                                        </div>
                                        <div class="product__details__tab__content__item">
                                            <h5>Material used</h5>
                                            <p>Polyester is deemed lower quality due to its none natural quality’s. Made
                                                from synthetic materials, not natural like wool. Polyester suits become
                                                creased easily and are known for not being breathable. Polyester suits
                                                tend to have a shine to them compared to wool and cotton suits, this can
                                                make the suit look cheap. The texture of velvet is luxurious and
                                                breathable. Velvet is a great choice for dinner party jacket and can be
                                                worn all year round.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
    <!-- Shop Details Section End -->

    <!-- Related Section Begin -->
    <!-- <section class="related spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="related-title">Related Product</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6 col-sm-6">
                    <div class="product__item">
                        <div class="product__item__pic set-bg" data-setbg="img/product/product-1.jpg">
                        <span class="label">New</span>
                        <ul class="product__hover">
                            <li><a href="#"><img src="{{asset('img/icon/heart.png')}}" alt=""></a></li>
                            <li><a href="#"><img src="{{asset('img/icon/compare.png')}}" alt=""> <span>Compare</span></a></li>
                            <li><a href="#"><img src="{{asset('img/icon/search.png')}}" alt=""></a></li>
                        </ul>
                    </div>
                    <div class="product__item__text">
                        <h6>Piqué Biker Jacket</h6>
                        <a href="#" class="add-cart">+ Add To Cart</a>
                        <div class="rating">
                            <i class="fa fa-star-o"></i>
                            <i class="fa fa-star-o"></i>
                            <i class="fa fa-star-o"></i>
                            <i class="fa fa-star-o"></i>
                            <i class="fa fa-star-o"></i>
                        </div>
                        <h5>$67.24</h5>
                        <div class="product__color__select">
                            <label for="pc-1">
                                <input type="radio" id="pc-1">
                            </label>
                            <label class="active black" for="pc-2">
                                <input type="radio" id="pc-2">
                            </label>
                            <label class="grey" for="pc-3">
                                <input type="radio" id="pc-3">
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-sm-6">
                <div class="product__item">
                    <div class="product__item__pic set-bg" data-setbg="img/product/product-2.jpg">
                    <ul class="product__hover">
                        <li><a href="#"><img src="{{asset('img/icon/heart.png')}}" alt=""></a></li>
                        <li><a href="#"><img src="{{asset('img/icon/compare.png')}}" alt=""> <span>Compare</span></a></li>
                        <li><a href="#"><img src="{{asset('img/icon/search.png')}}" alt=""></a></li>
                    </ul>
                </div>
                <div class="product__item__text">
                    <h6>Piqué Biker Jacket</h6>
                    <a href="#" class="add-cart">+ Add To Cart</a>
                    <div class="rating">
                        <i class="fa fa-star-o"></i>
                        <i class="fa fa-star-o"></i>
                        <i class="fa fa-star-o"></i>
                        <i class="fa fa-star-o"></i>
                        <i class="fa fa-star-o"></i>
                    </div>
                    <h5>$67.24</h5>
                    <div class="product__color__select">
                        <label for="pc-4">
                            <input type="radio" id="pc-4">
                        </label>
                        <label class="active black" for="pc-5">
                            <input type="radio" id="pc-5">
                        </label>
                        <label class="grey" for="pc-6">
                            <input type="radio" id="pc-6">
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-sm-6">
            <div class="product__item sale">
                <div class="product__item__pic set-bg" data-setbg="img/product/product-3.jpg">
                <span class="label">Sale</span>
                <ul class="product__hover">
                    <li><a href="#"><img src="{{asset('img/icon/heart.png')}}" alt=""></a></li>
                    <li><a href="#"><img src="{{asset('img/icon/compare.png')}}" alt=""> <span>Compare</span></a></li>
                    <li><a href="#"><img src="{{asset('img/icon/search.png')}}" alt=""></a></li>
                </ul>
            </div>
            <div class="product__item__text">
                <h6>Multi-pocket Chest Bag</h6>
                <a href="#" class="add-cart">+ Add To Cart</a>
                <div class="rating">
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star-o"></i>
                </div>
                <h5>$43.48</h5>
                <div class="product__color__select">
                    <label for="pc-7">
                        <input type="radio" id="pc-7">
                    </label>
                    <label class="active black" for="pc-8">
                        <input type="radio" id="pc-8">
                    </label>
                    <label class="grey" for="pc-9">
                        <input type="radio" id="pc-9">
                    </label>
                </div>
            </div>
        </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-sm-6">
            <div class="product__item">
                <div class="product__item__pic set-bg" data-setbg="img/product/product-4.jpg">
                <ul class="product__hover">
                    <li><a href="#"><img src="{{asset('img/icon/heart.png')}}" alt=""></a></li>
                    <li><a href="#"><img src="{{asset('img/icon/compare.png')}}" alt=""> <span>Compare</span></a></li>
                    <li><a href="#"><img src="{{asset('img/icon/search.png')}}" alt=""></a></li>
                </ul>
            </div>
            <div class="product__item__text">
                <h6>Diagonal Textured Cap</h6>
                <a href="#" class="add-cart">+ Add To Cart</a>
                <div class="rating">
                    <i class="fa fa-star-o"></i>
                    <i class="fa fa-star-o"></i>
                    <i class="fa fa-star-o"></i>
                    <i class="fa fa-star-o"></i>
                    <i class="fa fa-star-o"></i>
                </div>
                <h5>$60.9</h5>
                <div class="product__color__select">
                    <label for="pc-10">
                        <input type="radio" id="pc-10">
                    </label>
                    <label class="active black" for="pc-11">
                        <input type="radio" id="pc-11">
                    </label>
                    <label class="grey" for="pc-12">
                        <input type="radio" id="pc-12">
                    </label>
                </div>
            </div>
        </div>
        </div>
        </div>
        </div>
    </section> -->
    <!-- Related Section End -->

</body>

@include ('Home.home_footer')

<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.querySelectorAll(".add-to-wishlist").forEach(btn => {
            btn.addEventListener("click", function() {
                let productId = this.dataset.productId;

                fetch("{{ url('add_to_wishlist') }}", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": "{{ csrf_token() }}"
                        },
                        body: JSON.stringify({
                            product_id: productId
                        })
                    })
                    .then(res => res.json())
                    .then(data => {
                        alert(data.message);

                        if (data.wishlistCount !== undefined && document.getElementById("wishlistCount")) {
                            document.getElementById("wishlistCount").innerText = data.wishlistCount;
                        }
                    })
                    .catch(err => console.error(err));
            });
        });
    });
</script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/fabric.js/5.3.0/fabric.min.js"></script>
<script src="{{ asset('js/customizing_product.js') }}"></script>

</html>