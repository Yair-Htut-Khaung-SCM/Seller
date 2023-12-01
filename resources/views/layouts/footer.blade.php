<section class="text-light p-3" style="background-image: linear-gradient(#12ca8a, #115A40);">
  <div class="container row">
    <div class="col-md-3 col-lg-3 col-xl-3 mx-auto">
      <h5 class="text-uppercase mb-4" style="font-weight:900;">Car Seller</h5>
      <p style="font-weight:100;  font-size: 0.9rem;">This website is for the people who wants to buy and sell cars. car dealers, car showrooms, car importers and people who are
        doing business on car buy and sell to search or sell different types of cars in one place.</p>
    </div>
    <div class="col-md-3 col-lg-3 col-xl-3 mx-auto">
      <h5 class="text-uppercase mb-4" style="font-weight:600;">Categories</h5>
      <p><a href="{{ route('buy.create') }}" class="text-light custom-nav-link" style="text-decoration:none; font-size: 0.9rem;">{{ __('buy_cars') }}</a></p>
      <p><a href="{{ route('sale.create') }}" class="text-light custom-nav-link" style="text-decoration:none; font-size: 0.9rem;">{{ __('sell_cars') }}</a></p>
      <p style="font-size: 0.9rem;">{{ __('help') }}</p>
    </div>
    <div class="col-md-3 col-lg-3 col-xl-3 mx-auto">
      <h5 class="text-uppercase mb-4" style="font-weight:600;">{{ __('contact') }}</h5>
      <p style="font-size: 0.9rem;">
        <i class="fas fa-map-marker-alt me-2"></i>
        {{ __('company_address') }}
      </p>
      <p>
        <a href="mailto:info@gmail.com" style="text-decoration:none; font-size: 0.9rem;" class="mr-3 text-light custom-nav-link">
          <i class="fas fa-envelope me-2"></i>
          info@gmail.com
        </a>
      </p>
      <p>
        <a href="tel:09123456789" style="text-decoration:none; font-size: 0.9rem;" class=" mr-3 text-light custom-nav-link">
          <i class="fas fa-phone me-2"></i>09-12
          3-456-789
        </a>
      </p>
    </div>
    <!-- Grid column -->
  </div>
  <hr>
  <div class="d-flex justify-content-center align-items-center">
    <!-- Grid column -->
    <div class="col- text-center text-md-start">
      <!-- Copyright -->
      <div class="text-center">
        © 2020 Copyright:
        <a href="#" class="text-light text-decoration-none" style="color:#12ca8a !important;">CarSeller.com</a>
      </div>
      <!-- Copyright -->
    </div>
    <!-- Grid column -->
  </div>
</div>
</section>