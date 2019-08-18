//앱 상세 더보기
$(".show_btn").click(function (){
  if($(".top_banner").css("display")=="block"){
    $(".top_banner").slideUp(500);
    $(".show_btn").css({"background-color":"#c6c6c6"});
  }else{
    $(".top_banner").slideDown(500); 
    $(".show_btn").css({"background-color":"#d9edf7"});   
  }
});
// //카테고리 변경 확인
// if(Util.getCookie('searchType')){
//   $('.select_comm_1 option').eq(Util.getCookie('searchType')*1).attr('selected','selected');
// }
// $('.select_comm_1').change(function () {
//   document.cookie = `searchType=${$('.select_comm_1 option:selected').index()};path=/`;
// });
// //쿠키
// if(Util.getCookie('aside') == 'on' && $('#sidebar').length != 0){
//   $("html").toggleClass("open");
// }
// //home 만료예정업체
// $(".app_box_cover").eq(0).css({"display":"block"}); 
// $(".app_select li").eq(0).css({"background-color":"#c2d4ef"});
// //click
// $(".app_select li").click(function (){
//   var index = $(".app_select li").index(this);
//   $(".app_box_cover").css({"display":"none"});
//   $(".app_select li").css({"background-color":"#c6c6c6"});
//   $(".app_box_cover").eq(index).css({"display":"block"}); 
//   $(".app_select li").eq(index).css({"background-color":"#c2d4ef"});
// });
// //앱 상세 첫 ㅍ시 화면
// $(".develop_info_select li").eq(0).css({"background-color":"#c2d4ef"});
// $(".develop_info").eq(0).css({"display":"block"});
// //click
// $(".develop_info_select li").click(function (){
//   var index = $(".develop_info_select li").index(this);
//   //초기화
//   $(".develop_info_select li").css({"background-color":"#c6c6c6"});
//   $(".develop_info").css({"display":"none"});
//   //변경
//   $(".develop_info_select li").eq(index).css({"background-color":"#c2d4ef"});
//   $(".develop_info").eq(index).css({"display":"block"});
// });


// function platform_chk (){
//   var filter = "win16|win32|win64|mac|macintel"; 
//   if ( navigator.platform ) {
//     if ( filter.indexOf( navigator.platform.toLowerCase() ) < 0 ) { 
//       $("#slidebar").css({"width":"58%"});
//       return "mobile";
//     } else { 
//       $("#slidebar").css({"width":"41%"});
//       return "pc";
//     }
//   }    
// }

// $("#sidebar-close,#sidebar-toggle").click(function (){
//   $("html").toggleClass("open");
//   platform_chk();
//   if($("html").attr('class')=="open"){
//   $(".container").css({"margin":"0"});
//     document.cookie = "aside=on;path=/";
//   }else{
//     $(".container").css({"margin":""});
//     document.cookie = "aside=off;path=/";   
//   }
// });