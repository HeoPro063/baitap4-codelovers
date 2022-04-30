@extends('user.layout.master')

@section('main')
@if( session('status_success'))
<p style="color: green; font-size: 18px;text-align: center;margin-top:30px">{{ session('status_success')}}</p>
@endif
<div class="container-mypage-more-css">
  
    <h3>Thông tin cá nhân</h3>
    <h4>User: {{Auth::guard('user')->user()->name}}</h4>
    <h4>Email:  {{Auth::guard('user')->user()->email}}</h4>
    <div class="action">
        <a href="{{route('user.mypage.edit')}}">Sửa thông tin cá nhân</a>
        <a href="{{route('user.change.password')}}">Đổi mật khẩu</a>
    </div>
</div>
@endsection