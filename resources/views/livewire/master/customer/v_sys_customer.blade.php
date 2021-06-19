<div>
    <div class="page-header page-header-light">
        <div class="page-header-content header-elements-md-inline">
            <div class="page-title d-flex">
                <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Master</span> - <span
                        class="font-weight-semibold">Customer</span> - List Customer
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
                    <a href="#" class="breadcrumb-item">Customer</a>
                    <span class="breadcrumb-item active">List Customer</span>
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
                <h5 class="card-title">Customer</h5>
                <div class="float-right">
                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#createModal">
                        Tambah <i class="icon-add position-right"></i></button>
                </div>
            </div>

            @include('livewire.master.customer.c_sys_customer')
            @include('livewire.master.customer.u_sys_customer')
            <div class="col-lg-10 offset-1">
                <div class="row">
                    <div class="col-md-6">
                        <label for="">Search Nama Customer</label>
                        <input type="text" class="form-control" wire:model="filter.search">
                    </div>


                    <div class="col-md-2" wire:ignore>
                        <label for="">Urutkan Berdasarkan</label>
                        <select wire:model="filter.order_field" class="form-control" id="orderField">
                            <option value="">Pilih Opsi</option>
                            <option value="rproduk_id">ID Produk</option>
                            <option value="rproduk_desk">Deskripsi</option>
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

                <table class="table" id="tData">
                    <thead>
                    <tr>
                        <th>Kode Customer</th>
                        <th>Nama Lengkap</th>
                        <th>Alamat</th>
                        <th>Tempat,Tgl Lahir</th>
                        <th>Jenis ID</th>
                        <th>No ID</th>
                        <th>HP</th>
                        <th>Wilayah</th>
                        <th style="text-align: center;">Aksi</th>
                    </tr>
                    </thead>
                    <tbody>

                    @if(!empty($objects))
                        @foreach($objects as $k => $v)
                            <tr>
                                <td>{{ $v['syscustomer_id'] }}</td>
                                <td>{{ $v['syscustomer_namalengkap'] }}</td>
                                <td>{{ $v['syscustomer_alamat'] }}</td>
                                <td>{{ $v['syscutomer_tempatlahir'] }}
                                    , {{\Carbon\Carbon::parse($v['syscustomer_tgllahir'])->format('d-m-Y')}}</td>
                                <td>{{ $v['rjid_nama'] }}</td>
                                <td>{{ $v['syscustomer_noid'] }}</td>
                                <td>{{ $v['syscustomer_hp'] }}</td>
                                <td>{{ $v['rwilayah_provnama'] }},{{$v['rwilayah_jenis']}} {{$v['rwilayah_kotanama']}}
                                    , {{$v['rwilayah_kecnama']}}, {{$v['rwilayah_kelnama']}}, Kode
                                    Pos {{$v['rwilayah_kodepos']}}</td>
                                <td width="15%" align="center">

                                    <button data-toggle="modal" data-target="#updateModal"
                                            wire:click="edit('{{ $v['syscustomer_id'] }}')"
                                            class="btn btn-primary btn-sm">
                                        <i class="icon-pencil4"></i>
                                    </button>
                                    <button class="btn btn-info btn-sm"
                                            wire:click="viewKandang('{{ $v['syscustomer_id'] }}')"><i
                                            class="icon-home4"></i></button>
                                    <button wire:click="$emit('triggerDelete','{{ $v['syscustomer_id'] }}')"
                                            wire:click="delete()" class="btn btn-danger btn-sm"><i
                                            class="icon-trash"></i>
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
        @if(count($kandang)>0 && count($objects) > 0 )
            <div class="card">
                <div class="card-header header-elements-inline">
                    <h5 class="card-title">Informasi Kandang</h5>
                    <div class="header-elements">
                        <div class="list-icons">
                            <a class="list-icons-item" data-action="remove" wire:click="resetKandang"></a>
                        </div>
                    </div>
                </div>

                <div wire:loading align="center">
                    <span class="text-dark"> {{ $loading_kandang }}</span>
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <tbody>
                        @foreach($kandang as $value)

                            <tbody>
                            <tr valign="middle">
                                <td width="15%">ID Kandang</td>
                                <td>{{$value->rkandang_id}}</td>
                                <td rowspan="6" align="center">Gallery Kandang</td>
                                <td rowspan="3" align="center"><a
                                        href="{{url('/')}}/public/foto_kandang/{{ $value->rkandang_foto1 }}"
                                        data-popup="lightbox"><img
                                            src="{{url('/')}}/public/foto_kandang/{{ $value->rkandang_foto1}}"
                                            class="img-preview rounded"> </a></td>
                                <td rowspan="3" align="center"><a
                                        href="{{url('/')}}/public/foto_kandang/{{ $value->rkandang_foto2 }}"
                                        data-popup="lightbox"><img
                                            src="{{url('/')}}/public/foto_kandang/{{ $value->rkandang_foto2}}"
                                            class="img-preview rounded"> </a></td>
                            </tr>
                            <tr>
                                <td>Pemilik Kandang</td>
                                <td>{{$value->syscustomer_namalengkap}}</td>
                            </tr>
                            <tr>
                                <td>Kondisi Jalan</td>
                                <td>{{$value->rkondjalan_nama}}</td>
                            </tr>
                            <tr>
                                <td>Ukuran Kandang</td>
                                <td>{{$value->rkandang_size}} m2</td>
                                <td rowspan="3" align="center"><a
                                        href="{{url('/')}}/public/foto_kandang/{{ $value->rkandang_foto3 }}"
                                        data-popup="lightbox"><img
                                            src="{{url('/')}}/public/foto_kandang/{{ $value->rkandang_foto3}}"
                                            class="img-preview rounded"> </a></td>
                                <td rowspan="3" align="center"><a
                                        href="{{url('/')}}/public/foto_kandang/{{ $value->rkandang_foto4 }}"
                                        data-popup="lightbox"><img
                                            src="{{url('/')}}/public/foto_kandang/{{ $value->rkandang_foto4}}"
                                            class="img-preview rounded"> </a></td>
                            </tr>
                            <tr>
                                <td>Daya Tampung Kandang</td>
                                <td>{{$value->rkandang_dayatampung}}</td>
                            </tr>
                            <tr>
                                <td>Tgl Register Kandang</td>
                                <td>{{\Carbon\Carbon::parse($value->rkandang_create_at)->format('d-m-Y H:m:s')}}</td>
                            </tr>
                            </tbody>
                            @endforeach
                            </tbody>
                    </table>
                </div>
            </div>
        @endif

    </div>
</div>
<script type="text/javascript">
    $(function () {
        let swalInit = swal.mixin({
            buttonsStyling: false,
            confirmButtonClass: 'btn btn-primary',
            cancelButtonClass: 'btn btn-light'
        });
        window.livewire.on('customerStore', () => {
            $('#createModal').modal('hide');
        });
        window.livewire.on('customerKandang', () => {
            $('[data-popup="lightbox"]').fancybox({
                padding: 3
            });
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
            $("#orderField").select2("trigger", "select", {
                data: {id: ''}
            });
            $("#orderBy").select2("trigger", "select", {
                data: {id: ''}
            });
        });
        window.livewire.on('emptyKandang', () => {
            swalInit.fire({
                text: 'Belum Ada Kandang Yang DIinput',
                type: 'error',
                toast: true,
                showConfirmButton: false,
                position: 'center'
            });
        });
        window.livewire.on('triggerDelete', syscustomer_id => {
            bootbox.confirm("APAKAH ANDA AKAN MENGHAPUS SALAH SATU DATA ?", function (result) {
                if (result === true) {
                @this.call('delete', syscustomer_id)
                }
            });
        });

    });
</script>

