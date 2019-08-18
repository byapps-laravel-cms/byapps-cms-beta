formData = new FormData();
formData.append('test','test');
var temp;
// function asdf(){
//     temp = $('form').request('onTest', {
//         success: function(data) {
//             console.log(data.result);
//         },
//         error: function (jqXHR, textStatus, errorThrown) {
//             console.log(jqXHR.responseText)
//         }
//     })
//     return null;
// }
// var li1 = "<div class='col-sm-1 col-xs-3'><img class='h-25 p-10 d-inline-block'  src='https://cms.byapps.co.kr/space/ic_launcher.png' alt='#'><p>2019-06-03</p></div>"
// var li2 = "<div class='col-sm-1 col-xs-3'><img class='h-25 p-10 d-inline-block'  src='https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSd20d5uTTvOJ6kT7ANcGPb3iNnOcMfTDAtEVUrvTlOrRrzyTuE5w' alt='#'><p>2019-06-03</p></div>"
// var li3 = "<div class='col-sm-1 col-xs-3'><img class='h-25 p-10 d-inline-block'  src='https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcStI_5Isvkt5A8ERpkETaf63WbicSbtpeAEmbhp4SuM9WkX6Fa7' alt='#'><p>2019-06-03</p></div>"
// for(var i=0; i<40; i++){
//     $("#layout3 > .dragbox > .row:nth-child(2)").append(li1);
//     $("#layout3 > .dragbox > .row:nth-child(3)").append(li2);
//     $("#layout3 > .dragbox > .row:nth-child(4)").append(li3);
// }

// $("#layout3 > .dragbox > .row:not(:first-child").css({'display':'none'});
// $("#layout3 > .dragbox > .row:nth-child(2)").css({'display':'block'});
$(".app_select li").eq(0).css({'border-bottom':'1px solid gray'});
$(".app_select li").click(function (){
    var index = $(".app_select li").index(this);
    $(".app_select li").css({'border':'0'});
    $(this).css({'border-bottom':'1px solid gray'});
    $("#layout3 > .dragbox > .row:not(:first-child").css({'display':'none'});
    // $("#layout3 > .dragbox > .row").eq(index+1).css({'display':'block'});
})
