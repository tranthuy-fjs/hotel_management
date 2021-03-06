@extends('admin.layouts.dashboard')
@section('title')
    Chỗ nghỉ
@endsection
@section('content')
    <div class="header bg-primary pb-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4">

                    <div class="col-lg-5">
                        <form action="{{route('admin.hotel.list_hotels')}}" method="get">
                            <select id="country" name="country" class="btn btn-sm btn-neutral">
                                <option value="" selected disabled>Quốc gia</option>
                                @foreach($countries as $country)
                                    <option value="{{$country->id}}">{{$country->province_id_name}}</option>
                                @endforeach

                            </select>
                            <select id="province" name="province" class="btn btn-sm btn-neutral">
                                <option value="" selected disabled>Tỉnh thành</option>
                            </select>
                            <input type="submit" class="btn btn-sm btn-neutral" value="Tìm kiếm">
                        </form>
                    </div>
                    <div class="col-lg-4">
                        <form class="navbar-search navbar-search-light form-inline"
                              action="{{route('admin.hotel.search')}}" method="GET"
                              name="search"
                              id="search">
                            <div class="form-group mb-0">
                                <div class="input-group input-group-alternative input-group-merge input-group-sm">
                                    <div class="input-group-prepend input-group-sm">
                                        <span class="input-group-text"><i class="fas fa-search"></i></span>
                                    </div>
                                    <input class="form-control" name="search" placeholder="Search" type="text">
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-3 text-right">
                        <a href="{{route('admin.hotel.create')}}" class="btn btn-sm btn-neutral">Thêm mới</a>
                        <div class="dropdown">
                            <button class="btn btn-neutral btn-sm dropdown-toggle" type="button"
                                    id="dropdownMenuButton"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Action
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" data-toggle="modal" data-target="#modal">Import</a>
                                @if(isset(request()->province))
                                    <a class="dropdown-item"
                                       href="{{route('admin.hotel.export', request()->province)}}">Export</a>
                                @elseif(isset(request()->search))
                                    <a class="dropdown-item"
                                       href="{{route('admin.hotel.export', request()->search)}}">Export</a>
                                @else
                                    <a class="dropdown-item"
                                       href="{{route('admin.hotel.export', 'all')}}">Export</a>
                                @endif
                            </div>

                            <form action="{{route('admin.hotel.import')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="modal fade" id="modal" tabindex="-1" role="dialog"
                                     aria-labelledby="modalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modalLabel">Upload file</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Chọn file:
                                                <input type="file" class="custom-file-input" name="select_file"
                                                       accept=".xlsx, .xls, .csv"/>
                                                @error('file')
                                                <span class="small text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">
                                                    Đóng
                                                </button>
                                                <button type="submit" class="btn btn-primary">Upload</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
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
                                <h3 class="mb-0">Chỗ nghỉ</h3>
                            </div>
                        </div>
                    </div>
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if (session()->has('failures'))
                        @foreach (session()->get('failures') as $validation)
                            @foreach ($validation->errors() as $e)
                                <div class="alert alert-danger">
                                    {{  "Hàng ". $validation->row() . " ". $e }}
                                </div>
                            @endforeach
                        @endforeach
                    @endif

                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                            <tr>
                                <th scope="col">Tên chỗ nghỉ</th>
                                <th scope="col">Loại chỗ nghỉ</th>
                                <th scope="col">Điện thoại</th>
                                <th scope="col">Email</th>
                                <th scope="col">Website</th>
                                {{--<th scope="col">Ẩn/hiện</th>--}}
                                <th scope="col"></th>
                            </tr>
                            </thead>
                            <tbody class="list">
                            @foreach($hotels as $hotel)
                                <tr>
                                    <th scope="row">
                                        <div class="media align-items-center">
                                            <a href="{{route('admin.hotel.room', $hotel->id)}}"
                                               class="avatar rounded-circle mr-3">
                                                <img alt="Image placeholder" src="{{$hotel->hotel_image}}">
                                            </a>
                                            <div class="media-body">
                                                <a href="{{route('admin.hotel.room', $hotel->id)}}"><span
                                                            class="name mb-0 text-sm">{{$hotel->hotel_name}}</span></a>
                                            </div>
                                        </div>
                                    </th>
                                    <td>
                                        {{$hotel->category->category_name}}
                                    </td>
                                    <td>
                                        {{$hotel->hotel_phone}}
                                    </td>

                                    <td>
                                        {{$hotel->hotel_email}}
                                    </td>

                                    <td>
                                        {{$hotel->hotel_website}}
                                    </td>

                                    {{--<td>--}}
                                    {{--<label class="custom-toggle">--}}
                                    {{--<input type="checkbox" value="" checked>--}}
                                    {{--<span class="custom-toggle-slider rounded-circle" data-label-off="Ẩn" data-label-on="Hiện"></span>--}}
                                    {{--</label>--}}
                                    {{--{{$hotel->is_active}}--}}
                                    {{--</td>--}}
                                    <td class="text-right">
                                        <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                <a class="dropdown-item"
                                                   href="{{route('admin.hotel.edit', $hotel->id)}}">Edit</a>
                                                <a class="dropdown-item" data-toggle="modal"
                                                   data-target="#modal{{$hotel->id}}">Delete</a>
                                            </div>
                                        </div>

                                    </td>
                                </tr>
                                <form action="{{route('admin.hotel.destroy', $hotel->id)}}" method="post">
                                    @csrf
                                    <div class="modal fade" id="modal{{$hotel->id}}" tabindex="-1" role="dialog"
                                         aria-labelledby="modal{{$hotel->id}}Label" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="modal{{$hotel->id}}Label">Xóa khách
                                                        sạn {{$hotel->hotel_name}}</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    Bạn có chắc chắn xóa chỗ nghỉ {{$hotel->hotel_name}} ?
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
                        {{ $hotels->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script type="text/javascript">
        $('#country').change(function () {
            var country_id = $(this).val();
            if (country_id) {
                $.ajax({
                    type: "GET",
                    url: "{{route('admin.hotel.list_provinces')}}?country_id=" + country_id,
                    success: function (res) {
                        if (res) {
                            $('#province').html('');
                            $('#province').append('<option value="" selected disabled>Tỉnh thành</option>');
                            console.log(res);
                            $.each(res, function (key, value) {
                                console.log(value.province_name);
                                $('#province').append('<option value="' + value.id + '">' + value.province_name + '</option>');
                            });

                        } else {
                            $('#province').html('');
                        }
                    }
                });
            } else {
                $('#province').html('');
                $('#city').html('');
            }
        });

    </script>
@endsection
