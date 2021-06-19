<form class="login-form">
    <div class="card mb-0">
        <div class="card-body">
            <div class="text-center mb-3">
                <i class="icon-reading icon-2x text-slate-300 border-slate-300 border-3 rounded-round p-3 mb-3 mt-1"></i>
                <h5 class="mb-0">Login to your account</h5>
                <span class="d-block text-muted">Enter your credentials below</span>
            </div>

            @if (session()->has('message'))
                <div class="alert alert-success alert-rounded alert-dismissible">
                    <span class="font-weight-semibold"> {{ session('message') }}</span>
                </div>
            @endif

            @if (session()->has('error'))
                <div class="alert alert-danger alert-rounded alert-dismissible">
                    <span class="font-weight-semibold">  {{ session('error') }}</span>
                </div>
            @endif
            <div class="form-group form-group-feedback form-group-feedback-left">
                <input type="text" wire:model="sysuser_nama" class="form-control" placeholder="Username">
                @error('sysuser_nama') <label id="basic-error" class="validation-invalid-label"
                                              for="basic">{{$message}}</label>@enderror
                <div class="form-control-feedback">
                    <i class="icon-user text-muted"></i>
                </div>
            </div>

            <div class="form-group form-group-feedback form-group-feedback-left">
                <input type="password" wire:model="sysuser_passw" class="form-control" placeholder="Password">
                @error('sysuser_passw') <label id="basic-error" class="validation-invalid-label"
                                               for="basic">{{$message}}</label>@enderror
                <div class="form-control-feedback">
                    <i class="icon-lock2 text-muted"></i>
                </div>
            </div>

            <div class="form-group">
                <button class="btn btn-primary btn-block" wire:click.prevent="login">Login</button>
            </div>
        </div>
    </div>
</form>
<script type="text/javascript">
    $(function () {
        @if (session()->has('login_expired'))
        new Noty({
            layout: 'topCenter',
            text: '{!! session('login_expired') !!}',
            type: 'warning'
        }).show();

        @endif
    })
</script>
