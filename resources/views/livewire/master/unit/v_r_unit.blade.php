<div>
    <div class="page-header page-header-light">
        <div class="page-header-content header-elements-md-inline">
            <div class="page-title d-flex">
                <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Master</span> - Unit
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
                    <span class="breadcrumb-item active">Unit</span>
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
                <h5 class="card-title">Unit</h5>
                @if (\App\Helpers\Utility::getSession('isAdmin')=='1'){
                <div class="float-right">
                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#createModal">
                        Tambah <i class="icon-add position-right"></i></button>
                </div>
                @endif
            </div>

            @include('livewire.master.unit.c_r_unit')
            @include('livewire.master.unit.u_r_unit')

            @if (\App\Helpers\Utility::getSession('isAdmin')=='1')
                <div class="col-lg-10 offset-1">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="">Search Nama Unit</label>
                            <input type="text" class="form-control" wire:model="filter.search">
                        </div>


                        <div class="col-md-2" wire:ignore>
                            <label for="">Urutkan Berdasarkan</label>
                            <select wire:model="filter.order_field" class="form-control" id="orderField">
                                <option value="">Pilih Opsi</option>
                                <option value="runit_kode">Kode Unit</option>
                                <option value="runit_nama">Nama Unit</option>
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
            @endif
            <hr/>
            <div class="table-responsive">

                <table class="table" id="tData">
                    <thead>
                    <tr>
                        <th>Kode Unit</th>
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>Pimpinan</th>
                        <th>Tgl Register</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                    </thead>
                    <tbody>

                    @if(!empty($objects))
                        @foreach($objects as $k => $v)
                            <tr>
                                <td>{{ $v['runit_kode'] }}</td>
                                <td>{{ $v['runit_nama'] }}</td>
                                <td>{{ $v['runit_alamat'] }}</td>
                                <td>{{ $v['runit_pimpinan'] }}</td>
                                <td class="text-center">{{ \Carbon\Carbon::parse($v['runit_create_at'])->format('d-m-Y') }}</td>

                                <td width="15%" class="text-center">
                                    <button data-toggle="modal" data-target="#updateModal"
                                            wire:click="edit('{{ $v['runit_kode'] }}')"
                                            class="btn btn-primary btn-sm">
                                        Edit
                                    </button>
                                    @if (\App\Helpers\Utility::getSession('isAdmin')=='1')
                                        <button wire:click="$emit('triggerDelete','{{ $v['runit_kode'] }}')"
                                                wire:click="delete()" class="btn btn-danger btn-sm">Delete
                                        </button>
                                    @endif
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
            @if (\App\Helpers\Utility::getSession('isAdmin')=='1')
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
            @endif

        </div>
    </div>
</div>
<script type="text/javascript">
    $(function () {
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
        window.livewire.on('runitStore', () => {
            $('#createModal').modal('hide');
        });
        window.livewire.on('resetFilter', () => {

            $("#orderField").select2("trigger", "select", {
                data: {id: ''}
            });
            $("#orderBy").select2("trigger", "select", {
                data: {id: ''}
            });
        });
        window.livewire.on('triggerDelete', runit_kode => {
            bootbox.confirm("APAKAH ANDA AKAN MENGHAPUS SALAH SATU DATA ?", function (result) {
                if (result === true) {
                @this.call('delete', runit_kode)
                }
            });
        });

    });
</script>

