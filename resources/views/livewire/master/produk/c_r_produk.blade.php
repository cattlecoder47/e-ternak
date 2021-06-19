<div>
    <div class="page-header page-header-light">
        <div class="page-header-content header-elements-md-inline">
            <div class="page-title d-flex">
                <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Master</span> - Produk -
                    Tambah Produk
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
                    <a href="{{url('/')}}/master/produk" class="breadcrumb-item">Produk</a>
                    <span class="breadcrumb-item active">Tambah Produk</span>
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
                <h5 class="card-title">Tambah Produk</h5>
            </div>

            <div class="card-body">
                <form>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group" wire:ignore>
                                <label>Jenis Produk</label>
                                <select wire:model="rjenisproduk_kode" class="form-control" id="rjenisproduk_kode">
                                    <option value="">Pilih Jenis Produk</option>
                                    @foreach($jenisproduk as $value)
                                        <option
                                            value="{{ $value->rjenisproduk_kode }}">{{ $value->rjenisproduk_nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Deskripsi Produk</label>
                                <input type="text" placeholder="Deskripsi Produk" wire:model="rproduk_desk"
                                       id="rproduk_desk"
                                       class="form-control" required>
                                @error('rproduk_desk') <label id="basic-error" class="validation-invalid-label"
                                                              for="basic">{{$message}}</label>@enderror
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group" wire:ignore>
                                        <label>Tgl Masuk Produk</label>
                                        <input type="text" placeholder="Tgl Masuk Produk"
                                               id="rproduk_tglmasuk"
                                               class="form-control" required>
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="form-group" wire:ignore>
                                        <label>Tgl Kadaluarsa Produk</label>
                                        <input type="text" placeholder="Tgl Kadaluarsa Produk"
                                               id="rproduk_tglkadaluarsa"
                                               class="form-control" required>
                                    </div>

                                </div>
                            </div>


                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group" wire:ignore>
                                        <label>Satuan Jumlah</label>
                                        <select wire:model="rsatuan_kode" class="form-control" id="rsatuan_kode">
                                            <option value="">Pilih Satuan</option>
                                            @foreach($satuan as $value)
                                                <option
                                                    value="{{ $value->rsatuan_kode }}">{{ $value->rsatuan_nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Jumlah (Qty)</label>
                                        <input type="text" placeholder="Jumlah (Qty)" wire:model="rproduk_qty"
                                               id="rproduk_qty"
                                               class="form-control text-right" required>
                                        @error('rproduk_qty') <label id="basic-error" class="validation-invalid-label"
                                                                     for="basic">{{$message}}</label>@enderror
                                    </div>

                                </div>
                            </div>
                            <div class="form-group" wire:ignore>
                                <label>Harga Satuan</label>
                                <input type="text" placeholder="Harga Satuan"
                                       id="rproduk_hargasatuan"
                                       class="form-control text-right" required>

                            </div>
                            <div class="form-group">
                                <label>Foto Produk</label>
                                <input type="file" class="form-control" wire:model="rproduk_foto">
                                @error('rproduk_foto') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>


                    <div class="text-right">
                        <button wire:click.prevent="store" class="btn btn-primary">Simpan <i
                                class="icon-paperplane ml-2"></i>
                        </button>
                        <a href="{{url('/')}}/master/produk" class="btn btn-danger"><i class="icon-arrow-left8"></i>
                            Back to List </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(function () {
        initializeLib();


        $('#rjenisproduk_kode').on('change', function (e) {
            let data = $('#rjenisproduk_kode').select2("val");
        @this.set('ottJenisProduk', data)
        });

        $('#rproduk_tglmasuk').on('change', function (e) {
            let data = $('#rproduk_tglmasuk').val();
        @this.set('ottPickerTglMasukProduk', data)
        });

        $('#rproduk_tglkadaluarsa').on('change', function (e) {
            let data = $('#rproduk_tglkadaluarsa').val();
        @this.set('ottPickerTglKadaluarsaProduk', data)
        });

        $('#rsatuan_kode').on('change', function (e) {
            let data = $('#rsatuan_kode').select2("val");
        @this.set('ottSatuan', data)
        });


        $('#rproduk_hargasatuan').on('change', function (e) {
            let data = $('#rproduk_hargasatuan').val();
        @this.set('ottHargaSatuan', data)
        });


        function initializeLib() {
            $('#rjenisproduk_kode').select2();
            $('#rproduk_tglmasuk').pickadate({
                format: 'dd-mm-yyyy',
            });
            $('#rproduk_tglkadaluarsa').pickadate({
                format: 'dd-mm-yyyy',
            });
            $('#rsatuan_kode').select2();
            $('#rproduk_hargasatuan').autoNumeric('init', {
                aSep: '.',
                aDec: ','
            });
        }

    })
</script>
