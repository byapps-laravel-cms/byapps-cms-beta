@if (count($breadcrumbs))
    <?$history = array('title'=>'','url'=>'');?>
    <ol class="breadcrumb">
        @foreach ($breadcrumbs as $key => $breadcrumb)
            <?
            $history['title'].= $breadcrumb->title;
            if ($key == count($breadcrumbs)-1){
                $history['url'] = $breadcrumb->url;
            }else{
                $history['title'].= " > ";
            }
            ?>
            @if ($breadcrumb->url && !$loop->last)
                <li class="breadcrumb-item"><a href="{{ $breadcrumb->url }}">{{ $breadcrumb->title }}</a></li>
            @else
                <li class="breadcrumb-item active">{{ $breadcrumb->title }}</li>
            @endif

        @endforeach
    </ol>
    <?
    config(['app.now_page' => $history]);
    $historys = Cookie::get('link_history') ? (array)json_decode(Cookie::get('link_history')) : [];
    foreach ($historys as $key => $row) {
        if($row == $history) unset($historys[$key]);
    }
    if($history == [] || $history != end($historys)){
        $historys[] = (array)$history;
        if(count($historys) > 10){
            unset($historys[0]);
        }
    }
    Cookie::queue(Cookie::make('link_history',json_encode($historys), 60*24*365));?>
@endif
