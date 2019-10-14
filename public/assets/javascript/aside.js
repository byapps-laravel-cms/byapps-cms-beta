if(Util.getCookie('aside') == 'on' && $('#sidebar').length != 0) {
  $("body").toggleClass("open");
}
// $('.top_btn').click( function () {
//   $( 'html, body' ).animate( { scrollTop : 0 }, 400 );
//   return false;
// });


$("#sidebar-close,#sidebar-toggle").click(function () {
  $("body").toggleClass("open");
  if($("body").attr('class')=="open") {

    $('#content').attr("class","col-md-9 p-0");
    $('#topnav').attr("class","col-md-9 p-0");
    $("#sidebar").attr("class","col-md-3");
    $("#sidebar").css("display","block");
    $("#sidebar-toggle").hide();

    localStorage.setItem('activeSidebar', $(e.target).attr('href'));
  
    //document.cookie = "aside=on;path=/";
  } else {
    $('#content').attr("class","col-md-12 p-0");
    $('#topnav').attr("class","col-md-12 p-0");
    $("#sidebar").attr("class","col-md-0");
    $("#sidebar").css("display","none");
    $("#sidebar-toggle").show();

    //document.cookie = "aside=off;path=/";
  }
});
