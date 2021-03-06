<!-- Topnav -->
<nav class="navbar navbar-top navbar-expand navbar-dark bg-primary border-bottom">
    <div class="container-fluid">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Navbar links -->
            <ul class="navbar-nav align-items-center  ml-md-auto ">
            </ul>
            <ul class="navbar-nav align-items-center  ml-auto ml-md-0 ">
                <li class="nav-item dropdown">
                    <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <div class="media align-items-center">
                  <span class="avatar avatar-sm rounded-circle">
                    <img alt="Image placeholder" src="{{isset(Auth::user()->image) ? Auth::user()->image: asset('admin_assets/img/theme/admin.jpg')}}">
                  </span>
                            <div class="media-body  ml-2  d-none d-lg-block">
                                <span class="mb-0 text-sm  font-weight-bold">{{Auth::user()->user_name}}</span>
                            </div>
                        </div>
                    </a>
                    <div class="dropdown-menu  dropdown-menu-right ">
                        <div class="dropdown-header noti-title">
                            <h6 class="text-overflow m-0">Welcome!</h6>
                        </div>
                        <a href="{{route('admin.profile')}}" class="dropdown-item">
                            <i class="ni ni-single-02"></i>
                            <span>Tài khoản</span>
                        </a>
                        <a href="{{route('admin.change_password')}}" class="dropdown-item">
                            <i class="ni ni-settings-gear-65"></i>
                            <span>Đổi mật khẩu</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="{{ route('admin.auth.logout') }}" class="dropdown-item">
                            <i class="ni ni-user-run"></i>
                            <span>Đăng xuất</span>
                            <form id="logout-form" action="{{ route('admin.auth.logout') }}" method="POST"
                                  style="display: none;">
                                @csrf
                            </form>
                        </a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>

