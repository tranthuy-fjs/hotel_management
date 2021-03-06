@extends('admin.layouts.dashboard')
@section('title')
    Danh sách người dùng
@endsection
@section('content')
    <div class="header bg-primary pb-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4">
                    <div class="col-lg-6">
                    </div>
                    <div class="col-lg-6 text-right">
                        <a href="{{route('admin.guest.create')}}" class="btn btn-sm btn-neutral">Thêm mới</a>
                        <a class="btn btn-sm btn-neutral" href="{{route('admin.guest.export')}}">Xuất excel</a>
                        {{--<div class="dropdown">--}}
                            {{--<button class="btn btn-neutral btn-sm dropdown-toggle" type="button"--}}
                                    {{--id="dropdownMenuButton"--}}
                                    {{--data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">--}}
                                {{--Action--}}
                            {{--</button>--}}
                            {{--<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">--}}
                                {{--<a class="dropdown-item" data-toggle="modal" data-target="#modal">Import</a>--}}
                                {{--<a class="dropdown-item" href="{{route('admin.guest.export')}}">Export</a>--}}
                            {{--</div>--}}

                            {{--<form action="{{route('admin.guest.import')}}" method="post" enctype="multipart/form-data">--}}
                                {{--@csrf--}}
                                {{--<div class="modal fade" id="modal" tabindex="-1" role="dialog"--}}
                                     {{--aria-labelledby="modalLabel" aria-hidden="true">--}}
                                    {{--<div class="modal-dialog modal-dialog-centered" role="document">--}}
                                        {{--<div class="modal-content">--}}
                                            {{--<div class="modal-header">--}}
                                                {{--<h5 class="modal-title" id="modalLabel">Upload file</h5>--}}
                                                {{--<button type="button" class="close" data-dismiss="modal"--}}
                                                        {{--aria-label="Close">--}}
                                                    {{--<span aria-hidden="true">&times;</span>--}}
                                                {{--</button>--}}
                                            {{--</div>--}}
                                            {{--<div class="modal-body">--}}
                                                {{--Chọn file:--}}
                                                {{--<input type="file" class="custom-file-input" name="select_file"--}}
                                                       {{--accept=".xlsx, .xls, .csv"/>--}}
                                            {{--</div>--}}
                                            {{--<div class="modal-footer">--}}
                                                {{--<button type="button" class="btn btn-secondary"--}}
                                                        {{--data-dismiss="modal">--}}
                                                    {{--Close--}}
                                                {{--</button>--}}
                                                {{--<button type="submit" class="btn btn-primary">Upload</button>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</form>--}}
                        {{--</div>--}}
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col">
                <div class="card">
                    <!-- Card header -->
                    <div class="card-header border-0">
                        <div class="row">
                            <div class="col-lg-7">
                                <h3 class="mb-0">Danh sách người dùng</h3>
                            </div>
                        </div>
                    </div>
                    <!-- Light table -->

                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Email</th>
                                <th scope="col">Tên đăng nhập</th>
                                <th scope="col">Địa chỉ</th>
                                <th scope="col">Điện thoại</th>
                                <th scope="col"></th>
                            </tr>
                            </thead>
                            <tbody class="list">
                            @foreach($guests as $guest)
                                <tr>
                                    <td>
                                        {{$guest->id}}
                                    </td>
                                    <td>
                                        <a href="{{route('admin.guest.star_rating', $guest->id)}}">{{$guest->email}}</a>
                                    </td>
                                    <td>
                                        <a href="{{route('admin.guest.star_rating', $guest->id)}}">{{$guest->user_name}}</a>
                                    </td>
                                    <td>
                                        {{$guest->address}}
                                    </td>
                                    <td>
                                        {{$guest->phone}}
                                    </td>

                                    <td class="text-right">
                                        <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                <a class="dropdown-item"
                                                   href="{{route('admin.guest.edit', $guest->id)}}">Edit</a>
                                                <a class="dropdown-item" data-toggle="modal"
                                                   data-target="#modal{{$guest->id}}">Delete</a>

                                            </div>
                                        </div>

                                    </td>
                                </tr>
                                <form action="{{route('admin.guest.destroy', $guest->id)}}" method="post">
                                    @csrf
                                    <div class="modal fade" id="modal{{$guest->id}}" tabindex="-1" role="dialog"
                                         aria-labelledby="modal{{$guest->id}}Label" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="modal{{$guest->id}}Label">Xóa người dùng
                                                        {{$guest->user_name}}</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    Bạn có chắc chắn xóa người dùng {{$guest->user_name}}?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">
                                                        Close
                                                    </button>
                                                    <button type="submit" class="btn btn-primary">Xóa</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            @endforeach
                            </tbody>
                        </table>
                        {{ $guests->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
