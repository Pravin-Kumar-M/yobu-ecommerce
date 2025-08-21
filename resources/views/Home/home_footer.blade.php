 <!-- Footer Section Begin -->
 <footer class="footer">
     <div class="container">
         <div class="row">
             <div class="col-lg-3 col-md-6 col-sm-6">
                 <div class="footer__about">
                     <div class="footer__logo">
                         <a href="{{url('/')}}"><img src="{{asset('img/footer-logos.png')}}" alt=""></a>
                     </div>
                     <p>The customer is at the heart of our unique business model, which includes design.</p>
                     <a href="{{url('payment-methods')}}"><img src="{{asset('img/payment.png')}}" alt=""></a>
                 </div>
             </div>
             <!-- <div class="col-lg-2 offset-lg-1 col-md-3 col-sm-6">
                 <div class="footer__widget">
                     <h6>Shopping</h6>
                     <ul>
                         <li><a href="{{url('shop')}}">Clothing Store</a></li>
                         <li><a href="#">Trending Shoes</a></li>
                         <li><a href="#">Accessories</a></li>
                         <li><a href="#">Sale</a></li>
                     </ul>
                 </div>
             </div> -->
             <div class="col-lg-3 offset-lg-1 col-md-6 col-sm-6">
                 <div class="footer__widget">
                     <h6>Shopping</h6>
                     <ul>
                         <li><a href="{{url('contact')}}">Contact Us</a></li>
                         <li><a href="{{url('payment-methods')}}">Payment Methods</a></li>
                         <li><a href="{{url('shop')}}">Clothing Store</a></li>

                         <!-- <li><a href="#">Delivery</a></li>
                         <li><a href="#">Return & Exchanges</a></li> -->
                     </ul>
                 </div>
             </div>
             <div class="col-lg-3 offset-lg-1 col-md-6 col-sm-6">
                 <div class="footer__widget">
                     <h6>NewLetter</h6>
                     <div class="footer__newslatter">
                         <p>Be the first to know about new arrivals, look books, sales & promos!</p>
                         <form action="#">
                             <input type="text" placeholder="Your email">
                             <button type="submit"><span class="icon_mail_alt"></span></button>
                         </form>
                     </div>
                 </div>
             </div>
         </div>
         <div class="row">
             <div class="col-lg-12 text-center">
                 <div class="footer__copyright__text">
                     <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                     <p>Copyright ©
                         <script>
                             document.write(new Date().getFullYear());
                         </script>
                         All rights reserved | By <a href="#">Yobu E-commerce</a>
                     </p>
                     <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                 </div>
             </div>
         </div>
     </div>
 </footer>
 <!-- Footer Section End -->

 <!-- Search Begin -->
 <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="searchModalLabel" aria-hidden="true">
     <div class="modal-dialog">
         <div class="modal-content border-0 shadow rounded-3">
             <div class="modal-body">
                 <form class="d-flex" style="gap: 10px;">
                     <input type="text" class="form-control me-2" placeholder="Search here..." aria-label="Search">
                     <button class="btn btn-dark" type="submit">
                         <i class="bi bi-search"></i>
                     </button>
                 </form>
             </div>
         </div>
     </div>
 </div>
 <!-- Search End -->

 <!-- Js Plugins -->
 <script src="{{asset('js/jquery-3.3.1.min.js')}}"></script>
 <script src="{{asset('js/bootstrap.min.js')}}"></script>
 <script src="{{asset('js/jquery.nice-select.min.js')}}"></script>
 <script src="{{asset('js/jquery.nicescroll.min.js')}}"></script>
 <script src="{{asset('js/jquery.magnific-popup.min.js')}}"></script>
 <script src="{{asset('js/jquery.countdown.min.js')}}"></script>
 <script src="{{asset('js/jquery.slicknav.js')}}"></script>
 <script src="{{asset('js/mixitup.min.js')}}"></script>
 <script src="{{asset('js/owl.carousel.min.js')}}"></script>
 <script src="{{ asset('js/main.js') }}?v=1.0"></script>