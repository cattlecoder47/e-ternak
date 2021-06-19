<div>
    <div class="page-header page-header-light">
        <div class="page-header-content header-elements-md-inline">
            <div class="page-title d-flex">
                <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">User</span> - List
                    Pengguna
                </h4>
                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>
            @include('header-elements')
        </div>

        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
            <div class="d-flex">
                <div class="breadcrumb">
                    <a href="{{url('/')}}/home" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
                    <a href="#" class="breadcrumb-item">User</a>
                    <span class="breadcrumb-item active">List Pengguna</span>
                </div>

                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>

        </div>
    </div>
    <div class="content">

        <div class="card">
            <div class="card-header header-elements-inline">
                <h5 class="card-title">List Pengguna</h5>
                <div class="float-right">
                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#createModal">
                        Tambah <i class="icon-add position-right"></i></button>
                </div>
            </div>
            <div class="card-body">
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
                @include('livewire.user.sysuser.c_sys_user')
                @include('livewire.user.sysuser.u_sys_user')
                <div class="col-lg-10 offset-1">
                    <div class="row">
                        <div class="col-md-3">
                            <label for="">Search Nama Lengkap</label>
                            <input type="text" class="form-control" wire:model="filter.search">
                        </div>

                        <div class="col-md-3" wire:ignore>
                            <label for="">Role</label>
                            <select wire:model="filter.role" id="sysrole_kode_filter" class="form-control">
                                <option value="">Pilih Role</option>
                                @foreach($roles as $value)
                                    <option
                                        value="{{ $value->sysrole_kode }}">{{ $value->sysrole_nama }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-2" wire:ignore>
                            <label for="">Urutkan Berdasarkan</label>
                            <select wire:model="filter.order_field" class="form-control" id="orderField">
                                <option value="">Pilih Opsi</option>
                                <option value="sysuser_id">ID User</option>
                                <option value="sysuser_namalengkap">Nama Lengkap</option>
                            </select>
                        </div>

                        <div class="col-md-2" wire:ignore>
                            <label for="">Order By</label>
                            <select wire:model="filter.order_type" class="form-control" id="orderBy">
                                <option value="">Pilih Opsi</option>
                                <option value="ASC">Ascending</option>
                                <option value="DESC">Descending</option>
                            </select>
                        </div>

                        <div class="col-md-2" style="display: flex;align-items: flex-end;">
                            <div>
                                <button type="button" wire:click="loadList" class="btn btn-primary"><i
                                        class="icon-filter3"></i> Filter
                                </button>
                                <button type="button" wire:click="resetFilter" class="btn btn-danger"><i
                                        class="icon-close2"></i> Reset
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <hr/>
                <div class="table-responsive">
                    <input type="text" class="form-control" placeholder="Pencarian Berdasarkan Username"
                           wire:model="searchTerm"/>

                    <table class="table table-striped table-bordered" id="tUser">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Role</th>
                            <th>Unit</th>
                            <th>Username</th>
                            <th>Nama Lengkap</th>
                            <th>HP</th>
                            <th>Email</th>
                            <th class="text-center">Otorize</th>
                            <th>Tgl Register</th>
                            <th>Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(!empty($objects))
                            @foreach($objects as $k => $v)
                                <tr>
                                    <td>{{$v['sysuser_id']}}</td>
                                    <td>{{$v['sysrole_nama']}}</td>
                                    @if (!empty($v['runit_nama']))
                                        <td>{{$v['runit_nama']}}</td>
                                    @else
                                        <td><span class="badge badge-flat border-success text-success-600 d-block">Super-Admin</span>
                                        </td>
                                    @endif
                                    <td>{{$v['sysuser_nama']}}</td>
                                    <td>{{$v['sysuser_namalengkap']}}</td>
                                    <td>{{$v['sysuser_hp']}}</td>
                                    <td>{{$v['sysuser_email']}}</td>
                                    @if($v['sysuser_otorize'] =='0')
                                        <td><span
                                                class="badge badge-flat border-danger text-danger-600 d-block">Tidak</span>
                                        </td>
                                    @else
                                        <td><span
                                                class="badge badge-flat border-success text-success-600 d-block">Ya</span>
                                        </td>
                                    @endif
                                    <td>{{\Carbon\Carbon::parse($v['sysuser_create_at'])->format('d-m-Y H:m:s')}}</td>
                                    <td width="15%" align="center">
                                        <button data-toggle="modal" data-target="#updateModal"
                                                wire:click="edit('{{ $v['sysuser_id'] }}')"
                                                class="btn btn-primary btn-sm">
                                            Edit
                                        </button>
                                        <button wire:click="$emit('triggerDelete','{{ $v['sysuser_id'] }}')"
                                                wire:click="delete()" class="btn btn-danger btn-sm">Delete
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="9" class="text-center"><strong>-- Data Tidak Tersedia --</strong></td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer bg-white d-sm-flex justify-content-sm-between align-items-sm-center">
                <div class="pagination-container">
                    <ul class="pagination">
                        <li class="page-item
                    @if($page == 1)
                            disabled
@endif
                            ">
                            <a class="page-link" href="javascript:void(0)"
                               wire:click="applyPagination('previous_page', {{ $page-1 }})">
                                ← Previous
                            </a>
                        </li>

                        <li class="page-item
                    @if($page == $paginator['last_page'])
                            disabled
@endif

                            ">
                            <a class="page-link" href="javascript:void(0)"
                               @if($page <= $paginator['last_page'])
                               wire:click="applyPagination('next_page', {{ $page+1 }})"
                                @endif
                            >
                                Next →
                            </a>
                        </li>

                        <li class="page-item" style="margin: 8px 5px 0;">
                            Jump to Page
                        </li>
                        <li class="page-item" style="margin: 0 5px">
                            <select class="form-control" title="" style="width: 80px" wire:model="page"
                                    wire:change="loadList">
                                @for($i=1;$i<=$paginator['last_page'];$i++)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                        </li>

                        <li class="page-item" style="margin: 8px 5px 0;">
                            Items Per Page
                        </li>

                        <li class="page-item" style="margin: 0 5px">
                            <select class="form-control" title="" style="width: 80px" wire:model="items_per_page"
                                    wire:change="loadList">
                                <option value="5">05</option>
                                <option value="10">10</option>
                                <option value="20">20</option>
                                <option value="30">30</option>
                            </select>
                        </li>
                    </ul>
                </div>
            </div>


        </div>
    </div>
</div>
<script type="text/javascript">
    $(function () {
        let swalInit = swal.mixin({
            buttonsStyling: false,
            confirmButtonClass: 'btn btn-primary',
            cancelButtonClass: 'btn btn-light'
        });
        $('#sysrole_kode_filter').select2();
        $('#sysrole_kode_filter').on('change', function (e) {
            let data = $('#sysrole_kode_filter').select2("val");
        @this.set('ottRoleFilter', data)
        });

        $('#orderField').select2({
            minimumResultsForSearch: Infinity
        });
        $('#orderField').on('change', function (e) {
            let data = $('#orderField').select2("val");
        @this.set('ottOrderField', data)
        });

        $('#orderBy').select2({
            minimumResultsForSearch: Infinity
        });
        $('#orderBy').on('change', function (e) {
            let data = $('#orderBy').select2("val");
        @this.set('ottOrderBy', data)
        });
        window.livewire.on('resetFilter', () => {
            $("#sysrole_kode_filter").select2("trigger", "select", {
                data: {id: ''}
            });
            $("#orderField").select2("trigger", "select", {
                data: {id: ''}
            });
            $("#orderBy").select2("trigger", "select", {
                data: {id: ''}
            });
        });
        window.livewire.on('sysuserStore', () => {
            $('#createModal').modal('hide');
        });
        window.livewire.on('emptyUnit', () => {
            swalInit.fire({
                text: 'Unit Belum Dipilih',
                type: 'error',
                toast: true,
                showConfirmButton: false,
                position: 'center'
            });
        });
        window.livewire.on('triggerDelete', sysuser_id => {
            bootbox.confirm("APAKAH ANDA AKAN MENGHAPUS SALAH SATU DATA ?", function (result) {
                if (result === true) {
                @this.call('delete', sysuser_id)
                }
            });
        });
    });


</script>

