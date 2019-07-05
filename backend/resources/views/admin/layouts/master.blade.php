<!doctype html>
<html lang="vi">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

    <title>@yield('title') - Admin</title>

    <meta name="description"
        content="OneUI - Bootstrap 4 Admin Template &amp; UI Framework created by pixelcave and published on Themeforest">
    <meta name="author" content="pixelcave">
    <meta name="robots" content="noindex, nofollow">

    <!-- Open Graph Meta -->
    <meta property="og:title" content="OneUI - Bootstrap 4 Admin Template &amp; UI Framework">
    <meta property="og:site_name" content="OneUI">
    <meta property="og:description"
        content="OneUI - Bootstrap 4 Admin Template &amp; UI Framework created by pixelcave and published on Themeforest">
    <meta property="og:type" content="website">
    <meta property="og:url" content="">
    <meta property="og:image" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Icons -->
    <!-- The following icons can be replaced with your own, they are used by desktop and mobile browsers -->
    <link rel="shortcut icon" href="{{asset('assets/media/favicons/favicon.png')}}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{asset('assets/media/favicons/favicon-192x192.png')}}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('assets/media/favicons/apple-touch-icon-180x180.png')}}">
    <!-- END Icons -->

    <!-- Stylesheets -->
    <!-- Fonts and OneUI framework -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400italic,600,700%7COpen+Sans:300,400,400italic,600,700">
    <link rel="stylesheet" id="css-main" href="{{asset('assets/css/oneui.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/jquery-ui.min.css')}}">
    <link rel="stylesheet" href="/css/app.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />

</head>

<body>

    <div id="app" class="sidebar-o sidebar-dark enable-page-overlay side-scroll page-header-fixed">

        <!-- Sidebar -->
        <!--
                Sidebar Mini Mode - Display Helper classes

                Adding 'smini-hide' class to an element will make it invisible (opacity: 0) when the sidebar is in mini mode
                Adding 'smini-show' class to an element will make it visible (opacity: 1) when the sidebar is in mini mode
                    If you would like to disable the transition animation, make sure to also add the 'no-transition' class to your element

                Adding 'smini-hidden' to an element will hide it when the sidebar is in mini mode
                Adding 'smini-visible' to an element will show it (display: inline-block) only when the sidebar is in mini mode
                Adding 'smini-visible-block' to an element will show it (display: block) only when the sidebar is in mini mode
            -->
        <nav id="sidebar" aria-label="Main Navigation">
            <!-- Side Header -->
            <div class="content-header bg-white-5">
                <!-- Logo -->
                <a class="font-w600 text-dual" href="{{asset('admin/home')}}">
                    <i class="fa fa-circle-notch text-primary"></i>
                    <span class="smini-hide">
                        <span class="font-w700 font-size-h5">Team</span> <span class="font-w400">14</span>
                    </span>
                </a>
                <!-- END Logo -->

                <!-- Options -->
                <div>
                    <!-- Color Variations -->
                    <div class="dropdown d-inline-block ml-3">
                        <a class="text-dual font-size-sm" id="sidebar-themes-dropdown" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false" href="#">
                            <i class="si si-drop"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right font-size-sm smini-hide border-0"
                            aria-labelledby="sidebar-themes-dropdown">
                            <!-- Color Themes -->
                            <!-- Layout API, functionality initialized in Template._uiHandleTheme() -->
                            <a class="dropdown-item d-flex align-items-center justify-content-between"
                                data-toggle="theme" data-theme="default" href="#">
                                <span>Default</span>
                                <i class="fa fa-circle text-default"></i>
                            </a>
                            <a class="dropdown-item d-flex align-items-center justify-content-between"
                                data-toggle="theme"
                                data-theme="{{asset('public/admin')}}/assets/css/themes/amethyst.min.css" href="#">
                                <span>Amethyst</span>
                                <i class="fa fa-circle text-amethyst"></i>
                            </a>
                            <a class="dropdown-item d-flex align-items-center justify-content-between"
                                data-toggle="theme"
                                data-theme="{{asset('public/admin')}}/assets/css/themes/city.min.css" href="#">
                                <span>City</span>
                                <i class="fa fa-circle text-city"></i>
                            </a>
                            <a class="dropdown-item d-flex align-items-center justify-content-between"
                                data-toggle="theme"
                                data-theme="{{asset('public/admin')}}/assets/css/themes/flat.min.css" href="#">
                                <span>Flat</span>
                                <i class="fa fa-circle text-flat"></i>
                            </a>
                            <a class="dropdown-item d-flex align-items-center justify-content-between"
                                data-toggle="theme"
                                data-theme="{{asset('public/admin')}}/assets/css/themes/modern.min.css" href="#">
                                <span>Modern</span>
                                <i class="fa fa-circle text-modern"></i>
                            </a>
                            <a class="dropdown-item d-flex align-items-center justify-content-between"
                                data-toggle="theme"
                                data-theme="{{asset('public/admin')}}/assets/css/themes/smooth.min.css" href="#">
                                <span>Smooth</span>
                                <i class="fa fa-circle text-smooth"></i>
                            </a>
                            <!-- END Color Themes -->

                            <div class="dropdown-divider"></div>

                            <!-- Sidebar Styles -->
                            <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                            <a class="dropdown-item" data-toggle="layout" data-action="sidebar_style_light" href="#">
                                <span>Sidebar Light</span>
                            </a>
                            <a class="dropdown-item" data-toggle="layout" data-action="sidebar_style_dark" href="#">
                                <span>Sidebar Dark</span>
                            </a>
                            <!-- Sidebar Styles -->

                            <div class="dropdown-divider"></div>

                            <!-- Header Styles -->
                            <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                            <a class="dropdown-item" data-toggle="layout" data-action="header_style_light" href="#">
                                <span>Header Light</span>
                            </a>
                            <a class="dropdown-item" data-toggle="layout" data-action="header_style_dark" href="#">
                                <span>Header Dark</span>
                            </a>
                            <!-- Header Styles -->
                        </div>
                    </div>
                    <!-- END Themes -->

                    <!-- Close Sidebar, Visible only on mobile screens -->
                    <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                    <a class="d-lg-none text-dual ml-3" data-toggle="layout" data-action="sidebar_close"
                        href="javascript:void(0)">
                        <i class="fa fa-times"></i>
                    </a>
                    <!-- END Close Sidebar -->
                </div>
                <!-- END Options -->
            </div>
            <!-- END Side Header -->

            <!-- Side Navigation -->
            <div class="content-side content-side-full">
                <ul class="nav-main">
                    <li class="nav-main-item">
                        <router-link to="/admin/dashboard" class="nav-main-link">
                            <i class="nav-main-link-icon si si-speedometer"></i>
                            <span class="nav-main-link-name">Bảng điều khiển</span>
                        </router-link>
                    </li>
                    <li class="nav-main-heading">Quản trị</li>
                    <li class="nav-main-item">
                        <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true"
                            aria-expanded="false" href="#">
                            <i class="nav-main-link-icon si si-energy"></i>
                            <span class="nav-main-link-name">Quản lý</span>
                        </a>
                        <ul class="nav-main-submenu">
                            <li class="nav-main-item">
                                <router-link to="/admin/category" class="nav-main-link">
                                    <span class="nav-main-link-name">Danh mục</span>
                                </router-link>
                            </li>
                            <li class="nav-main-item">
                                <router-link to="/admin/location" class="nav-main-link">
                                    <span class="nav-main-link-name">Địa điểm</span>
                                </router-link>
                            </li>
                            <li class="nav-main-item">
                                <router-link to="/admin/tourist-route" class="nav-main-link">
                                    <span class="nav-main-link-name">Tuyến du lịch</span>
                                </router-link>
                            </li>
                            <li class="nav-main-item">
                                <router-link to="/admin/tour" class="nav-main-link">
                                    <span class="nav-main-link-name">Chuyến du lịch</span>
                                </router-link>
                            </li>
                            <li class="nav-main-item">
                                <router-link to="/admin/user-client" class="nav-main-link">
                                    <span class="nav-main-link-name">Khách hàng</span>
                                </router-link>
                            </li>
                            <li class="nav-main-item">
                                <router-link to="/admin/reviews" class="nav-main-link">
                                    <span class="nav-main-link-name">Nhận xét khách hàng</span>
                                </router-link>
                            </li>
                            <li class="nav-main-item">
                                <router-link to="/admin/promotion" class="nav-main-link">
                                    <span class="nav-main-link-name">Khuyến mãi</span>
                                </router-link>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-main-item">
                        <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true"
                            aria-expanded="false" href="#">
                            <i class="nav-main-link-icon si si-chart"></i>
                            <span class="nav-main-link-name">Báo cáo</span>
                        </a>
                        <ul class="nav-main-submenu">
                            <li class="nav-main-item">
                                <a class="nav-main-link" href="be_pages_error_all.html">
                                    <span class="nav-main-link-name">Doanh thu</span>
                                </a>
                            </li>
                            <li class="nav-main-item">
                                <a class="nav-main-link" href="op_error_400.html">
                                    <span class="nav-main-link-name">Sản phẩm</span>
                                </a>
                            </li>
                            <li class="nav-main-item">
                                <a class="nav-main-link" href="op_error_401.html">
                                    <span class="nav-main-link-name">Hoa hồng</span>
                                </a>
                            </li>
                            <li class="nav-main-item">
                                <a class="nav-main-link" href="op_error_403.html">
                                    <span class="nav-main-link-name">Lương nhân viên</span>
                                </a>
                            </li>
                            <li class="nav-main-item">
                                <a class="nav-main-link" href="op_error_404.html">
                                    <span class="nav-main-link-name">Ai đang online</span>
                                </a>
                            </li>
                            <li class="nav-main-item">
                                <a class="nav-main-link" href="op_error_404.html">
                                    <span class="nav-main-link-name">Trạng thái</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-main-heading">Nhân viên</li>
                    <li class="nav-main-item">
                        <router-link to="/admin/booking-tour" class="nav-main-link">
                            <i class="nav-main-link-icon si si-credit-card"></i>
                            <span class="nav-main-link-name">Đặt tour</span>
                        </router-link>
                    </li>
                    <li class="nav-main-item">
                        <router-link to="/admin/news" class="nav-main-link">
                            <i class="nav-main-link-icon si si-note"></i>
                            <span class="nav-main-link-name">Tin tức</span>
                        </router-link>
                    </li>

                    <li class="nav-main-heading">Cài đặt</li>
                    <li class="nav-main-item">
                        <div class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true"
                            aria-expanded="false">
                            <i class="nav-main-link-icon si si-wrench"></i>
                            <span class="nav-main-link-name">Hệ thống</span>
                        </div>
                        <ul class="nav-main-submenu">
                            <li class="nav-main-item">
                                <router-link to="/admin/developer" class="nav-main-link">
                                    <span class="nav-main-link-name">Developer</span>
                                </router-link>
                            </li>
                            <li class="nav-main-item">
                                <router-link to="/admin/users" class="nav-main-link">
                                    <span class="nav-main-link-name">Người dùng</span>
                                </router-link>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-main-item">
                        <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true"
                            aria-expanded="false" href="#">
                            <i class="nav-main-link-icon si si-lock"></i>
                            <span class="nav-main-link-name">Bảo trì</span>
                        </a>
                        <ul class="nav-main-submenu">
                            <li class="nav-main-item">
                                <a class="nav-main-link" href="be_pages_auth_all.html">
                                    <span class="nav-main-link-name">Sao lưu/phục hồi</span>
                                </a>
                            </li>
                            <li class="nav-main-item">
                                <a class="nav-main-link" href="op_auth_signin.html">
                                    <span class="nav-main-link-name">Tải lên</span>
                                </a>
                            </li>
                            <li class="nav-main-item">
                                <a class="nav-main-link" href="op_auth_signin2.html">
                                    <span class="nav-main-link-name">Nhật kí lỗi</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
            <!-- END Side Navigation -->
        </nav>
        <!-- END Sidebar -->

        <!-- Header -->
        @include('admin.layouts.header')
        <!-- END Header -->

        <!-- for example router view -->
        <router-view></router-view>
        <!-- set progressbar -->
        <vue-progress-bar></vue-progress-bar>

        <!-- Footer -->
        @include('admin.layouts.footer')
        <!-- END Footer -->

        <!-- Apps Modal -->
        <!-- Opens from the modal toggle button in the header -->
        <div class="modal fade" id="one-modal-apps" tabindex="-1" role="dialog" aria-labelledby="one-modal-apps"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-top modal-sm" role="document">
                <div class="modal-content">
                    <div class="block block-themed block-transparent mb-0">
                        <div class="block-header bg-primary-dark">
                            <h3 class="block-title">Apps</h3>
                            <div class="block-options">
                                <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                    <i class="si si-close"></i>
                                </button>
                            </div>
                        </div>
                        <div class="block-content block-content-full">
                            <div class="row gutters-tiny">
                                <div class="col-6">
                                    <!-- CRM -->
                                    <a class="block block-rounded block-themed bg-default" href="javascript:void(0)">
                                        <div class="block-content text-center">
                                            <i class="si si-speedometer fa-2x text-white-75"></i>
                                            <p class="font-w600 font-size-sm text-white mt-2 mb-3">
                                                CRM
                                            </p>
                                        </div>
                                    </a>
                                    <!-- END CRM -->
                                </div>
                                <div class="col-6">
                                    <!-- Products -->
                                    <a class="block block-rounded block-themed bg-danger" href="javascript:void(0)">
                                        <div class="block-content text-center">
                                            <i class="si si-rocket fa-2x text-white-75"></i>
                                            <p class="font-w600 font-size-sm text-white mt-2 mb-3">
                                                Products
                                            </p>
                                        </div>
                                    </a>
                                    <!-- END Products -->
                                </div>
                                <div class="col-6">
                                    <!-- Sales -->
                                    <a class="block block-rounded block-themed bg-success mb-0"
                                        href="javascript:void(0)">
                                        <div class="block-content text-center">
                                            <i class="si si-plane fa-2x text-white-75"></i>
                                            <p class="font-w600 font-size-sm text-white mt-2 mb-3">
                                                Sales
                                            </p>
                                        </div>
                                    </a>
                                    <!-- END Sales -->
                                </div>
                                <div class="col-6">
                                    <!-- Payments -->
                                    <a class="block block-rounded block-themed bg-warning mb-0"
                                        href="javascript:void(0)">
                                        <div class="block-content text-center">
                                            <i class="si si-wallet fa-2x text-white-75"></i>
                                            <p class="font-w600 font-size-sm text-white mt-2 mb-3">
                                                Payments
                                            </p>
                                        </div>
                                    </a>
                                    <!-- END Payments -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END Apps Modal -->
        <div class="modal fade bd-example-modal-sm" id="progressModal" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-sm modal-dialog-centered" role="status">
                <div class="modal-content">
                    <div class="row">
                        <div class="col-12 d-flex justify-content-center">
                            <i class="fa fa-10x fa-cog fa-spin text-warning"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @auth
    <script>
        window.user = @json(auth() -> user());
        window.host = '{{url('/')}}'
    </script>
    @endauth
    @include('ckfinder::setup')
    <script src="/js/app.js"></script>
    <script src="{{asset('assets/js/oneui.core.min.js')}}"></script>
    <script src="{{asset('assets/js/oneui.app.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/jquery-bootstrap-wizard/bs4/jquery.bootstrap.wizard.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
    <script src="{{asset('assets/js/plugins/jquery-validation/jquery.validate.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/jquery-validation/additional-methods.js')}}"></script>
    <!-- Page JS Code -->
    <script src="{{asset('assets/js/pages/be_forms_wizard.min.js')}}"></script>
    <script src="{{asset('assets/js/pages/be_ui_progress.min.js')}}"></script>
    <script src="{{asset('/js/ckfinder/ckfinder.js')}}"></script>
    {{-- <script>CKFinder.config( { connectorPath: '/ckfinder/connector' } );</script> --}}
</body>

</html>