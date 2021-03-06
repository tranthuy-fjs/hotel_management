@extends('admin.layouts.dashboard')
@section('title')
    Thêm mới quốc gia
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
    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col-xl-12 order-xl-2">
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">Thêm mới quốc gia </h3>
                            </div>
                        </div>
                    </div>
                    <form action="{{ route('admin.country.store') }}" method="post">
                        @csrf
                        <div class="card-body">
                            <h6 class="heading-small text-muted mb-4">Thông tin</h6>
                            <div class="pl-lg-4">
                                <div class="row">
                                    <div class="col-lg-3">
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="hotel_name">Tên quốc gia</label>
                                            <input type="text" id="country_name" name="country_name"
                                                   class="form-control" value="{{old('country_name')}}"
                                                   placeholder="Tên quốc gia">
                                            @error('country_name')
                                            <span class="small text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="col-lg-10 text-right">
                                <button type="submit" class="btn btn-success">Lưu</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
@section('js')
    <script src="{{ asset('/vendor/laravel-filemanager/js/stand-alone-button.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('.lfm-btn').filemanager('image', {'prefix': 'http://localhost:8080/hotel_management/public/laravel-filemanager'});
        });

    </script>

@endsection

