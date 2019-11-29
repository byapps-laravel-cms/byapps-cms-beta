@if (count($breadcrumbs))

    <?$history = array('title'=>'','url'=>url(request()->getPathInfo()));?>
    <ol class="breadcrumb">

    @foreach ($breadcrumbs as $key => $breadcrumb)
        @if ($breadcrumb->url && !$loop->last)
            <?$history['title'].= $breadcrumb->title." > ";?>
            <li class="breadcrumb-item"><a href="{{ $breadcrumb->url }}">{{ $breadcrumb->title }}</a></li>
        @else
            <?$history['title'].= $title ? $title : $breadcrumb->title;?>
            <li class="breadcrumb-item active">{{ $breadcrumb->title }}</li>
        @endif

    @endforeach
    </ol>
    <?
    config(['app.now_page' => $history]);
    $historys = Cookie::get('link_history') ? (array)json_decode(Cookie::get('link_history')) : (array)[$history];
    foreach ($historys as $key => $row) {
        if($row == $history) unset($historys[$key]);
    }
    if(Cookie::get('refer') != null && $history['url'] != Cookie::get('refer')){
        $historys[] = (array)$history;
    }
    if(count($historys) > 5){
        array_splice($historys,0,1);
    }
    Cookie::queue(Cookie::make('link_history',json_encode($historys), 60*24*365));
    Cookie::queue(Cookie::make('refer',$history['url'], 60*24*365));?>
@endif
