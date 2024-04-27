<nav class="sb-topnav navbar navbar-expand navbar-dark" style="background: #008080;">
    <!-- Navbar Brand-->
    <a class="navbar-brand ps-3" href="" target="_blank">
        <img alt="" src="{{ asset('assets/images/logos/logo.png') }}" width="180px" height="30px" style="object-fit: contain;">
    </a>
    <!-- Sidebar Toggle-->
    <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0 text-white" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
    <!-- Navbar Search-->
    <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
        <div class="input-group">
            <!-- <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
            <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button> -->
        </div>
    </form>
    <!-- Navbar-->
    <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle d-inline-block d-sm-none text-white" href="#" data-bs-toggle="dropdown">
                <img src="{{ Auth::guard('admin')->user()->avatar==null ? 
                asset('assets/images/logos/admin-panel.png') 
                : asset('storage/uploads/Admin_image/'.Auth::guard('admin')->user()->avatar) }}" class="rounded-circle bg-white border border-white" height="30" alt="" loading="lazy" />
                 {{Auth::guard('admin')->user()->name }}
            </a>

            <a class="nav-link dropdown-toggle d-none d-sm-inline-block show text-white fw-bold" href="#" data-bs-toggle="dropdown" aria-expanded="true">
                <img src="{{ Auth::guard('admin')->user()->avatar==null ? 
                asset('assets/images/logos/admin-panel.png') 
                : asset('storage/uploads/Admin_image/'.Auth::guard('admin')->user()->avatar) }}" class="rounded-circle bg-white border border-white" height="30" alt="" loading="lazy" />
                {{Auth::guard('admin')->user()->name }}
            </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink" style="min-width: 19rem;">
                <li>
                    <div class="px-3 pt-3 d-flex">
                        <img src="{{ Auth::guard('admin')->user()->avatar==null ? 
                        asset('assets/images/logos/admin-panel.png') 
                        : asset('storage/uploads/Admin_image/'.Auth::guard('admin')->user()->avatar) }}" class="rounded-circle me-3  bg-white border border-white" height="40" alt="" loading="lazy" />
                        <div>
                            <h6 class="mb-0 fw-bold" style="color: darkcyan;">{{Auth::guard('admin')->user()->name }}</h6>
                            <p class="mb-2 text-secondary">{{Auth::guard('admin')->user()->email }}</p>
                            <a class="mb-0 text-primary" href=""><i class="fa-solid fa-address-book me-1"></i>Thông tin cá nhân</a>
                        </div>
                    </div>
                </li>
                <hr class="my-2">
                <li>
                    <a class="dropdown-item" href="">
                        <i class="fa-solid fa-unlock me-2"></i>
                        <span>Đổi mật khẩu</span>
                    </a>
                </li>
                <hr class="my-2">
                <li class="mb-1">
                    <a class="dropdown-item text-danger" href="{{route('admin.logout')}}" onclick="return confirm('Bạn chắc chắn đăng xuất chứ?')">
                        <i class="fas fa-sign-out-alt me-2"></i>
                        <span>Đăng xuất</span>
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</nav>