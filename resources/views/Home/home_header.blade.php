<!-- Offcanvas Menu Begin -->
<div class="offcanvas-menu-overlay"></div>
<div class="offcanvas-menu-wrapper">
    <div class="offcanvas__option">
        <div class="offcanvas__links">
            <a href="{{url('/login')}}">Sign in</a>
            <a href="{{url('faq')}}">FAQs</a>
        </div>
        <div class="offcanvas__top__hover">
            <span>USD <i class="arrow_carrot-down"></i></span>
            <ul>
                <li data-currency="USD">USD</li>
                <li data-currency="EUR">EUR</li>
                <li data-currency="GBP">GBP</li>
                <li data-currency="INR">INR</li>
            </ul>
        </div>
    </div>

    <div class="offcanvas__nav__option d-flex align-items-center gap-3 position-relative">

        <!-- Search Icon (always visible) -->
        <a href="#" class="search-switch" data-bs-toggle="modal" data-bs-target="#searchModal" title="Search">
            <i class="bi bi-search" style="font-size: 20px; color: #000;"></i>
        </a>

        <!-- Cart (always visible) -->
        <a href="{{ url('view_cart') }}" title="Cart">
            <i class="bi bi-cart" style="font-size: 20px; color: #000;"></i>

            @if($count > 0)
            <span class="cart-badge">{{ $count }}</span>
            <div class="price">${{ $cart_total ?? 0 }}</div>
            @endif

        </a>

        @auth

        <!-- Wishlist (only when logged in) -->
        <a href="{{ url('view_wishlist') }}" title="Wishlist">
            <i class="bi bi-heart" style="font-size: 20px; color: #000;"></i>

        </a>

        <!-- Notifications (only when logged in) -->
        <div class="dropdown">
            <a class="btn position-relative" href="#" role="button" id="userNotificationDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="bi bi-bell" style="font-size: 20px; color: #000;"></i>
                @if($unreadCount > 0)
                <span class="badge bg-danger position-absolute top-0 start-100 translate-middle rounded-pill">
                    {{ $unreadCount }}
                </span>
                @endif
            </a>

            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userNotificationDropdown" style="width: 500px;">
                @forelse($unreadNotifications as $notification)
                <li>
                    <a class="dropdown-item d-flex align-items-start" href="{{ route('mark_all_read', $notification->id) }}">
                        <div class="flex-grow-1">
                            <strong class="text-success">{{ $notification->data['title'] ?? 'Notification' }}</strong>
                            <p class="mb-0">{{ $notification->data['message'] ?? '' }}</p>
                            <small class="text-muted">{{ $notification->created_at->diffForHumans() }}</small>
                        </div>
                    </a>
                </li>
                @empty
                <li class="dropdown-item text-center">
                    No new notifications
                </li>
                @endforelse
            </ul>
        </div>

        <!-- User Icon & Dropdown (only when logged in) -->
        <div class="dropdown d-inline" style="gap: 5px;">
            <a class="dropdown-toggle text-dark" href="#" role="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="bi bi-person-circle" style="font-size: 20px; padding:5px"></i>
            </a>

            <ul class="dropdown-menu dropdown-menu-end shadow-lg border-0 rounded-3 p-2" aria-labelledby="userDropdown" style="min-width: 250px;">
                <li>
                    <a class="dropdown-item d-flex align-items-center py-2" style="gap: 10px;" href="{{ url('user-profile') }}">
                        <i class="bi bi-person-circle text-primary fs-5"></i> Profile
                    </a>
                </li>
                <li>
                    <a class="dropdown-item d-flex align-items-center py-2" style="gap: 10px;" href="#">
                        <i class="bi bi-gear fs-5 text-secondary"></i> Account Preferences
                    </a>
                </li>
                <li>
                    <a class="dropdown-item d-flex align-items-center py-2" style="gap: 10px;" href="{{ url('view_wishlist') }}">
                        <i class="bi bi-heart fs-5 text-danger"></i> Wishlist
                    </a>
                </li>
                <li>
                    <a class="dropdown-item d-flex align-items-center py-2" style="gap: 10px;" href="{{ url('gift') }}">
                        <i class="bi bi-gift fs-5 text-danger"></i> Gifts and Coupons
                    </a>
                </li>
                <li>
                    <a class="dropdown-item d-flex align-items-center py-2" style="gap: 10px;" href="{{ url('payment-methods') }}">
                        <i class="bi bi-credit-card text-warning fs-5"></i> Payment Methods
                    </a>
                </li>
                <li>
                    <a class="dropdown-item d-flex align-items-center py-2" style="gap: 10px;" href="{{ url('privacy-policy') }}">
                        <i class="bi bi-shield-lock text-success fs-5"></i> Privacy & Security
                    </a>
                </li>
                <li>
                    <a class="dropdown-item d-flex align-items-center py-2" style="gap: 10px;" href="{{ url('notifications') }}">
                        <i class="bi bi-bell text-info fs-5"></i> Notifications
                    </a>
                </li>
                <li>
                    <hr class="dropdown-divider">
                </li>
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="dropdown-item d-flex align-items-center py-2 text-danger fw-semibold" style="gap: 10px;">
                            <i class="bi bi-box-arrow-right fs-5"></i> Log Out
                        </button>
                    </form>
                </li>
            </ul>
        </div>
        @else
        <!-- When not logged in: only show login icon -->
        <a href="{{ route('login') }}" class="d-inline">
            <i class="bi bi-person-circle" style="font-size: 20px; color:#000; padding:5px"></i>
        </a>
        @endauth

    </div>

    <div id="mobile-menu-wrap"></div>
    <div class="offcanvas__text">
        <p>Get a Customized products.</p>
    </div>
</div>
<!-- Offcanvas Menu End -->

<!-- Header Section Begin -->
<header class="header">
    <div class="header__top">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-7">
                    <div class="header__top__left">
                        <p>Get a Customized products.</p>
                    </div>
                </div>
                <div class="col-lg-6 col-md-5">
                    <div class="header__top__right">
                        <div class="header__top__links">
                            <a href="{{url('/login')}}">Sign in</a>
                            <a href="{{url('faq')}}">FAQs</a>
                        </div>
                        <div class="header__top__hover" id="currency-selector">
                            <span id="current-currency">USD <i class="arrow_carrot-down"></i></span>
                            <ul>
                                <li data-currency="USD">USD</li>
                                <li data-currency="EUR">EUR</li>
                                <li data-currency="GBP">GBP</li>
                                <li data-currency="INR">INR</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-3">
                <div class="header__logo">
                    <a href="{{url('/')}}"><img src="{{asset('img/logo.jpg')}}" alt=""></a>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <nav class="header__menu mobile-menu">
                    <ul>
                        <li class="{{ Request::is('/') ? 'active' : '' }}">
                            <a href="{{ url('/') }}">Home</a>
                        </li>
                        <li class="{{ Request::is('shop*') ? 'active' : '' }}">
                            <a href="{{ url('shop') }}">Shop</a>
                        </li>
                        <li class="{{ Request::is('about') ? 'active' : '' }}">
                            <a href="{{ url('about') }}">About Us</a>
                        </li>
                        <li class="{{ Request::is('blog*') ? 'active' : '' }}">
                            <a href="{{ url('blog') }}">Blog</a>
                        </li>
                        <li class="{{ Request::is('contact') ? 'active' : '' }}">
                            <a href="{{ url('contact') }}">Contacts</a>
                        </li>
                    </ul>

                </nav>
            </div>

            <!-- icons -->
            <div class="col-lg-3 col-md-3">
                <div class="header__nav__option">

                    <!-- Search Icon (always visible) -->
                    <a href="#" class="search-switch" data-bs-toggle="modal" data-bs-target="#searchModal" title="Search">
                        <i class="bi bi-search" style="font-size: 20px; color: #000;"></i>
                    </a>

                    <!-- Cart (always visible) -->
                    <a href="{{ url('view_cart') }}" title="Cart">
                        <i class="bi bi-cart" style="font-size: 20px; color: #000;"></i>

                        @if($count > 0)
                        <span class="cart-badge">{{ $count }}</span>
                        <div class="price">${{ $cart_total ?? 0 }}</div>
                        @endif

                    </a>

                    @auth

                    <!-- Wishlist (only when logged in) -->
                    <a href="{{ url('view_wishlist') }}" title="Wishlist">
                        <i class="bi bi-heart" style="font-size: 20px; color: #000;"></i>

                    </a>

                    <!-- Notifications (only when logged in) -->
                    <div class="dropdown">
                        <a class="btn position-relative" href="#" role="button" id="userNotificationDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-bell" style="font-size: 20px; color: #000;"></i>
                            @if($unreadCount > 0)
                            <span class="badge bg-danger position-absolute top-0 start-100 translate-middle rounded-pill">
                                {{ $unreadCount }}
                            </span>
                            @endif
                        </a>

                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userNotificationDropdown" style="width: 500px;">
                            @forelse($unreadNotifications as $notification)
                            <li>
                                <a class="dropdown-item d-flex align-items-start" href="{{ route('mark_all_read', $notification->id) }}">
                                    <div class="flex-grow-1">
                                        <strong class="text-success">{{ $notification->data['title'] ?? 'Notification' }}</strong>
                                        <p class="mb-0">{{ $notification->data['message'] ?? '' }}</p>
                                        <small class="text-muted">{{ $notification->created_at->diffForHumans() }}</small>
                                    </div>
                                </a>
                            </li>
                            @empty
                            <li class="dropdown-item text-center">
                                No new notifications
                            </li>
                            @endforelse
                        </ul>
                    </div>

                    <!-- User Icon & Dropdown (only when logged in) -->
                    <div class="dropdown d-inline" style="gap: 5px;">
                        <a class="dropdown-toggle text-dark" href="#" role="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person-circle" style="font-size: 20px; padding:5px"></i>
                        </a>

                        <ul class="dropdown-menu dropdown-menu-end shadow-lg border-0 rounded-3 p-2" aria-labelledby="userDropdown" style="min-width: 250px;">
                            <li>
                                <a class="dropdown-item d-flex align-items-center py-2" style="gap: 10px;" href="{{ url('user-profile') }}">
                                    <i class="bi bi-person-circle text-primary fs-5"></i> Profile
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item d-flex align-items-center py-2" style="gap: 10px;" href="#">
                                    <i class="bi bi-gear fs-5 text-secondary"></i> Account Preferences
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item d-flex align-items-center py-2" style="gap: 10px;" href="{{ url('view_wishlist') }}">
                                    <i class="bi bi-heart fs-5 text-danger"></i> Wishlist
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item d-flex align-items-center py-2" style="gap: 10px;" href="{{ url('gift') }}">
                                    <i class="bi bi-gift fs-5 text-danger"></i> Gifts and Coupons
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item d-flex align-items-center py-2" style="gap: 10px;" href="{{ url('payment-methods') }}">
                                    <i class="bi bi-credit-card text-warning fs-5"></i> Payment Methods
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item d-flex align-items-center py-2" style="gap: 10px;" href="{{ url('privacy-policy') }}">
                                    <i class="bi bi-shield-lock text-success fs-5"></i> Privacy & Security
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item d-flex align-items-center py-2" style="gap: 10px;" href="{{ url('notifications') }}">
                                    <i class="bi bi-bell text-info fs-5"></i> Notifications
                                </a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item d-flex align-items-center py-2 text-danger fw-semibold" style="gap: 10px;">
                                        <i class="bi bi-box-arrow-right fs-5"></i> Log Out
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                    @else
                    <!-- When not logged in: only show login icon -->
                    <a href="{{ route('login') }}" class="d-inline">
                        <i class="bi bi-person-circle" style="font-size: 20px; color:#000; padding:5px"></i>
                    </a>
                    @endauth
                </div>
            </div>
        </div>
        <div class="canvas__open"><i class="fa fa-bars"></i></div>
    </div>
</header>

<script>
    // Exchange rates relative to 1 USD
    const exchangeRates = {
        USD: 1,
        EUR: 0.92,
        GBP: 0.78,
        INR: 83.27
    };

    const currencySymbols = {
        USD: '$',
        EUR: '€',
        GBP: '£',
        INR: '₹'
    };

    // Header currency selector
    document.querySelectorAll('#currency-selector ul li').forEach(item => {
        item.addEventListener('click', function() {
            const selectedCurrency = this.getAttribute('data-currency');
            document.getElementById('current-currency').innerHTML = `${selectedCurrency} <i class="arrow_carrot-down"></i>`;

            document.querySelectorAll('.product-price').forEach(priceEl => {
                const usdPriceStr = priceEl.getAttribute('data-usd-price');
                const usdPrice = parseFloat(usdPriceStr);

                if (!isNaN(usdPrice)) {
                    const converted = selectedCurrency === 'USD' ?
                        usdPrice :
                        usdPrice * exchangeRates[selectedCurrency];
                    const symbol = currencySymbols[selectedCurrency];
                    priceEl.textContent = `${symbol}${converted.toFixed(2)}`;
                } else {
                    console.warn('Invalid USD price found on element:', priceEl);
                    priceEl.textContent = 'N/A';
                }
            });

        });
    });

    // Offcanvas currency selector
    document.querySelectorAll('.offcanvas__top__hover ul li').forEach(item => {
        item.addEventListener('click', function() {
            const selectedCurrency = this.getAttribute('data-currency');
            // Update the offcanvas display
            this.closest('.offcanvas__top__hover').querySelector('span').innerHTML = `${selectedCurrency} <i class="arrow_carrot-down"></i>`;

            // Also update the header display for consistency
            const headerCurrency = document.getElementById('current-currency');
            if (headerCurrency) {
                headerCurrency.innerHTML = `${selectedCurrency} <i class="arrow_carrot-down"></i>`;
            }

            document.querySelectorAll('.product-price').forEach(priceEl => {
                const usdPriceStr = priceEl.getAttribute('data-usd-price');
                const usdPrice = parseFloat(usdPriceStr);

                if (!isNaN(usdPrice)) {
                    const converted = selectedCurrency === 'USD' ?
                        usdPrice :
                        usdPrice * exchangeRates[selectedCurrency];
                    const symbol = currencySymbols[selectedCurrency];
                    priceEl.textContent = `${symbol}${converted.toFixed(2)}`;
                } else {
                    console.warn('Invalid USD price found on element:', priceEl);
                    priceEl.textContent = 'N/A';
                }
            });

        });
    });
</script>
<!-- Header Section End -->