<!DOCTYPE html>
<html style="height: 100%">

@include('partials.head')

@yield('style')
<body style="height: 100%; padding:0;" <?=$_COOKIE['sidebar'] == 'open' ? 'class="open"' : '' ?>>

  <!-- Navigation Bar-->
  <header id="topnav" class="<?=$_COOKIE['sidebar'] == 'open' ? 'col-md-8 p-0' : 'col-md-12 p-0' ?>">
      @include('partials.navigation')
  </header>
  <!-- End Navigation Bar-->

  <!-- Content -->
  <div class="wrapper"  style="height: 100%">
    <section id="layout-content"  style="height: 100%">
      <div id="content" class="<?=$_COOKIE['sidebar'] == 'open' ? 'col-md-8 p-0' : 'col-md-12 mt-3' ?>">

        <div id="app">
          @yield('content')
        </div>

      </div>

      @unless (Request::route()->getName() == 'home')
      <div id="sidebar-toggle" <?=$_COOKIE['sidebar'] == 'open' ? 'style="display: none;"' : '' ?>>
        <span><i class="mdi mdi-comment-processing-outline"></i></span>
          <p>OPEN</p>
      </div>
      @endunless

      <div id="sidebar" style="overflow-y:auto; z-index:2000;<?=$_COOKIE['sidebar'] == 'open' ? 'display: block;" class="col-md-4' : '' ?>">
        @include('partials.aside')
      </div>

    </section>
  </div>
  @yield('script')
  @include('partials.footer')

</body>
</html>
