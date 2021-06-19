<div>
    <div class="page-header page-header-light">
        <div class="page-header-content header-elements-md-inline">
            <div class="page-title d-flex">
                <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Pengaturan</span> - Config
                    Aplikasi</h4>
                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>
            @include('header-elements')

        </div>

        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
            <div class="d-flex">
                <div class="breadcrumb">
                    <a href="{{url('/')}}/home" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
                    <a href="#" class="breadcrumb-item">Pengaturan</a>
                    <span class="breadcrumb-item active">Config Aplikasi</span>
                </div>

                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>


        </div>
    </div>


    <div class="content">

        <div class="card">
            <div class="card-header header-elements-inline">
                <h5 class="card-title">Config Aplikasi</h5>

            </div>

            <div class="card-body">
                <fieldset class="mb-3">
                    <legend class="text-uppercase font-size-sm font-weight-bold">Site Setting</legend>
                    @foreach ($site_items as $index=> $value)
                        <div class="form-group row">
                            <label class="col-form-label col-lg-2">{{$value->sysoption_alias}}</label>
                            <div class="col-lg-10">
                                <input type="text" value="{{$value->sysoption_value}}"
                                       class="form-control">

                            </div>
                        </div>
                    @endforeach
                </fieldset>

                <fieldset class="mb-3">
                    <legend class="text-uppercase font-size-sm font-weight-bold">App Setting</legend>
                    @foreach ($app_items as $index=> $value)
                        <div class="form-group row">
                            <label class="col-form-label col-lg-2">{{$value->sysoption_alias}}</label>
                            <div class="col-lg-10">
                                <input type="text" value="{{$value->sysoption_value}}"
                                       class="form-control">

                            </div>
                        </div>
                    @endforeach
                </fieldset>
            </div>
        </div>

    </div>

</div>
