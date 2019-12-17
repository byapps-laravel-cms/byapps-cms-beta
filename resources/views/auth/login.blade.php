@extends('layouts.default')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('로그인') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}" onsubmit="return login(this)">
                        @csrf

                        <div class="form-group row">
                            <label for="user_id" class="col-md-4 col-form-label text-md-right">{{ __('사용자 ID') }}</label>

                            <div class="col-md-6">
                                <input id="user_id" type="text" class="form-control @error('user_id') is-invalid @enderror" name="user_id" value="{{ Cookie::get('login_remember') ?: '' }}" required autocomplete="user_id" autofocus>

                                <span class="invalid-feedback" id="userIdError" role="alert">
                                    <strong>asdf</strong>
                                </span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('비밀번호') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                    <span class="invalid-feedback" id="passwordError" role="alert">
                                        <strong>asdf</strong>
                                    </span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ Cookie::get('login_remember') != null ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('로그인 정보 기억') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('로그인') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('비밀번호를 잊어버리셨나요?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function login(obj){
        var request = new FormData(obj);
        obj = $(obj);
        $('#user_id').removeClass('is-invalid')
        $('#password').removeClass('is-invalid')
        $.ajax({
            url : obj.attr('action'),
            type : 'POST',
            data : request,
            cache : false,
            contentType: false,
            processData: false,
            error : function(jqXHR, textStatus, error) {
                if(jqXHR.status == 419){
                    alert(jqXHR.responseJSON.message)
                    location += '';
                }
            },
            success : function(data, jqXHR, textStatus) {
                if(data.success){
                    location.href = '{!! URL::previous() !!}';
                }else{
                    if(data.message == 'user_id'){
                        $('#user_id').addClass('is-invalid')
                        $('#userIdError').html('<strong>존재하지 않는 아이디 입니다.</strong>')
                    }else if(data.message == 'password'){
                        $('#password').addClass('is-invalid')
                        $('#passwordError').html('<strong>비밀번호가 일치하지 않습니다</strong>')
                    }
                }
            }
        });
        return false;
    }
</script>
@endsection
