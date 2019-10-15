if(Util.isMobile() == false){
  $( ".sortable" ).sortable({
    stop: function(event, ui) {saveLayout()}
  });
  $( ".sortable" ).disableSelection();
}

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

//레이아웃 수정시
function getLayout (){
  var formData = new Object();
  for(var i = 0,j = 0 ; i < $( ".sortable>li" ).length ; i ++, j ++){
    if(!$( ".sortable>li" ).eq(i).attr('id')) {j--;continue;}
    formData[$( ".sortable>li" ).eq(i).attr('id')] = j;
  }
  return formData;
}

function saveLayout (){
  $.ajax({
      url : "/layout",
      method:"get",
      data : getLayout()
  });
}
