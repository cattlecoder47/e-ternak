<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
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

    <!-- /core JS files -->

    <!-- Theme JS files -->
    <script type="text/javascript"
            src="{{ url('/') }}/template/global_assets/js/plugins/notifications/noty.min.js"></script>
    <script src="{{ url('/') }}/template/global_assets/js/demo_pages/extra_jgrowl_noty.js"></script>
    <script src="{{url('/')}}/template/layout_2/LTR/material/full/assets/js/app.js"></script>
    <!-- /theme JS files -->
    @livewireScripts
    </script>
</head>

<body>

<!-- Main navbar -->
<div class="navbar navbar-expand-md navbar-dark">
    <div class="navbar-brand">
        <a href="{{url('/')}}/login" class="d-inline-block">
            <img src="{{url('/')}}/template/global_assets/images/logo_light.png" alt="">
        </a>
    </div>

    <div class="d-md-none">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-mobile">
            <i class="icon-tree5"></i>
        </button>
    </div>


</div>
<!-- /main navbar -->


<!-- Page content -->
<div class="page-content">

    <!-- Main content -->
    <div class="content-wrapper">

        <!-- Content area -->
        <div class="content d-flex justify-content-center align-items-center">
            @livewire('auth-login')
        </div>
        <!-- /content area -->

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
