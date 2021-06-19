<div>
    <div class="page-header page-header-light">
        <div class="page-header-content header-elements-md-inline">
            <div class="page-title d-flex">
                <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Master</span> - Kandang
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
                    <span class="breadcrumb-item active">Kandang</span>
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
                <h5 class="card-title">List Kandang</h5>
                <div class="float-right">
                    <a href="{{url('/')}}/master/kandang/add" class="btn btn-primary btn-sm"> <i
                            class="icon-add position-right"></i> Tambah Kandang</a>

                </div>
            </div>
            <div class="col-lg-10 offset-1">
                <div class="row">
                    <div class="col-md-3">
                        <label for="">Search Lokasi</label>
                        <input type="text" class="form-control" wire:model="filter.search">
                    </div>

                    <div class="col-md-3" wire:ignore>
                        <label for="">Nama Customer</label>
                        <select wire:model="filter.customer" id="syscustomer_id" class="form-control">
                            <option value="">Pilih Customer</option>
                            @foreach($customer as $value)
                                <option value="{{ $value->syscustomer_id }}">{{ $value->syscustomer_namalengkap }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-2" wire:ignore>
                        <label for="">Urutkan Berdasarkan</label>
                        <select wire:model="filter.order_field" class="form-control" id="orderField">
                            <option value="">Pilih Opsi</option>
                            <option value="rkandang_id">ID Kandang</option>
                            <option value="rkandang_lokasi">Lokasi</option>
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
            @include('livewire.master.kandang.g_r_kandang')

            <div class="table-responsive">

                <table class="table" id="tData">
                    <thead>
                    <tr>
                        <th>Kode Kandang</th>
                        <th>Nama Cust</th>
                        <th>Nama Kandang</th>
                        <th>Lokasi</th>
                        <th>Ukuran</th>
                        <th>Daya Tampung</th>
                        <th>Kondisi Jalan</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                    </thead>
                    <tbody>

                    @if(!empty($objects))
                        @foreach($objects as $k => $v)
                            <tr>
                                <td>{{ $v['rkandang_id'] }}</td>
                                <td>{{ $v['syscustomer_namalengkap'] }}</td>
                                <td>{{ $v['rkandang_nama'] }}</td>
                                <td>{{ $v['rkandang_lokasi'] }}</td>
                                <td>{{ $v['rkandang_size'] }}</td>
                                <td>{{ $v['rkandang_dayatampung'] }}</td>
                                <td>{{ $v['rkondjalan_nama'] }}</td>
                                <td width="15%" align="center">
                                    <a href="{{url('/')}}/master/kandang/edit/{{$v['rkandang_id']}}" class="btn btn-primary btn-sm"> <i class="icon-pencil4"></i>
                                    </a>
                                    <button data-toggle="modal" data-target="#galleryModal"
                                            wire:click="gallery('{{ $v['rkandang_id'] }}')"
                                            class="btn btn-icon btn-dark btn-sm">
                                        <i class="icon-gallery"></i>
                                    </button>
                                    <button wire:click="$emit('triggerDelete','{{ $v['rkandang_id'] }}')"
                                            wire:click="delete()" class="btn btn-danger btn-sm"><i
                                            class="icon-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="7" class="text-center"><strong>-- Data Tidak Tersedia --</strong></td>
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
        $('[data-popup="lightbox"]').fancybox({
            padding: 3
        });

        $('#syscustomer_id').select2();
        $('#syscustomer_id').on('change', function (e) {
            let data = $('#syscustomer_id').select2("val");
        @this.set('ottCustomer', data)
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
        window.livewire.on('actFilter', () => {
            $('[data-popup="lightbox"]').fancybox({
                padding: 3
            });
        });
        window.livewire.on('resetFilter', () => {
            $("#syscustomer_id").select2("trigger", "select", {
                data: {id: ''}
            });
            $("#orderField").select2("trigger", "select", {
                data: {id: ''}
            });
            $("#orderBy").select2("trigger", "select", {
                data: {id: ''}
            });
        });
        window.livewire.on('triggerDelete', rkandang_id => {
            bootbox.confirm("APAKAH ANDA AKAN MENGHAPUS SALAH SATU DATA ?", function (result) {
                if (result === true) {
                @this.call('delete', rkandang_id)
                }
            });
        });
    });
</script>
