@extends('user.layout.master')

@section('main')
<form action="{{route('user.post.regiser')}}" method="post" class="beta-form-checkout">
    @csrf
    <div class="row">
        <div class="col-sm-3"></div>
        <div class="col-sm-6">
            <h4>Register</h4>
            <div class="space20">&nbsp;</div>
            <div class="form-block">
                <label for="email">Email address*</label>
                <input type="email" id="email" name="email"  value="{{old('email')}}">
                @if ($errors->has('email'))
                <p style="color: red;margin-left:200px"> &ensp;  {{$errors->first('email')}}</p>
                @endif
            </div>

            <div class="form-block">
                <label for="your_last_name">Name*</label>
                <input type="text" id="your_last_name" name="name" value="{{old('name')}}">
                @if ($errors->has('name'))
                <p style="color: red;margin-left:200px"> &ensp;  {{$errors->first('name')}}</p>
                @endif
            </div>
            <div class="form-block">
                <label for="password">Password*</label>
                <input type="password" id="password" name="password" >
                @if ($errors->has('password'))
                <p style="color: red;margin-left:200px"> &ensp;  {{$errors->first('password')}}</p>
                @endif
            </div>
            <div class="form-block">
                <label for="password_confirmation">Re password*</label>
                <input type="password" id="password_confirmation" name="password_confirmation" >
                @if ($errors->has('password_confirmation'))
                <p style="color: red;margin-left:200px"> &ensp;  {{$errors->first('password_confirmation')}}</p>
                @endif
            </div>
            <div class="form-block">
                <button type="submit" class="btn btn-primary">Register</button>
            </div>
        </div>
        <div class="col-sm-3"></div>
    </div>
</form>
@endsection