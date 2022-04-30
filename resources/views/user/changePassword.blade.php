@extends('user.layout.master')

@section('main')
@if( session('status_danger'))
<p style="color: red; font-size: 18px;text-align: center;margin-top:30px">{{ session('status_danger')}}</p>
@endif
<form action="{{route('user.post.change.password')}}" method="post" class="beta-form-checkout">
    @csrf
    <div class="row">
        <div class="col-sm-3"></div>
        <div class="col-sm-6">
            <h4>Edit personal information</h4>
            <div class="space20">&nbsp;</div>
            <div class="form-block">
                <label for="password">Password present*</label>
                <input type="password" name="password" id="password" name="password" >
                @if ($errors->has('password'))
                <p style="color: red;margin-left:200px"> &ensp;  {{$errors->first('password')}}</p>
                @endif
            </div>
            <div class="form-block">
                <label for="password_new">Password new*</label>
                <input type="password" id="password_new" name="password_new" >
                @if ($errors->has('password_new'))
                <p style="color: red;margin-left:200px"> &ensp;  {{$errors->first('password_new')}}</p>
                @endif
            </div>
            <div class="form-block">
                <label for="re_password_new">Re Password new*</label>
                <input type="password" id="re_password_new" name="re_password_new" >
                @if ($errors->has('re_password_new'))
                <p style="color: red;margin-left:200px"> &ensp;  {{$errors->first('re_password_new')}}</p>
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