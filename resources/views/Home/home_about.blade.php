<!DOCTYPE html>
<html lang="en">

<head>
    @include ('Home.home_headSection')
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    @include ('Home.home_header')

    <!-- About Section Begin -->
    <section class="about spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="about__pic">
                        <img src="{{asset('img/about/about-us.jpg')}}" alt="">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="about__item">
                        <h4>Who We Are ?</h4>
                        <p>We are a passionate team of designers, creators, and innovators committed to making customized products accessible to everyone, everywhere. Our love for creativity and personal expression drives everything we do. As a global e-commerce platform, we aim to bridge cultures, styles, and ideas—delivering unique products that reflect your individuality to your doorstep, no matter where you live.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="about__item">
                        <h4>Who We Do ?</h4>
                        <p>We specialize in helping you create one-of-a-kind items tailored exactly to your tastes and needs. From custom t-shirts and personalized toys to unique sports jerseys and household essentials, every product in our collection can be designed by you, for you. Our easy-to-use online customization tools let you add names, designs, colors, and special messages to almost anything. We then carefully craft your order with quality materials and attention to detail, making sure you receive something truly special.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="about__item">
                        <h4>Why Choose Us</h4>
                        <p>
                        <ul>
                            <li>Endless Customization: Whether for yourself or as a heartfelt gift, you can personalize every product just the way you want..</li>

                            <li>Worldwide Shipping: No matter where you are, we deliver your creations quickly and securely to your doorstep.</li>
                            <li> Premium Quality: We use top-grade materials, ensuring all items are durable, comfortable, and made to last.
                            </li>
                            <li> Exceptional Service: Our friendly support team is always here to guide you—from design ideas to aftersales help.</li>

                            <li>Innovation & Inspiration: We constantly add new products and design options, keeping our selection fresh and exciting for our global community.</li>

                        </ul>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- About Section End -->

    <!-- Testimonial Section Begin -->
    <!-- <section class="testimonial">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6 p-0">
                    <div class="testimonial__text">
                        <span class="icon_quotations"></span>
                        <p>“Going out after work? Take your butane curling iron with you to the office, heat it up,
                            style your hair before you leave the office and you won’t have to make a trip back home.”
                        </p>
                        <div class="testimonial__author">
                            <div class="testimonial__author__pic">
                                <img src="{{asset('img/about/testimonial-author.jpg')}}" alt="">
                            </div>
                            <div class="testimonial__author__text">
                                <h5>Augusta Schultz</h5>
                                <p>Fashion Design</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 p-0">
                    <div class="testimonial__pic set-bg" data-setbg="{{asset('img/about/testimonial-pic.jpg')}}"></div>
                </div>
            </div>
        </div>
    </section> -->
    <!-- Testimonial Section End -->

    <!-- Counter Section Begin -->
    <!-- <section class="counter spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="counter__item">
                        <div class="counter__item__number">
                            <h2 class="cn_num">102</h2>
                        </div>
                        <span>Our <br />Clients</span>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="counter__item">
                        <div class="counter__item__number">
                            <h2 class="cn_num">30</h2>
                        </div>
                        <span>Total <br />Categories</span>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="counter__item">
                        <div class="counter__item__number">
                            <h2 class="cn_num">102</h2>
                        </div>
                        <span>In <br />Country</span>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="counter__item">
                        <div class="counter__item__number">
                            <h2 class="cn_num">98</h2>
                            <strong>%</strong>
                        </div>
                        <span>Happy <br />Customer</span>
                    </div>
                </div>
            </div>
        </div>
    </section> -->
    <!-- Counter Section End -->

    <!-- Team Section Begin -->
    <!-- <section class="team spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <span>Our Team</span>
                        <h2>Meet Our Team</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="team__item">
                        <img src="{{asset('img/about/team-1.jpg')}}" alt="">
                        <h4>John Smith</h4>
                        <span>Fashion Design</span>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="team__item">
                        <img src="{{asset('img/about/team-2.jpg')}}" alt="">
                        <h4>Christine Wise</h4>
                        <span>C.E.O</span>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="team__item">
                        <img src="{{asset('img/about/team-3.jpg')}}" alt="">
                        <h4>Sean Robbins</h4>
                        <span>Manager</span>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="team__item">
                        <img src="{{asset('img/about/team-4.jpg')}}" alt="">
                        <h4>Lucy Myers</h4>
                        <span>Delivery</span>
                    </div>
                </div>
            </div>
        </div>
    </section> -->
    <!-- Team Section End -->

    <!-- Client Section Begin -->
    <!-- <section class="clients spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <span>Partner</span>
                        <h2>Happy Clients</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-4 col-sm-4 col-6">
                    <a href="#" class="client__item"><img src="{{asset('img/clients/client-1.png')}}" alt=""></a>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-4 col-6">
                    <a href="#" class="client__item"><img src="{{asset('img/clients/client-2.png')}}" alt=""></a>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-4 col-6">
                    <a href="#" class="client__item"><img src="{{asset('img/clients/client-3.png')}}" alt=""></a>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-4 col-6">
                    <a href="#" class="client__item"><img src="{{asset('img/clients/client-4.png')}}" alt=""></a>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-4 col-6">
                    <a href="#" class="client__item"><img src="{{asset('img/clients/client-5.png')}}" alt=""></a>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-4 col-6">
                    <a href="#" class="client__item"><img src="{{asset('img/clients/client-6.png')}}" alt=""></a>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-4 col-6">
                    <a href="#" class="client__item"><img src="{{asset('img/clients/client-7.png')}}" alt=""></a>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-4 col-6">
                    <a href="#" class="client__item"><img src="{{asset('img/clients/client-8.png')}}" alt=""></a>
                </div>
            </div>
        </div>
    </section> -->
    <!-- Client Section End -->



    @include ('Home.home_footer')


</body>

</html>