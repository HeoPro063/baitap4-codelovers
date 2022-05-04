@extends('user.layout.master')

@section('main')
<form action="{{route('user.post.mypageEdit')}}" method="post" class="beta-form-checkout">
    @csrf
    <div class="row">
        <div class="col-sm-3"></div>
        <div class="col-sm-6">
            <h4>Edit personal information</h4>
            <div class="space20">&nbsp;</div>
            <div class="form-block">
                <label for="name">Name new*</label>
                <input type="text" id="name" name="name" value="{{Auth::guard('user')->user()->name}}">
                @if ($errors->has('name'))
                <p style="color: red;margin-left:200px"> &ensp;  {{$errors->first('name')}}</p>
                @endif
            </div>
            <div class="form-block">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </div>
        <div class="col-sm-3"></div>
    </div>
</form>
@endsection