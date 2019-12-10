@extends('layouts.default')

@section('content')
<div class="container col-12 col-md-12">
    <ul id="permission">
      @foreach($pageList as $name => $data)
        <li>
            <span>{{ $data['name'] }}</span>
            <select name="{{ $name }}">
                <option value="nothing">없음</option>
              @foreach($data['permission'] as $key => $val)
               @if(request()->user()->adminNMNew == 'all')
                <option value="{{ $key }}" selected>{{ $val }}</option>
               @else
                <option value="{{ $key }}"{{ strpos(request()->user()->adminNMNew,$name.$key) ? ' selected' : '' }}>{{ $val }}</option>
               @endif
              @endforeach
            </select>
        </li>
      @endforeach
    </ul>
    <input type="button" onclick="send()" value="저장">
</div>
@endsection
@push('scripts')
<script>
    function send(){
        var permission = [];
        for(var temp of $('#permission select')){
            var item = $(temp)
            if(item.val() == 'nothing') continue;
            for(var temp1 of item.find('option')){
                var option = $(temp1);
                if(option.val() == 'nothing') continue;
                permission.push(`${item.attr('name')}${option.val()}`);
                if(option.val() == item.val()) break;
            }
        }
        $.ajax({
            url : location.href,
            type : 'POST',
            data : {'permission':permission},
            error : function(jqXHR, textStatus, error) {

            },
            success : function(data, jqXHR, textStatus) {

            }
        });
        return false;
    }
</script>
@endpush
