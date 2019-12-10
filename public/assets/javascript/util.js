class Util{
  static setCookie (name, value) {
    var date = new Date();
    date.setTime(date.getTime() + 14*24*60*60*1000);
    document.cookie = `${name} = ${value}`;
  }
  static getCookie (name) {
    var value = document.cookie.match('(^|;) ?' + name + '=([^;]*)(;|$)');
    return value? value[2] : null;
  }
  static deleteCookie (name) {
    document.cookie = name + '=; expires=Thu, 01 Jan 1970 00:00:01 GMT;';
  }
  static isMobile() {
    return /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);
  }
}
function getMemData(memId){
    var request = {
        mem_id : memId
    }
    $.ajax({
        url : '/userinfodetail',
        type : 'GET',
        data : request,
        error : function(jqXHR, textStatus, error) {
            alert(jqXHR.responseJSON.message)
        },
        success : function(data, jqXHR, textStatus) {

            $('body').append(
                `<div id="shadow" onclick="closeMemData(this)" style="position:fixed;width:100%;height:100%;z-index:9990;background:#fff;opacity:.3;top:0"></div>
                <div id="mem-data" class="ui-widget-content" style="position:fixed;width:1000px;height:300px;z-index:9991;border-radius:15px;opacity:1;box-shadow: 5px 5px 15px #000;">
                    <div class="popHeader" style="height:50px;line-height: 50px; font-size: 18px;font-weight: bold; border-bottom: 1px solid #ccc;">
                        <span>회원정보</span>
                        <span style="float:right;padding-right:1rem;" onclick="closeMemData()">X</span>
                    </div>
                    <div class="popSection" style="width:100%;">
                        <table width="100%" cellpadding="0" cellspacing="1">
                            <tr>
                                <td bgcolor="black" height="1" colspan="2"> </td>
                            </tr>
                            <tr height="30">
                                <td style="text-align:center;background:#f7f7f7">ID</td>
                                <td>${data['mem_id']}</td>
                            </tr>
                            <tr height="30">
                                <td style="text-align:center;background:#f7f7f7">업체명</td>
                                <td>${data['mem_job']}</td>
                            </tr>
                            <tr height="30">
                                <td style="text-align:center;background:#f7f7f7">신청자명</td>
                                <td>${data['mem_name']}</td>
                            </tr>
                            <tr height="30">
                                <td style="text-align:center;background:#f7f7f7">연락처</td>
                                <td>${data['phoneno']}</td>
                            </tr>
                            <tr height="30">
                                <td style="text-align:center;background:#f7f7f7">이메일</td>
                                <td>${data['mem_email']}</td>
                            </tr>
                            <tr height="30">
                                <td style="text-align:center;background:#f7f7f7">로그정보</td>
                                <td>최근접속 IP : ${data['ip']}</td>
                            </tr>
                            <tr>
                                <td bgcolor="black" height="1" colspan="2"> </td>
                            </tr>
                        </table>
                    </div>
                </div>`
            );
            //팝업 center
            $("#mem-data").css({
                "top": (($(window).height()-$("#mem-data").outerHeight())/2+$(window).scrollTop())/2+"px",
                "left": (($(window).width()-$("#mem-data").outerWidth())/2+$(window).scrollLeft())+"px"
            });
            //드래그
            $("#mem-data").draggable();
            $( "#mem-data" ).resizable();
        }
    });
}

function closeMemData(obj){
    $("#shadow").remove();
    $('#mem-data').remove()
}
