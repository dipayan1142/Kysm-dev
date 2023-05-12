<!doctype html>
<html lang="en">
  @include('front.components.stylesheets')
  <body id="home" data-spy="scroll" data-target="#navbar-wd" data-offset="98">
     <!-- LOADER -->
     <div id="preloader">
            <div class="loader">
                <img src="{{asset('front/images/loader.gif')}}" alt="#" />
            </div>
        </div>
        <!-- end loader -->
        <!-- END LOADER -->
        
  @include('front.components.head')
    <!-- <div class="container"> -->
      @yield('content')
    <!-- </div> -->
    @include('front.components.scripts')
  </body>
</html>