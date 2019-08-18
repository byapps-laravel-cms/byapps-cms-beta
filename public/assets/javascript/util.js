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