<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion" style="background-color: darkcyan;">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading text-light">QUẢN LÝ CHUNG</div>
                <a id="text-color" class="nav-link {{Request::routeIs('admin.dashboard')?'active':''}} fw-bold" href="{{ route('admin.dashboard') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    THỐNG KÊ
                </a>
                {{-- <div class="sb-sidenav-menu-heading text-light">CÀI ĐẶT</div> --}}
                <!-- QUẢN LÝ PRODUCT -->
                <div class="sb-sidenav-menu-heading text-light">QUẢN LÝ TÀI KHOẢN</div>
                <!-- menu thuong hieu (brand) -->
                <a id="text-color" class="nav-link {{ Request::routeIs('user.index')? 'collapse active':'collapsed' }} fw-bold" href="#" data-bs-toggle="collapse" data-bs-target="#collapseUser" aria-expanded="false" aria-controls="collapseLayouts">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-tag"></i></div>
                    KHÁCH HÀNG
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse {{ Request::routeIs('user.index')? 'show':'' }}" id="collapseUser" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link {{Request::routeIs('user.index')?'active':''}}" href="{{ route('user.index') }}">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-clipboard-list text-white"></i></div>
                            Xem danh sách
                        </a>
                    </nav>
                </div>
                <!-- QUẢN LÝ PRODUCT -->
                <div class="sb-sidenav-menu-heading text-light">QUẢN LÝ STORE</div>
                <!-- menu thuong hieu (brand) -->
                <a id="text-color" class="nav-link {{ in_array(Route::currentRouteName(), $productRoutes) ? 'collapse active':'collapsed' }} fw-bold" href="#" data-bs-toggle="collapse" data-bs-target="#collapseProduct" aria-expanded="false" aria-controls="collapseLayouts">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-tag"></i></div>
                    SẢN PHẨM
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse {{ in_array(Route::currentRouteName(), $productRoutes) ? 'show':'' }}" id="collapseProduct" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link {{Request::routeIs('brand.index')?'active':''}}" href="{{ route('brand.index') }}">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-clipboard-list text-white"></i></div>
                            Thương hiệu
                        </a>
                        <a class="nav-link {{Request::routeIs('category.index')||Request::routeIs('category.create')?'active':''}}" href="{{ route('category.index') }}">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-circle-plus text-white"></i></div>
                            Danh mục
                        </a>
                        <a class="nav-link {{Request::routeIs('attribute.index')||Request::routeIs('attribute.create')?'active':''}}" href="{{ route('attribute.index') }}">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-circle-plus text-white"></i></div>
                            Thông số kỹ thuật
                        </a>
                        <a class="nav-link {{Request::routeIs('product.index')||Request::routeIs('product.create')?'active':''}}" href="{{ route('product.index') }}">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-circle-plus text-white"></i></div>
                            Sản phẩm
                        </a>
                    </nav>
                </div>
            </div>
        </div>
    </nav>
</div>