<div>
    <div class="page-header page-header-light">
        <div class="page-header-content header-elements-md-inline">
            <div class="page-title d-flex">
                <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Master</span> - Insentif
                </h4>
                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>
            @include('header-elements')

        </div>

        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
            <div class="d-flex">
                <div class="breadcrumb">
                    <a href="{{url('/')}}/home" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
                    <a href="#" class="breadcrumb-item">Master</a>
                    <span class="breadcrumb-item active">Insentif</span>
                </div>

                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>

        </div>
    </div>
    <div class="content">
        <div class="card">
            <div class="card-body">
                <h5 class="mb-3">Filter Insentif</h5>

                <div class="input-group mb-3">
                    <div class="form-group-feedback form-group-feedback-left" wire:ignore>
                        <select class="form-control" id="rjinsentif_kode">
                            <option value=""> Pilih Jenis Insentif</option>
                            @foreach($jinsentif as $value)
                                <option value="{{$value->rjinsentif_kode}}">{{$value->rjinsentif_nama}}</option>
                            @endforeach
                        </select>
                        <div class="form-control-feedback form-control-feedback-lg">
                            <i class="icon-search4 text-muted"></i>
                        </div>
                    </div>

                    <div class="input-group-append">
                        <button wire:click.prevent="filter" class="btn bg-primary"><i class="icon-filter3"></i></button>&nbsp;
                        <button wire:click.prevent="clear" class="btn bg-danger"><i class="icon-close2"></i></button>
                    </div>
                </div>

            </div>
        </div>
        @if (session()->has('success_message'))
            <div class="alert alert-success border-0 alert-dismissible">
                <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
                <span class="font-weight-semibold">Sukses!</span> {{ session('success_message') }}
            </div>
        @endif
        @if (session()->has('error_message'))
            <div class="alert alert-danger border-0 alert-dismissible">
                <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
                <span class="font-weight-semibold">Gagal!</span> {{ session('error_message') }}
            </div>
        @endif
        <div class="card">
            <div class="card-header header-elements-inline">
                <h5 class="card-title">Setting Insentif</h5>
            </div>


            @include('livewire.master.insentif.u_r_insentif')

            <div class="table-responsive">
                <table class="table" id="tData">
                    <thead>
                    <tr>
                        <th>Kode Insentif</th>
                        <th>Jenis</th>
                        <th style="text-align: right">Min</th>
                        <th style="text-align: right">Max</th>
                        <th style="text-align: right">Nominal</th>
                        <th width="5%" style="text-align: center;">Aksi</th>
                    </tr>
                    </thead>
                    <tbody>

                    @forelse($insentif as $value)
                        <tr>
                            <td>{{ $value->rinsentif_kode }}</td>
                            <td>{{ $value->rjinsentif_nama }}</td>
                            <td style="text-align: right">{{ \App\Helpers\Utility::currency($value->rinsentif_min,2) }}</td>
                            <td style="text-align: right">{{ \App\Helpers\Utility::currency($value->rinsentif_max,2) }}</td>
                            <td style="text-align: right">{{ \App\Helpers\Utility::currency($value->rinsentif_nominal,2) }}</td>
                            <td width="5%" align="center">
                                <button data-toggle="modal" data-target="#updateModal"
                                        wire:click="edit('{{ $value->rinsentif_kode }}')"
                                        class="btn btn-primary btn-sm">
                                    Edit
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center"><strong>-- Data Tidak Tersedia --</strong></td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>


<script type="text/javascript">
    $(function () {
        $('#rjinsentif_kode').select2();
        $('#rjinsentif_kode').on('change', function (e) {
            let data = $('#rjinsentif_kode').select2("val");
        @this.set('ottJinsentif', data)
        });
        window.livewire.on('actFilter', () => {
            $("#rjinsentif_kode").prop("disabled", true);
        });
        window.livewire.on('clearFilter', () => {
            $("#rjinsentif_kode").select2("trigger", "select", {
                data: {id: ''}
            });
            $("#rjinsentif_kode").prop("disabled", false);

        });
    });
</script>
<style type="text/css">
    .select2-selection__rendered {
        margin-left: 30px;
    }
</style>
