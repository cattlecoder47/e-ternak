<div>
    <div class="page-header page-header-light">
        <div class="page-header-content header-elements-md-inline">
            <div class="page-title d-flex">
                <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Referensi</span> - Jenis Kontrak
                </h4>
                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>
            @include('header-elements')


        </div>

        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
            <div class="d-flex">
                <div class="breadcrumb">
                    <a href="{{url('/')}}/home" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
                    <a href="#" class="breadcrumb-item">Referensi</a>
                    <span class="breadcrumb-item active">Jenis Kontrak</span>
                </div>

                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>

        </div>
    </div>
    <div class="content">
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
                <h5 class="card-title">Jenis Kontrak</h5>
                <div class="float-right">
                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#createModal">
                        Tambah <i class="icon-add position-right"></i></button>
                </div>
            </div>

            @include('livewire.referensi.jeniskontrak.c_r_jeniskontrak')
            @include('livewire.referensi.jeniskontrak.u_r_jeniskontrak')

            <div class="table-responsive">
                <table class="table" id="tData">
                    <thead>
                    <tr>
                        <th>Kode Jenis Kontrak</th>
                        <th>Nama Jenis Kontrak</th>
                        <th style="text-align: center;">Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($r_jeniskontrak as $value)
                        <tr>
                            <td>{{ $value->rjeniskontrak_kode }}</td>
                            <td>{{ $value->rjeniskontrak_nama }}</td>
                            <td width="15%" align="center">
                                <button data-toggle="modal" data-target="#updateModal"
                                        wire:click="edit('{{ $value->rjeniskontrak_kode }}')" class="btn btn-primary btn-sm">
                                    Edit
                                </button>
                                <button wire:click="$emit('triggerDelete','{{ $value->rjeniskontrak_kode }}')"
                                        wire:click="delete()" class="btn btn-danger btn-sm">Delete
                                </button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(function () {
        window.livewire.on('jeniskontrakStore', () => {
            $('#createModal').modal('hide');
        });
        window.livewire.on('triggerDelete', rjeniskontrak_kode => {
            bootbox.confirm("APAKAH ANDA AKAN MENGHAPUS SALAH SATU DATA ?", function (result) {
                if (result === true) {
                @this.call('delete', rjeniskontrak_kode)
                }
            });
        });

    });
</script>

