<!doctype html>
<html lang="en">
  @include('front.components.stylesheets')
  <body id="home" data-spy="scroll" data-target="#navbar-wd" data-offset="98">
  @include('front.components.head')
    <!-- <div class="container"> -->
      @yield('content')
    <!-- </div> -->
    @include('front.components.scripts')
  </body>
</html>