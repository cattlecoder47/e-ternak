<div>
    <div class="page-header page-header-light">
        <div class="page-header-content header-elements-md-inline">
            <div class="page-title d-flex">
                <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Master</span> - Kontrak
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
                    <span class="breadcrumb-item active">Kontrak</span>
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
                <h5 class="card-title">Kontrak</h5>
                <div class="float-right">
                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#createModal">
                        Tambah <i class="icon-add position-right"></i></button>
                </div>
            </div>

            @include('livewire.master.kontrak.c_t_kontrak')
            @include('livewire.master.kontrak.u_t_kontrak')
            @include('livewire.master.kontrak.d_t_kontrak')
            <div class="col-lg-10 offset-1">
                <div class="row">
                    <div class="col-md-3">
                        <label for="">Search No Kontrak</label>
                        <input type="text" class="form-control" wire:model="filter.search">
                    </div>

                    <div class="col-md-3" wire:ignore>
                        <label for="">Jenis Kontrak</label>
                        <select wire:model="filter.jeniskontrak" id="rjeniskontrak_kode_filter" class="form-control">
                            <option value="">Pilih Jenis Kontrak</option>
                            @foreach($jenisKontrak as $value)
                                <option
                                    value="{{ $value->rjeniskontrak_kode }}">{{ $value->rjeniskontrak_nama }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-2" wire:ignore>
                        <label for="">Urutkan Berdasarkan</label>
                        <select wire:model="filter.order_field" class="form-control" id="orderField">
                            <option value="">Pilih Opsi</option>
                            <option value="tkontrak_no">No Kontrak</option>
                            <option value="tkontrak_nama">Nama Kontrak</option>
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
                <input type="text" class="form-control" placeholder="&nbsp;Pencarian Berdasarkan No. Kontrak"
                       wire:model="searchTerm"/>
                <table class="table" id="tData">
                    <thead>
                    <tr>`
                        <th>ID Kontrak</th>
                        <th>Unit</th>
                        <th>Jenis Kontrak</th>
                        <th>Nama Kontrak</th>
                        <th>No. Kontrak</th>
                        <th>Nama Cust.</th>
                        <th>Lokasi Kandang</th>
                        <th>Nama Unit</th>
                        <th>Tgl Kontrak</th>
                        <th style="text-align: center;">Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(!empty($objects))
                        @foreach($objects as $k => $v)
                            <tr>
                                <td>{{ $v['tkontrak_id'] }}</td>
                                <td>{{ $v['runit_nama'] }}</td>
                                <td>{{ $v['rjeniskontrak_nama'] }}</td>
                                <td>{{ $v['tkontrak_nama'] }}</td>
                                <td>{{ $v['tkontrak_no'] }}</td>
                                <td>{{ $v['syscustomer_namalengkap'] }}</td>
                                <td>{{ $v['rkandang_lokasi'] }}</td>
                                <td>{{ $v['runit_nama'] }}</td>
                                <td>{{ \Carbon\Carbon::parse($v['tkontrak_tgl'])->format('d-m-Y') }}</td>
                                <td width="15%" align="center">
                                    <button data-toggle="modal" data-target="#updateModal"
                                            wire:click="edit('{{ $v['tkontrak_id'] }}')"
                                            class="btn btn-icon btn-primary btn-sm">
                                        <i class="icon-pencil3"></i>
                                    </button>
                                    <button data-toggle="modal" data-target="#detailModal"
                                            wire:click="detail('{{ $v['tkontrak_id'] }}')"
                                            class="btn btn-icon btn-dark btn-sm">
                                        <i class="icon-zoomin3"></i>
                                    </button>
                                    <button wire:click="$emit('triggerDelete','{{ $v['tkontrak_id'] }}')"
                                            wire:click="delete()" class="btn btn-icon btn-danger btn-sm"><i
                                            class="icon-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="10" class="text-center"><strong>-- Data Tidak Tersedia --</strong></td>
                        </tr>
                    @endif

                    </tbody>
                </table>
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
        $('#rjeniskontrak_kode_filter').select2();
        $('#rjeniskontrak_kode_filter').on('change', function (e) {
            let data = $('#rjeniskontrak_kode_filter').select2("val");
        @this.set('ottJenisKontrakFilter', data)
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
            $("#rjeniskontrak_kode_filter").select2("trigger", "select", {
                data: {id: ''}
            });
            $("#orderField").select2("trigger", "select", {
                data: {id: ''}
            });
            $("#orderBy").select2("trigger", "select", {
                data: {id: ''}
            });
        });
        window.livewire.on('kontrakStore', () => {
            $('#createModal').modal('hide');
        });
        window.livewire.on('triggerDelete', tkontrak_id => {
            bootbox.confirm("APAKAH ANDA AKAN MENGHAPUS SALAH SATU DATA ?", function (result) {
                if (result === true) {
                @this.call('delete', tkontrak_id)
                }
            });
        });

    });
</script>

