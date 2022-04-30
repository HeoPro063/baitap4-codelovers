@extends('user.layout.master')

@section('main')
<form action="{{route('user.post.auth-active')}}" method="post" class="beta-form-checkout">
    @csrf
    <div class="row">
        <div class="col-sm-3"></div>
        <div class="col-sm-6">
            <h4>Email verification</h4>
            @if( session('status_success'))
            <p style="color: green; font-size: 18px">{{ session('status_success')}}</p>
            @endif
            @if( session('status_denger'))
            <p style="color: red; font-size: 18px">{!! session('status_denger') !!}</p>
            @endif
            <div class="space20">&nbsp;</div>
            <div class="form-block">
                <label for="email">Nhập Email tài khoản của bạn*</label>
                <input type="email" id="email" name="email" value="{{old('email')}}">
                @if ($errors->has('email'))
                <p style="color: red;margin-left:200px"> &ensp;  {{$errors->first('email')}}</p>
                @endif
            </div>
            <div class="form-block">
                <button type="submit" class="btn btn-primary">Login</button>
            </div>
        </div>
        <div class="col-sm-3"></div>
    </div>
</form>
@endsection