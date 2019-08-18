$(function (){
    // 파일 드롭 다운
    fileDropDown($(".file_dropzone"));
});

function fileDropDown(dropZone){
    //Drag기능
    dropZone.on('dragleave',function(e){
        e.stopPropagation();
        e.preventDefault();
        // 드롭다운 영역 css
        $(this).css({'background-color':'#fff','background':''});
    });
    dropZone.on('dragover',function(e){
        e.stopPropagation();
        e.preventDefault();
        // 드롭다운 영역 css
        $(this).css({"background":"url(https://cdn4.iconfinder.com/data/icons/ionicons/512/icon-ios7-cloud-upload-outline-256.png)", 'background-repeat' : 'no-repeat', 'background-position':'center'});
        // $('body').css({'background-color':'#c1c1c1'})
    });
    dropZone.on('drop',function(e){
        e.preventDefault();
        // 드롭다운 영역 css
        $(this).css('background-color','black');

        var files = e.originalEvent.dataTransfer.files;
        if(files != null){
            if(files.length < 1){
                alert("폴더 업로드 불가");
                return;
            }
            selectFile(files,$(this))
        }else{
            alert("ERROR");
        }
    });
}

function selectFile(fileObject,target){
    var files = null;

    if(fileObject != null){
        files = fileObject;
    }else{
        files = $('#multipaartFileList_' + fileIndex)[0].files;
    }
    addFileList(files[0],target);
}
function addFileList(file,target){
    formData = new FormData($('form').eq(0));
    formData.append('file',file);
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('[name="_token"]').attr('value')
        }
    });
    $.ajax({
        url:'./',
        data:formData,
        type:'POST',
        enctype:'multipart/form-data',
        processData:false,
        contentType:false,
        dataType:'json',
        cache:false,
        success : function(data) {
            target.css('background-image',`url('${data}')`)
            target.text('');
        },
        error: function(jqXHR, textStatus, errorThrown) {
            target.css('background-image',`url('${jqXHR.responseText}')`);
            target.text('');
        }
    });
}