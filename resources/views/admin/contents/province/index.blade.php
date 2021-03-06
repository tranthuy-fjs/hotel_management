@extends('admin.layouts.dashboard')
@section('title')
    Tỉnh thành
@endsection
@section('content')
    <div class="header bg-primary pb-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4">
                    <div class="col-lg-5">
                        <form action="{{route('admin.province.search')}}" method="get">
                            <select id="country" name="country" class="btn btn-sm btn-neutral">
                                <option value="" selected disabled>Quốc gia</option>
                                @foreach($countries as $country)
                                    <option value="{{$country->id}}">{{$country->country_name}}</option>
                                @endforeach

                            </select>
                            <input type="submit" class="btn btn-sm btn-neutral" value="Tìm kiếm">
                        </form>
                    </div>
                    <div class="col-lg-7 text-right">
                        <a href="{{route('admin.province.create')}}" class="btn btn-sm btn-neutral">Thêm mới</a>
                        <div class="dropdown">
                            {{--<button class="btn btn-neutral btn-sm dropdown-toggle" type="button"--}}
                            {{--id="dropdownMenuButton"--}}
                            {{--data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">--}}
                            {{--Action--}}
                            {{--</button>--}}
                            {{--<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">--}}
                            {{--<a class="dropdown-item"  data-toggle="modal" data-target="#modal">Import</a>--}}
                            {{--<a class="dropdown-item" href="{{route('admin.country.export')}}">Export</a>--}}
                            {{--</div>--}}

                            {{--<form action="{{route('admin.country.import')}}" method="post" enctype="multipart/form-data">--}}
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
                            {{--<input type="file" class="custom-file-input" name="select_file" accept=".xlsx, .xls, .csv"/>--}}
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
                        </div>
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
                                <h3 class="mb-0">Tỉnh thành</h3>
                            </div>
                        </div>
                    </div>
                    <!-- Light table -->

                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Tỉnh thành</th>
                                <th scope="col">Ảnh</th>
                                <th scope="col"></th>
                            </tr>
                            </thead>
                            <tbody class="list">
                            @foreach($provinces as $province)
                                <tr>
                                    <td>
                                        {{$province->id}}
                                    </td>
                                    <td>
                                        <a href="{{route('admin.province.hotel', $province->id)}}">{{$province->province_name}}</a>
                                    </td>
                                    <td>
                                        <img alt="Image placeholder" src="{{$province->province_image}}"
                                             style="width: 120px; height: 80px;">
                                    </td>

                                    <td class="text-right">
                                        <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                <a class="dropdown-item"
                                                   href="{{route('admin.province.edit', $province->id)}}">Edit</a>
                                                <a class="dropdown-item" data-toggle="modal"
                                                   data-target="#modal{{$province->id}}">Delete</a>
                                            </div>
                                        </div>

                                    </td>
                                </tr>
                                <form action="{{route('admin.province.destroy', $province->id)}}" method="post">
                                    @csrf
                                    <div class="modal fade" id="modal{{$province->id}}" tabindex="-1" role="dialog"
                                         aria-labelledby="modal{{$province->id}}Label" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="modal{{$province->id}}Label">Xóa tỉnh {{$province->province_name}}</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    Bạn có chắc chắn xóa tỉnh {{$province->province_name}} ?
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
                        {{ $provinces->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
