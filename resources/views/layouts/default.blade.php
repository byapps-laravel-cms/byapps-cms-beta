<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>CMS :: BYAPPS - </title>
        <meta name="description" content="">
        <meta name="title" content="">
        <meta name="author" content="Byapps">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="generator" content="">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <script>window.Laravel = { csrfToken: '{{ csrf_token() }}' }</script>

        <link rel="icon" type="image/png" href="{{ asset('byapps_logo_b_4.png') }}">

        <!-- Codefox Theme -->
        <link href="{{ asset('assets/codefox/css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/codefox/css/icons.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/codefox/css/style.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/css/temp.css?v1') }}" rel="stylesheet">
        <!-- //Codefox Theme -->

        <link href="{{ asset('assets/vendor/jquery-ui-1.12.1/jquery-ui.css') }}" rel="stylesheet">

        <link href="{{ asset('assets/css/drag.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/css/appdata.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/vendor/billboard.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/css/classCustom.css?v1') }}" rel="stylesheet">

        <!-- Datatable style -->
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/datatables/jquery.dataTables.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/datatables/buttons.dataTables.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/datatables/dataTables.checkboxes.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/datatables/fixedHeader.dataTables.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/datatables/responsive.dataTables.min.css') }}">

        <!-- jQuery  -->
        <script src="{{ asset('assets/codefox/js/jquery.min.js') }}"></script>

        <!-- bootstrap.bundle.min.js -->
        <script src="{{ asset('assets/codefox/js/bootstrap.bundle.min.js') }}"></script>

        <!-- Codefox Theme -->
        <script src="{{ asset('assets/codefox/js/modernizr.min.js') }}"></script>

        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

        <!-- Step 1) Load D3.js -->
        <script src="https://d3js.org/d3.v5.min.js"></script>

        <script src="{{ asset('assets/javascript/initial.min.js') }}"></script>

    </head>

    <body>

    <div id="app">
      <!-- Navigation Bar-->
      <header id="topnav">
          @include('partials.navigation')
      </header>
      <!-- End Navigation Bar-->

        <!-- Content -->
        <div class="wrapper">
          <section id="layout-content">
              <div id="content" class="col-md-12 mt-3">
                  @yield('content')
              </div>
             @unless (Route::has('home'))
              <div id="sidebar-toggle">
                  <span><i class="mdi mdi-comment-processing-outline"></i></span>
                  <p>OPEN</p>
              </div>
              @endunless
              <div id="sidebar">
                  @include('partials.aside')
              </div>
          </section>
        </div>

    </div>
        <!-- Scripts -->
        <script>
            function byapps_getCookie (cname) {
                var name = cname + "=";
                var ca = document.cookie.split(';');
                for (var i = 0; i < ca.length; i++) {
                    var c = ca[i];
                    while (c.charAt(0) == ' ') c = c.substring(1);
                    if (c.indexOf(name) == 0) return decodeURIComponent(c.substring(name.length, c.length));
                }
                return "";
            }
            function byapps_setCookie (name, value, ex) {
                if (!ex) ex = 365;
                var todayDate = new Date();
                todayDate.setDate(todayDate.getDate() + ex);
                document.cookie = name + "=" + encodeURIComponent(value) + "; path=/; expires=" + todayDate.toGMTString() + ";"
            }

            var now_page = location.href
            var cookie_history = byapps_getCookie("link_history")
            if(!cookie_history||cookie_history=="") byapps_setCookie("link_history", ""+"&"+location.href, 14)
            else {
                byapps_setCookie("link_history", cookie_history+"|"+""+"&"+location.href, 14)

                var ch = cookie_history.split("|");
                var newcookie, prev = "";

                for(i=0; i < ch.length; i++){
                var a = ch
                    if(i!=0) {
                        if( prev == a[i] ) {
                            newcookie += "";
                        } else {
                            !a[i] ? newcookie += "": newcookie += a[i]+"|";
                        }
                    } else {
                        !a[i] ? newcookie += "": newcookie += a[i]+"|";

                    }

                    prev = a[i];

                }
                newcookie = newcookie.replace("undefined|","");
                console.log( "newcookie",newcookie);
                console.log("newcookie.length", newcookie.split("|").length);
                if(ch.length >= 10) {
                    cookie_history = cookie_history.split(ch[0]+"|")[1];
                    console.log("cookie", cookie_history);
                    byapps_setCookie("link_history", cookie_history+"|"+""+"&"+location.href, 14);
                }

            }

                var str = "";
                var page_val = "";
                cookie_history = newcookie;
                ch = cookie_history.split("|");

                str += "<li><ul>";
                for(i=ch.length; i > 0; i--) {
                    if(i!=ch.length) page_val = ch[i-1].split("&");
                    if(page_val[0] && page_val[1]){
                        page_val[0] = page_val[0].replace("undefined","");
                        page_val[1] = page_val[1].replace("undefined", "")
                        str += '<li id="page_history_sub"><a href="'+page_val[1]+'">'+page_val[0]+'</a></li>';
                    }
                }
                str += "</ul></li>";
                console.log("str", str);
                $('#page_history .submenu.megamenu').append(str);

        </script>

        <script type="text/javascript">

            $('.profile').initial({
              width: 32,
              height: 32,
              fontSize: 16 });

        </script>

        <!-- Vue.js -->
        <script src="{{ asset('js/app.js') }}"></script>

        <!-- Codefox Theme -->
        <script src="{{ asset('assets/codefox/js/waves.js') }}"></script>
        <script src="{{ asset('assets/codefox/js/jquery.slimscroll.js') }}"></script>

        <!-- Counter js  -->
        <script src="{{ asset('assets/codefox/plugins/waypoints/jquery.waypoints.min.js') }}"></script>
        <script src="{{ asset('assets/codefox/plugins/counterup/jquery.counterup.min.js') }}"></script>

        <!-- Dashboard init -->
        <script src="{{ asset('assets/codefox/js/jquery.dashboard.js') }}"></script>

        <!-- App js -->
        <script src="{{ asset('assets/codefox/js/jquery.core.js') }}"></script>
        <script src="{{ asset('assets/codefox/js/jquery.app.js') }}"></script>
        <!-- //Codefox Theme -->

        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>

        <script src="{{ asset('assets/vendor/jquery-ui-1.12.1/jquery-ui.js') }}"></script>
        <!-- <script src="{{ asset('assets/vendor/jquery-ui.min.js') }}"></script> -->

        <script src="{{ asset('assets/vendor/jquery.bpopup.min.js') }}"></script>
        <script src="{{ asset('assets/vendor/billboard.js') }}"></script>
        <script src="{{ asset('assets/javascript/util.js') }}"></script>
        <script src="{{ asset('assets/javascript/temp.js?v1') }}"></script>
        <script src="{{ asset('assets/javascript/app.js') }}"></script>


        @if (Route::has('home'))
          <!-- <script src="{{ asset('assets/javascript/chart.js') }}"></script> -->
          <script src="{{ asset('assets/javascript/drag.js') }}"></script>
        @else
          <script src="{{ asset('assets/javascript/aside.js') }}"></script>
        @endif

        <!-- For Datatable -->
        <script src="{{ asset('assets/javascript/datatables/jquery.dataTables.min.js') }}"></script>

          <!-- For Datatable Export Button -->
          <script src="{{ asset('assets/javascript/datatables/dataTables.buttons.min.js') }}"></script>
          <script src="{{ asset('assets/javascript/datatables/buttons.flash.min.js') }}"></script>
          <script src="{{ asset('assets/javascript/datatables/jszip.min.js') }}"></script>
          <script src="{{ asset('assets/javascript/datatables/vfs_fonts.js') }}"></script>
          <script src="{{ asset('assets/javascript/datatables/buttons.html5.min.js') }}"></script>
          <script src="{{ asset('assets/javascript/datatables/buttons.print.min.js') }}"></script>

        <script src="{{ asset('assets/javascript/datatables/dataTables.checkboxes.min.js') }}"></script>
        <script src="{{ asset('assets/javascript/datatables/dataTables.fixedHeader.min.js') }}"></script>
        <script src="{{ asset('assets/javascript/datatables/dataTables.responsive.min.js') }}"></script>
        <!-- For Datatable 끝 -->

        @stack('scripts')

    </body>
</html>
