<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Twitter -->
    <meta name="twitter:site" content="@themepixels">
    <meta name="twitter:creator" content="@themepixels">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Slim">
    <meta name="twitter:description" content="Premium Quality and Responsive UI for Dashboard.">
    <meta name="twitter:image" content="http://themepixels.me/slim/img/slim-social.png">

    <!-- Facebook -->
    <meta property="og:url" content="http://themepixels.me/slim">
    <meta property="og:title" content="Slim">
    <meta property="og:description" content="Premium Quality and Responsive UI for Dashboard.">

    <meta property="og:image" content="http://themepixels.me/slim/img/slim-social.png">
    <meta property="og:image:secure_url" content="http://themepixels.me/slim/img/slim-social.png">
    <meta property="og:image:type" content="image/png">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="600">

    <!-- Meta -->
    <meta name="description" content="Premium Quality and Responsive UI for Dashboard.">
    <meta name="author" content="ThemePixels">

    <title>Slim Responsive Bootstrap 4 Admin Template</title>

    <!-- vendor css -->
    <link href="{{ asset('vendor/lib/font-awesome/css/font-awesome.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/lib/Ionicons/css/ionicons.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/lib/perfect-scrollbar/css/perfect-scrollbar.min.css') }}" rel="stylesheet">

    <!-- Slim CSS -->
    <link rel="stylesheet" href="{{ asset('css/slim.css') }}">

  </head>
  <body>

    @include('cms._layout.topbar')

    <div class="slim-body">
      @include('cms._layout.sidebar')

      <div class="slim-mainpanel">
        <div class="container">
          <div class="slim-pageheader">
            <ol class="breadcrumb slim-breadcrumb">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Blank Page</li>
            </ol>
            <h6 class="slim-pagetitle">Blank Page</h6>
          </div><!-- slim-pageheader -->

        </div><!-- container -->

        @include('cms._layout.footer')
      </div><!-- slim-mainpanel -->
    </div><!-- slim-body -->

    <script src="{{ asset('vendor/lib/jquery/js/jquery.js') }}"></script>
    <script src="{{ asset('vendor/lib/popper.js/js/popper.js') }}"></script>
    <script src="{{ asset('vendor/lib/bootstrap/js/bootstrap.js') }}"></script>
    <script src="{{ asset('vendor/lib/jquery.cookie/js/jquery.cookie.js') }}"></script>
    <script src="{{ asset('vendor/lib/perfect-scrollbar/js/perfect-scrollbar.jquery.min.js') }}"></script>

    <script src="{{ asset('vendor/js/slim.js') }}"></script>
  </body>
</html>
