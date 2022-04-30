@extends('admin.layout.master')


@section('content')
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Dashboard v1</li>
            </ol>
            </div>
        </div>
        </div>
    </div>
  
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    @if(session('status'))
                        <div class="alert {{ session('status') }} alert-dismissible fade show" role="alert">
                            {{ session('message') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                </div>
            </div>
            <div class="row">
                <section class="col-lg-12 connectedSortable">
                    <!-- TO DO List -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                            <i class="ion ion-clipboard mr-1"></i>
                            List Users
                            </h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table">
                                <thead class="thead-dark">
                                  <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Action</th>
                                  </tr>
                                </thead>
                                <tbody>
                                    @foreach($listUsers as $key => $item) 
                                        <tr>
                                            <th scope="row">{{ $key + 1 }}</th>
                                            <td class="@if($item->status) text-primary @else text-muted @endif">{{ $item->name }} </td>
                                            <td class="@if($item->status) text-primary @else text-muted @endif">{{$item->email}}</td>
                                            <td>
                                                @if($item->status)
                                                <a href="{{route('admin.home.disable', ['id' => $item->id])}}" class="btn btn-secondary">Đóng tài khoản</a>
                                                @else
                                                <a href="{{route('admin.home.active', ['id' => $item->id])}}" class="btn btn-primary ">Mở tài khoản</a>
                                                @endif
                                                <a href="{{route('admin.home.delete', ['id' => $item->id])}}" class="btn btn-danger  @if($item->status) disabled @endif">Xóa người dùng</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                              </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </section>
            </div>
        </div>
    </section>
@endsection