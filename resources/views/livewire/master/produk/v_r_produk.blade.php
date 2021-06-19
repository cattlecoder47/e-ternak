<div>
    <div class="page-header page-header-light">
        <div class="page-header-content header-elements-md-inline">
            <div class="page-title d-flex">
                <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Master</span> - Produk
                </h4>
                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>
        </div>

        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
            <div class="d-flex">
                <div class="breadcrumb">
                    <a href="{{url('/')}}/home" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
                    <a href="#" class="breadcrumb-item">Master</a>
                    <span class="breadcrumb-item active">Produk</span>
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
                <h5 class="card-title">List Produk</h5>
                <div class="float-right">
                    <a href="{{url('/')}}/master/produk/add" class="btn btn-primary btn-sm"> <i
                            class="icon-add position-right"></i> Tambah Produk</a>

                </div>
            </div>
            <div class="col-lg-10 offset-1">
                <div class="row">
                    <div class="col-md-3">
                        <label for="">Search Deskripsi</label>
                        <input type="text" class="form-control" wire:model="filter.search">
                    </div>

                    <div class="col-md-3" wire:ignore>
                        <label for="">Jenis Produk</label>
                        <select wire:model="filter.jenisproduk" id="rjenisproduk_kode" class="form-control">
                            <option value="">Pilih Jenis Produk</option>
                            @foreach($jenisproduk as $value)
                                <option value="{{ $value->rjenisproduk_kode }}">{{ $value->rjenisproduk_nama }}</option>
                            @endforeach
                        </select>
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
                        <th>Kode Produk</th>
                        <th>Jenis</th>
                        <th>Deskripsi</th>
                        <th class="text-center">Tgl Masuk</th>
                        <th class="text-center">Tgl Kadaluarsa</th>
                        <th class="text-right">Qty</th>
                        <th class="text-right">Harga Satuan</th>
                        <th class="text-center">Foto</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                    </thead>
                    <tbody>

                    @if(!empty($objects))
                        @foreach($objects as $k => $v)
                            <tr>
                                <td>{{ $v['rproduk_id'] }}</td>
                                <td>{{ $v['rjenisproduk_nama'] }}</td>
                                <td>{{ $v['rproduk_desk'] }}</td>
                                <td class="text-center">{{ \Carbon\Carbon::parse($v['rproduk_tglmasuk'])->format('d-m-Y') }}</td>
                                <td class="text-center">{{ \Carbon\Carbon::parse($v['rproduk_tglkadaluarsa'])->format('d-m-Y') }}</td>
                                <td class="text-right">{{ $v['rproduk_qty'] }} {{$v['rsatuan_nama']}}</td>
                                <td class="text-right">{{\App\Helpers\Utility::currency( $v['rproduk_hargasatuan'],2) }}</td>
                                <td class="text-center"><a
                                        href="{{url('/')}}/public/foto_produk/{{ $v['rproduk_foto'] }}"
                                        data-popup="lightbox"><img
                                            src="{{url('/')}}/public/foto_produk/{{ $v['rproduk_foto'] }}"
                                            class="img-preview rounded"> </a></td>
                                <td width="10%" align="center">
                                    <a href="{{url('/')}}/master/produk/edit/{{$v['rproduk_id']}}" class="btn btn-primary btn-sm"> <i class="icon-pencil4"></i>
                                    </a>
                                    <button wire:click="$emit('triggerDelete','{{ $v['rproduk_id'] }}')"
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

    </div>
</div>

<script type="text/javascript">
    $(function () {
        $('[data-popup="lightbox"]').fancybox({
            padding: 3
        });

        $('#rjenisproduk_kode').select2();
        $('#rjenisproduk_kode').on('change', function (e) {
            let data = $('#rjenisproduk_kode').select2("val");
        @this.set('ottJenisProduk', data)
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
            $("#rjenisproduk_kode").select2("trigger", "select", {
                data: {id: ''}
            });
            $("#orderField").select2("trigger", "select", {
                data: {id: ''}
            });
            $("#orderBy").select2("trigger", "select", {
                data: {id: ''}
            });
        });
        window.livewire.on('triggerDelete', rproduk_id => {
            bootbox.confirm("APAKAH ANDA AKAN MENGHAPUS SALAH SATU DATA ?", function (result) {
                if (result === true) {
                @this.call('delete', rproduk_id)
                }
            });
        });
    });
</script>
