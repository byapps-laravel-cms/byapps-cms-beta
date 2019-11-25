<!DOCTYPE html>
<html>

@include('partials.head')

@yield('style')
<body>

  <!-- Navigation Bar-->
  <header id="topnav">
      @include('partials.navigation')
  </header>
  <!-- End Navigation Bar-->

  <!-- Content -->
  <div class="wrapper">
    <section id="layout-content">
      <div id="content" class="col-md-12 mt-3">

        <div id="app">
          @yield('content')
        </div>

      </div>

      @unless (Route::getCurrentRoute()->uri() == '/')
      <div id="sidebar-toggle">
        <span><i class="mdi mdi-comment-processing-outline"></i></span>
          <p>OPEN</p>
      </div>
      @endunless

      <div id="sidebar" style="overflow-y:auto; z-index:2000;">
        @include('partials.aside')
      </div>

    </section>
  </div>
  @yield('script')
  @include('partials.footer')

</body>
</html>
