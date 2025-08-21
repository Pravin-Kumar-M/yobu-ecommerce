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

    <!-- Map Begin -->
    <div class="map">
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2392.881370624239!2d-9.0046555!3d53.2729435!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x485b96c299d510d7%3A0x1234567890abcdef!2s129%20Ti%20Niel%2C%20Gleann%20Na%20Ri%2C%20Murrough%2C%20Galway%2C%20Ireland%2C%20H91P582!5e0!3m2!1sen!2sie!4v1692094512345!5m2!1sen!2sie"
            width="100%"
            height="500"
            style="border:0;"
            allowfullscreen=""
            loading="lazy"
            referrerpolicy="no-referrer-when-downgrade">
        </iframe>
    </div>

    <!-- Map End -->

    <!-- Contact Section Begin -->
    <section class="contact spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="contact__text">
                        <div class="section-title">
                            <span>Information</span>
                            <h2>Contact Us</h2>
                            <p>As you might expect of a company that began as a high-end interiors contractor, we pay
                                strict attention.</p>
                        </div>
                        <ul>
                            <li>
                                <h4>Ireland</h4>
                                <p>129, Ti Niel, Gleann Na Ri, Murrough, Galway,Ireland, H91P582 </p>
                            </li>
                            <li>
                                <h4>India </h4>
                                <p>12/266 F,WATERTANK STREET
                                    PULAVANPATTI,SIVANTHIPURAM,AMBASAMUDRAM, Tirunelveli, Tamilnadu, India 627425</p>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="contact__form">
                        <form action="#">
                            <div class="row">
                                <div class="col-lg-6">
                                    <input type="text" placeholder="Name">
                                </div>
                                <div class="col-lg-6">
                                    <input type="text" placeholder="Email">
                                </div>
                                <div class="col-lg-12">
                                    <textarea placeholder="Message"></textarea>
                                    <button type="submit" class="site-btn">Send Message</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Contact Section End -->

    @include ('Home.home_footer')


</body>

</html>