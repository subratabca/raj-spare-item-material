<!DOCTYPE html>

<html
  lang="en"
  class="light-style layout-navbar-fixed layout-wide"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="{{ asset('frontend/assets/') }}"
  data-template="front-pages">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Landing Page - Front Pages | Materialize - Material Design HTML Admin Template</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('frontend/assets/img/favicon/favicon.ico') }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&ampdisplay=swap"
      rel="stylesheet" />

    <link rel="stylesheet" href="{{ asset('frontend/assets/vendor/fonts/materialdesignicons.css') }}" />

    <!-- Menu waves for no-customizer fix -->
    <link rel="stylesheet" href="{{ asset('frontend/assets/vendor/libs/node-waves/node-waves.css') }}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('frontend/assets/vendor/css/rtl/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('frontend/assets/vendor/css/rtl/theme-default.css') }}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/demo.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/assets/vendor/css/pages/front-page.css') }}" />
    <!-- Vendors CSS -->

    <link rel="stylesheet" href="{{ asset('frontend/assets/vendor/libs/nouislider/nouislider.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/assets/vendor/libs/swiper/swiper.css') }}" />

    <!-- Page CSS -->

    <link rel="stylesheet" href="{{ asset('frontend/assets/vendor/css/pages/front-page-landing.css') }}" />

    <!-- Helpers -->
    <script src="{{ asset('frontend/assets/vendor/js/helpers.js') }}"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Template customizer: To hide customizer set displayCustomizer value false in config.js.  -->
    <!-- <script src="{{ asset('frontend/assets/vendor/js/template-customizer.js') }}"></script> -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <!-- <script src="{{ asset('frontend/assets/js/front-config.js') }}"></script> -->
  </head>

  <body>
    <script src="{{ asset('frontend/assets/vendor/js/dropdown-hover.js') }}"></script>
    <script src="{{ asset('frontend/assets/vendor/js/mega-dropdown.js') }}"></script>

    <!-- Navbar: Start -->
         @include('frontend.layout.header')
    <!-- Navbar: End -->

    <!-- Sections:Start -->
    <div data-bs-spy="scroll" class="scrollspy-example">
      <!-- Hero: Start -->
         @include('frontend.layout.hero')
      <!-- Hero: End -->
         @include('frontend.layout.food')
      <!-- Useful features: Start -->
         @include('frontend.layout.features')
      <!-- Useful features: End -->

      <!-- Real customers reviews: Start -->
         @include('frontend.layout.customers-reviews')
      <!-- Real customers reviews: End -->

      <!-- Our great team: Start -->
         @include('frontend.layout.great-team')
      <!-- Our great team: End -->

      <!-- Pricing plans: Start -->
         @include('frontend.layout.pricing')
      <!-- Pricing plans: End -->

      <!-- Fun facts: Start -->
         @include('frontend.layout.fun-facts')
      <!-- Fun facts: End -->

      <!-- FAQ: Start -->
         @include('frontend.layout.faq')
      <!-- FAQ: End -->

      <!-- CTA: Start -->
         @include('frontend.layout.cta')
      <!-- CTA: End -->

      <!-- Contact Us: Start -->
         @include('frontend.layout.contact-us')
      <!-- Contact Us: End -->
    </div>
    <!-- / Sections:End -->

    <!-- Footer: Start -->
         @include('frontend.layout.footer')
    <!-- Footer: End -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="{{ asset('frontend/assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('frontend/assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('frontend/assets/vendor/libs/node-waves/node-waves.js') }}"></script>

    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="{{ asset('frontend/assets/vendor/libs/nouislider/nouislider.js') }}"></script>
    <script src="{{ asset('frontend/assets/vendor/libs/swiper/swiper.js') }}"></script>

    <!-- Main JS -->
    <script src="{{ asset('frontend/assets/js/front-main.js') }}"></script>

    <!-- Page JS -->
    <script src="{{ asset('frontend/assets/js/front-page-landing.js') }}"></script>
  </body>
</html>
