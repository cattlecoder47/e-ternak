<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{getOption('site_title')}}</title>
    <link rel="shortcut icon" href="{{url('/')}}/template/global_assets/images/favicon.ico" type="image/x-icon">
    <link rel="icon" href="{{url('/')}}/template/global_assets/images/favicon.ico" type="image/x-icon">

    <!-- Global stylesheets -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet"
          type="text/css">
    <link href="{{url('/')}}/template/global_assets/css/icons/icomoon/styles.min.css" rel="stylesheet" type="text/css">
    <link href="{{url('/')}}/template/layout_2/LTR/material/full/assets/css/bootstrap.min.css" rel="stylesheet"
          type="text/css">
    <link href="{{url('/')}}/template/layout_2/LTR/material/full/assets/css/bootstrap_limitless.min.css"
          rel="stylesheet" type="text/css">
    <link href="{{url('/')}}/template/layout_2/LTR/material/full/assets/css/layout.min.css" rel="stylesheet"
          type="text/css">
    <link href="{{url('/')}}/template/layout_2/LTR/material/full/assets/css/components.min.css" rel="stylesheet"
          type="text/css">
    <link href="{{url('/')}}/template/layout_2/LTR/material/full/assets/css/colors.min.css" rel="stylesheet"
          type="text/css">
    @livewireStyles
    <!-- /global stylesheets -->

    <!-- Core JS files -->
    <script src="{{url('/')}}/template/global_assets/js/main/jquery.min.js"></script>
    <script src="{{url('/')}}/template/global_assets/js/main/bootstrap.bundle.min.js"></script>
    <script src="{{url('/')}}/template/global_assets/js/plugins/loaders/blockui.min.js"></script>
    <script src="{{url('/')}}/template/global_assets/js/plugins/ui/ripple.min.js"></script>
    <!-- /core JS files -->

    <!-- Theme JS files -->
    <script src="{{url('/')}}/template/global_assets/js/plugins/visualization/d3/d3.min.js"></script>
    <script src="{{url('/')}}/template/global_assets/js/plugins/visualization/d3/d3_tooltip.js"></script>
    <script src="{{url('/')}}/template/global_assets/js/plugins/forms/styling/switchery.min.js"></script>
    <script src="{{url('/')}}/template/global_assets/js/plugins/ui/moment/moment.min.js"></script>
    <script src="{{url('/')}}/template/global_assets/js/plugins/pickers/daterangepicker.js"></script>
    <script src="{{url('/')}}/template/global_assets/js/plugins/tables/datatables/datatables.min.js"></script>
    <script src="{{url('/')}}/template/global_assets/js/plugins/forms/selects/select2.min.js"></script>
    <script src="{{url('/')}}/template/global_assets/js/plugins/forms/inputs/autoNumeric.min.js"></script>
    <script src="{{url('/')}}/template/global_assets/js/plugins/notifications/bootbox.min.js"></script>
    <script src="{{url('/')}}/template/global_assets/js/plugins/notifications/sweet_alert.min.js"></script>
    <script src="{{url('/')}}/template/global_assets/js/plugins/pickers/daterangepicker.js"></script>
    <script src="{{url('/')}}/template/global_assets/js/plugins/pickers/anytime.min.js"></script>
    <script src="{{url('/')}}/template/global_assets/js/plugins/pickers/pickadate/picker.js"></script>
    <script src="{{url('/')}}/template/global_assets/js/plugins/pickers/pickadate/picker.date.js"></script>
    <script src="{{url('/')}}/template/global_assets/js/plugins/pickers/pickadate/picker.time.js"></script>
    <script src="{{url('/')}}/template/global_assets/js/plugins/pickers/pickadate/legacy.js"></script>
    <script src="{{url('/')}}/template/global_assets/js/plugins/media/fancybox.min.js"></script>

    <script src="{{url('/')}}/template/layout_2/LTR/material/full/assets/js/app.js"></script>

    <!-- /theme JS files -->
    @livewireScripts

</head>

<body>

<!-- Main navbar -->
<div class="navbar navbar-expand-md navbar-light navbar-static">

    <!-- Header with logos -->
    <div class="navbar-header navbar-dark d-none d-md-flex align-items-md-center">
        <div class="navbar-brand navbar-brand-md">
            <a href="{{url('/')}}/home" class="d-inline-block">
                <img src="{{url('/')}}/template/global_assets/images/logo_light.png" alt="">
            </a>
        </div>

        <div class="navbar-brand navbar-brand-xs">
            <a href="index.html" class="d-inline-block">
                <img src="{{url('/')}}/template/global_assets/images/logo_icon_light.png" alt="">
            </a>
        </div>
    </div>
    <!-- /header with logos -->


    <!-- Mobile controls -->
    <div class="d-flex flex-1 d-md-none">
        <div class="navbar-brand mr-auto">
            <a href="index.html" class="d-inline-block">
                <img src="{{url('/')}}/template/global_assets/images/logo_dark.png" alt="">
            </a>
        </div>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-mobile">
            <i class="icon-tree5"></i>
        </button>

        <button class="navbar-toggler sidebar-mobile-main-toggle" type="button">
            <i class="icon-paragraph-justify3"></i>
        </button>
    </div>
    <!-- /mobile controls -->


    <!-- Navbar content -->
    <div class="collapse navbar-collapse" id="navbar-mobile">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a href="#" class="navbar-nav-link sidebar-control sidebar-main-toggle d-none d-md-block">
                    <i class="icon-paragraph-justify3"></i>
                </a>
            </li>
        </ul>

        <span class="badge bg-pink-400 badge-pill ml-md-3 mr-md-auto">Online</span>

        <ul class="navbar-nav">


            <li class="nav-item dropdown dropdown-user">
                <a href="#" class="navbar-nav-link d-flex align-items-center dropdown-toggle" data-toggle="dropdown">
                    <img src="{{url('/')}}/template/global_assets/images/placeholders/placeholder.jpg"
                         class="rounded-circle mr-2" height="34" alt="">
                    <span>{{\App\Helpers\Utility::getSession('sysuser_nama')}}</span>
                </a>

                <div class="dropdown-menu dropdown-menu-right">
                    <a href="#" class="dropdown-item"><i class="icon-user-plus"></i> My profile</a>
                    <a href="#" class="dropdown-item"><i class="icon-coins"></i> My balance</a>
                    <a href="#" class="dropdown-item"><i class="icon-comment-discussion"></i> Messages <span
                            class="badge badge-pill bg-indigo-400 ml-auto">58</span></a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item"><i class="icon-cog5"></i> Account settings</a>
                    <a href="{{url('/')}}/logout" class="dropdown-item"><i class="icon-switch2"></i> Logout</a>
                </div>
            </li>
        </ul>
    </div>
    <!-- /navbar content -->

</div>
<!-- /main navbar -->


<!-- Page content -->
<div class="page-content">

    <!-- Main sidebar -->
    <div class="sidebar sidebar-dark sidebar-main sidebar-expand-md">

        <!-- Sidebar mobile toggler -->
        <div class="sidebar-mobile-toggler text-center">
            <a href="#" class="sidebar-mobile-main-toggle">
                <i class="icon-arrow-left8"></i>
            </a>
            Navigation
            <a href="#" class="sidebar-mobile-expand">
                <i class="icon-screen-full"></i>
                <i class="icon-screen-normal"></i>
            </a>
        </div>
        <!-- /sidebar mobile toggler -->


        <!-- Sidebar content -->
        <div class="sidebar-content">

            <!-- User menu -->
            <div class="sidebar-user-material">
                <div class="sidebar-user-material-body">
                    <div class="card-body text-center">
                        <a href="#">
                            <img src="{{url('/')}}/template/global_assets/images/placeholders/placeholder.jpg"
                                 class="img-fluid rounded-circle shadow-1 mb-3" width="80" height="80" alt="">
                        </a>
                        <h6 class="mb-0 text-white text-shadow-dark">{{\App\Helpers\Utility::getSession('sysuser_namalengkap')}}</h6>
                        <span
                            class="font-size-sm text-white text-shadow-dark">{{\App\Helpers\Utility::getSession('sysrole_nama')}}</span>
                    </div>

                    <div class="sidebar-user-material-footer">
                        <a href="#user-nav"
                           class="d-flex justify-content-between align-items-center text-shadow-dark dropdown-toggle"
                           data-toggle="collapse"><span>My account</span></a>
                    </div>
                </div>

                <div class="collapse" id="user-nav">
                    <ul class="nav nav-sidebar">
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="icon-user-plus"></i>
                                <span>My profile</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="icon-coins"></i>
                                <span>My balance</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="icon-comment-discussion"></i>
                                <span>Messages</span>
                                <span class="badge bg-success-400 badge-pill align-self-center ml-auto">58</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="icon-cog5"></i>
                                <span>Account settings</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="icon-switch2"></i>
                                <span>Logout</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- /user menu -->


            <!-- Main navigation -->
            <div class="card card-sidebar-mobile">
                <ul class="nav nav-sidebar" data-nav-type="accordion">
                    <!-- Main -->
                    <li class="nav-item-header">
                        <div class="text-uppercase font-size-xs line-height-xs">Main</div>
                        <i class="icon-menu" title="Main"></i></li>
                {{\App\Helpers\Utility::sideBarMenu($navMenu)}}
                <!-- /main -->


                </ul>
            </div>
            <!-- /main navigation -->

        </div>
        <!-- /sidebar content -->

    </div>
    <!-- /main sidebar -->


    <!-- Main content -->
    <div class="content-wrapper">
    {{$slot}}
    <!-- Footer -->
        <div class="navbar navbar-expand-lg navbar-light">
            <div class="text-center d-lg-none w-100">
                <button type="button" class="navbar-toggler dropdown-toggle" data-toggle="collapse"
                        data-target="#navbar-footer">
                    <i class="icon-unfold mr-2"></i>
                    Footer
                </button>
            </div>

            <div class="navbar-collapse collapse" id="navbar-footer">
					<span class="navbar-text">
						&copy; 2021. {{getOption('copyright')}}
					</span>

            </div>
        </div>
        <!-- /footer -->

    </div>
    <!-- /main content -->

</div>
<!-- /page content -->

</body>
</html>
