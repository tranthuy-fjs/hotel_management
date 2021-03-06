@extends('admin.layouts.dashboard')
@section('title')
    Chỉnh sửa thông tin chỗ nghỉ
@endsection
@section('content')
    <!-- Header -->
    <div class="header bg-primary pb-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4">
                </div>
                <!-- Card stats -->
                <span class="mask bg-gradient-default opacity-8"></span>
                <!-- Header container -->
                <div class="container-fluid d-flex align-items-center">
                </div>
            </div>
        </div>
    </div>
    <!-- Page content -->
    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col-xl-12 order-xl-2">
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">Chỉnh sửa thông tin chỗ nghỉ {{$hotel->hotel_name}} </h3>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('admin.hotel.update', $hotel->id) }}" method="post">
                            @csrf
                            <h6 class="heading-small text-muted mb-4">Thông tin</h6>
                            <div class="pl-lg-4">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <input type="text" id="province_id" name="province_id" class="form-control"
                                                   placeholder="Hotel name" value="{{$hotel->province_id}}" hidden>
                                            <label class="form-control-label" for="category_id">Loại chỗ
                                                nghỉ*</label><br>
                                            <select id="category_id" name="category_id"
                                                    class="form-control btn-sm btn-neutral">
                                                <option value="{{$hotel->category->id}}"
                                                        selected>{{$hotel->category->category_name}}</option>
                                                @foreach($categories as $category)
                                                    @if($hotel->category->id !== $category->id)
                                                        <option value="{{$category->id}}">{{$category->category_name}}</option>
                                                    @endif
                                                @endforeach

                                            </select>
                                            @error('category_id')
                                            <span class="small text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="hotel_name">Tên chỗ nghỉ*</label>
                                            <input type="text" id="hotel_name" name="hotel_name" class="form-control"
                                                   placeholder="Nhập tên chỗ nghỉ" value="{{$hotel->hotel_name}}">
                                            @error('hotel_name')
                                            <<span class="small text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="hotel_phone">Điện thoại*</label>
                                            <input type="text" id="hotel_phone" name="hotel_phone" class="form-control"
                                                   placeholder="Nhập số điện thoại" pattern="09|03|07|08|05)+([0-9]{8}"
                                                   value="{{$hotel->hotel_phone}}">
                                            @error('hotel_phone')
                                            <span class="small text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="hotel_email">Email*</label>
                                            <input type="text" id="hotel_email" name="hotel_email" class="form-control"
                                                   placeholder="Nhập email" value="{{$hotel->hotel_email}}">
                                            @error('hotel_email')
                                            <span class="small text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="hotel_website">Website</label>
                                            <input type="text" id="hotel_website" name="hotel_website"
                                                   class="form-control" placeholder="Nhập tên website"
                                                   value="{{$hotel->hotel_website}}">
                                            @error('hotel_website')
                                            <span class="small text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-control-label" for="hotel_image">Ảnh</label>
                                            <div style="margin: 10px 0px">
                                                <span class="input-group-btn">
                                                 <a id="lfm" data-input="thumbnail" data-preview="holder"
                                                    class="btn btn-neutral lfm-btn">
                                                   <i class="fa fa-picture-o"></i> Choose
                                                 </a>
                                               </span>
                                            </div>
                                            <input id="thumbnail" class="form-control" type="text" value="{{$hotel->hotel_image}}"
                                                   name="hotel_image">
                                            @error('hotel_image')
                                            <span class="small text-danger">{{ $message }}</span>
                                            @enderror
                                            <img id="holder" src="{{asset($hotel->hotel_image)}}"
                                                 style="margin-top:15px;max-height:150px;max-width:150px">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-control-label" for="description">Mô tả</label>
                                            <textarea id="description" name="description" class="form-control mytinymce"
                                                      rows="4" cols="50">
                                            {{$hotel->description}}
                                            </textarea>
                                            @error('description')
                                            <span class="small text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 text-right">
                                <button type="submit" class="btn btn-success">Lưu</button>
                            </div>
                        </form>
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
                            $('#province').append('<option value="" selected disabled>Tỉnh/Thành phố</option>');
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

    <script src="{{ asset('/vendor/laravel-filemanager/js/stand-alone-button.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('.lfm-btn').filemanager('image', {'prefix': 'http://localhost:8080/hotel_management/public/laravel-filemanager'});


            $('#plus-image').on('click', function (e) {
                e.preventDefault();

                var lfm_count = parseInt($('.lfm-btn').length);
                var next = lfm_count + 1;

                var html = '';

                for (var i = 0; i < 1000; i++) {

                    if ($('#lfm' + next).length < 1) {

                        html += '<div class="form-group">\n' +
                            '                    <label for="room_image" class="form-control-label">Ảnh </label>\n' +
                            '                    <div style="margin: 10px 0px">\n' +
                            '                        <span class="input-group-btn">\n' +
                            '                         <a id="lfm' + next + '" data-input="thumbnail' + next + '" data-preview="holder' + next + '" class="lfm-btn btn btn-neutral">\n' +
                            '                           <i class="fa fa-picture-o"></i> Chọn\n' +
                            '                         </a>\n' +
                            '                            <a class="remove-image btn btn-warning ">\n' +
                            '                           <i class="fa fa-remove"></i> Xóa\n' +
                            '                         </a>\n' +
                            '                       </span>\n' +
                            '                     </div>\n' +
                            '                     <input id="thumbnail' + next + '" type="text" name="hotel_image" value="" class="form-control" placeholder="">\n' +
                            '                     <img id="holder' + next + '" style="margin-top:15px;max-height:100px;">\n' +
                            '                </div>';


                        break;
                    } else {
                        next++;
                    }


                }

                var box = $(this).closest('.form-group');

                $(html).insertBefore(box);

                $('.lfm-btn').filemanager('image', {'prefix': 'http://localhost:8080/hotel_management/public/laravel-filemanager'});

            });


            $('body').on('click', '.remove-image', function (e) {
                console.log(e);
                e.preventDefault();
                $(this).closest('.form-group').remove();

            });

            // function readURL(input) {
            //     if (input.files && input.files[0]) {
            //         var reader = new FileReader();
            //
            //         reader.onload = function(e) {
            //             $('#holder').attr('src', e.target.result);
            //         }
            //
            //         reader.readAsDataURL(input.files[0]); // convert to base64 string
            //     }
            // }
            //
            // $("#hotel_image").change(function() {
            //     readURL(this);
            // });

        });

    </script>

@endsection
