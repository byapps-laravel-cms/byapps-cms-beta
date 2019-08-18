function change (char){
  return (char < 10?'0':'')+char;
}
$(document).ready(function (){
  var now = new Date();
  var beforeDate = new Date();
    
  const yy = now.getFullYear();
  const mm = now.getMonth() + 1;
  const dd = now.getDate();
    
  var result='';
  var last_num = 3;
  var new_num = 3;
    
  for(var i=0; i<7;i++){
    beforeDate.setFullYear(yy, mm, dd-3+i);
    result +="<li>"+beforeDate.getFullYear()+change(beforeDate.getMonth())+change(beforeDate.getDate())+"</li>";
  }
  $('.date_slide ul').html(result);
    
  $('.slide_left_btn').click(function (){
    last_num++;
    now.setFullYear(yy, mm, dd-last_num);
    var y = now.getFullYear();
    var m = now.getMonth();
    var d = now.getDate();
    $('.date_slide ul').prepend("<li>"+y+change(m)+change(d)+"</li>");
  });
    
  $('.slide_right_btn').click(function (){
    new_num++;
    now.setFullYear(yy, mm, dd+new_num);
    var y = now.getFullYear();
    var m = now.getMonth();
    var d = now.getDate();
    $('.date_slide ul').animate({'left':'-=14rem'});
    $('.date_slide ul').append("<li>"+y+change(m)+change(d)+"</li>");
  });
    
})