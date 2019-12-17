<?php
function dataToImage($input,$disk){
    $dom = new \DomDocument();
    $dom->loadHtml(mb_convert_encoding($input,'HTML-ENTITIES','UTF-8'), LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
    $images = $dom->getElementsByTagName('img');
    if(count($images) == 0) return $input;
    $result = $input;
    $cnt = 0;
    foreach($images as $img){
        $src = $img->getAttribute('src');
        if(preg_match('/data:image/',$src)){
            $ext = explode('.',$img->getAttribute('data-filename'));
            $filename = time().'_'.mt_rand(1000,9999).'.'.end($ext);
            $result = str_replace($src,"/data?path=" . $filename . "&disk=".$disk,$result);
            $src = preg_replace('/^data:image\/[a-z]{3,4};base64,/', '', $src);
            $src = str_replace(' ', '+', $src);
            Storage::disk($disk)->put($filename,base64_decode($src));
        }
    }
    return $result;
}
function XSS($input){
    return preg_replace('/<[\/]{0,1}script>||on[a-z]{4,9}=\".*\"/','',$input);
}
function validateExit($res){
    if(request()->ajax()){
        return response()->json($res, 400);
    }else{
        abort(400,$res['message']);
    }
}
function get_string_between($string, $start, $end){
    $string = ' '.$string;
    $ini = strpos($string, $start);
    if($ini == 0)return '';
    $ini+= strlen($start);
    $len = strpos($string, $end, $ini) - $ini;
    return substr($string, $ini, $len);
}
function getUserData($memId){
    $data = UserInfo::where('mem_id','=',$memId)->first(['mem_job','mem_name','phoneno','mem_email','ip']);
    return $data;
}
