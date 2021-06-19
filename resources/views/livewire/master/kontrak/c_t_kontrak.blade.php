<div>
    <div id="createModal" wire:ignore.self class="modal fade">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Kontrak</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <form action="#">
                    <div class="modal-body">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-6" wire:ignore>
                                    <label>Jenis Kontrak</label>
                                    <select class="form-control" id="rjeniskontrak_kode"
                                            wire:model="rjeniskontrak_kode">
                                        <option value="">Pilih Jenis Kontrak</option>
                                        @foreach($jenisKontrak as $itemJenis)
                                            <option
                                                value="{{ $itemJenis->rjeniskontrak_kode }}">{{ $itemJenis->rjeniskontrak_nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label>Nomor Kontrak</label>
                                    <input type="text" placeholder="Nomor Kontrak" class="form-control"
                                           wire:model="tkontrak_no"
                                           id="tkontrak_no">
                                    @error('tkontrak_no') <label id="basic-error" class="validation-invalid-label"
                                                                 for="basic">{{$message}}</label>@enderror
                                </div>

                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-6" wire:ignore>
                                    <label>Tgl Kontrak</label>
                                    <input type="text" placeholder="Tgl Kontrak"
                                           id="tkontrak_tgl"
                                           class="form-control" required>
                                </div>
                                <div class="col-sm-6" wire:ignore>
                                    <label>Tgl Habis Kontrak</label>
                                    <input type="text" placeholder="Tgl Habis Kontrak"
                                           id="tkontrak_tglhabis"
                                           class="form-control" required>
                                </div>

                            </div>
                        </div>
                        @livewire('cust-kandang-dropdown')
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-6" wire:ignore>
                                    <label>Unit</label>
                                    <select wire:model="runit_kode" class="form-control" id="runit_kode">
                                        <option value="">Pilih Unit</option>
                                        @foreach($units as $itemUnit)
                                            <option
                                                value="{{ $itemUnit->runit_kode }}">{{ $itemUnit->runit_nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label>Nama Kontrak</label>
                                    <input type="text" placeholder="Nama Kontrak" class="form-control"
                                           wire:model="tkontrak_nama"
                                           id="tkontrak_nama">
                                    @error('tkontrak_nama') <label id="basic-error" class="validation-invalid-label"
                                                                   for="basic">{{$message}}</label>@enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-6">
                                    <label>Jumlah Ayam</label>
                                    <input type="text" placeholder="Jumlah Ayam" class="form-control"
                                           wire:model="tkontrak_jmlayam"
                                           id="tkontrak_jmlayam">
                                    @error('tkontrak_jmlayam') <label id="basic-error" class="validation-invalid-label"
                                                                      for="basic">{{$message}}</label>@enderror
                                </div>
                                <div class="col-sm-6" wire:ignore>
                                    <label>Harga Ayam (pcs)</label>
                                    <input type="text" placeholder="Harga Ayam (pcs)" class="form-control text-right"
                                           id="tkontrak_hargaayampcs">
                                    @error('tkontrak_hargaayampcs') <label id="basic-error"
                                                                           class="validation-invalid-label"
                                                                           for="basic">{{$message}}</label>@enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-6" wire:ignore>
                                    <label>Satuan Pakan Ayam</label>
                                    <select wire:model="rsatuanpakan_kode" class="form-control" id="rsatuanpakan_kode">
                                        <option value="">Pilih Satuan Pakan</option>
                                        @foreach($satuan as $itemSatuanPakan)
                                            <option
                                                value="{{ $itemSatuanPakan->rsatuan_kode }}">{{ $itemSatuanPakan->rsatuan_nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label>Pakan Ayam</label>
                                    <input type="text" placeholder="Pakan Ayam" class="form-control text-right"
                                           wire:model="tkontrak_pakan"
                                           id="tkontrak_pakan">
                                    @error('tkontrak_pakan') <label id="basic-error" class="validation-invalid-label"
                                                                    for="basic">{{$message}}</label>@enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-6" wire:ignore>
                                    <label>Satuan Obat Ayam</label>
                                    <select wire:model="rsatuanobat_kode" class="form-control" id="rsatuanobat_kode">
                                        <option value="">Pilih Satuan Obat</option>
                                        @foreach($satuan as $itemSatuanObat)
                                            <option
                                                value="{{ $itemSatuanObat->rsatuan_kode }}">{{ $itemSatuanObat->rsatuan_nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label>Obat Ayam</label>
                                    <input type="text" placeholder="Obat Ayam" class="form-control text-right"
                                           wire:model="tkontrak_obat"
                                           id="tkontrak_obat">
                                    @error('tkontrak_obat') <label id="basic-error" class="validation-invalid-label"
                                                                   for="basic">{{$message}}</label>@enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-6" wire:ignore>
                                    <label>Upah Maklon </label>
                                    <input type="text" placeholder="Upah Maklon" class="form-control text-right"
                                           id="tkontrak_upahmaklon">
                                    <small>Khusus Jenis Kontrak Maklon</small>
                                    @error('tkontrak_upahmaklon') <label id="basic-error"
                                                                         class="validation-invalid-label"
                                                                         for="basic">{{$message}}</label>@enderror
                                </div>
                                <div class="col-sm-6" wire:ignore>
                                    <label>Biaya Operasional</label>
                                    <input type="text" placeholder="Biaya Operasional" class="form-control text-right"
                                           id="tkontrak_biayaops">
                                    @error('tkontrak_biayaops') <label id="basic-error" class="validation-invalid-label"
                                                                       for="basic">{{$message}}</label>@enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-12" wire:ignore>
                                    <label>Upah Pokok </label>
                                    <input type="text" placeholder="Upah Pokok" class="form-control text-right"
                                           id="tkontrak_upahpokok">
                                    @error('tkontrak_upahpokok') <label id="basic-error"
                                                                        class="validation-invalid-label"
                                                                        for="basic">{{$message}}</label>@enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                        <button wire:click.prevent="store" class="btn bg-primary">Submit form</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
<script type="text/javascript">
    $(function () {
        $('#syscustomer_id').select2();
        $('#syscustomer_id').on('change', function (e) {
            let data = $('#syscustomer_id').select2("val");
        @this.set('ottCustomers', data)
        });
        window.livewire.on('select2kandang', () => {
            $('#rkandang_id').select2();
            $('#rkandang_id').on('change', function (e) {
                let data = $('#rkandang_id').select2("val");
            @this.set('ottKandang', data)
            });
        });


        $('#rjeniskontrak_kode').select2();
        $('#rjeniskontrak_kode').on('change', function (e) {
            let data               = $('#rjeniskontrak_kode').select2("val");
            @this.set('ottJenisKontrak', data)
            let rjeniskontrak_kode = $('#rjeniskontrak_kode').val();
            if (rjeniskontrak_kode === '01') {
                $('#tkontrak_upahmaklon').attr('readonly', true);
            } else {
                $('#tkontrak_upahmaklon').attr('readonly', false);
            }
        });
        $('#runit_kode').select2();

        $('#runit_kode').on('change', function (e) {
            let data = $('#runit_kode').select2("val");
        @this.set('ottUnits', data)
        });
        $('#rsatuanpakan_kode').select2();
        $('#rsatuanpakan_kode').on('change', function (e) {
            let data = $('#rsatuanpakan_kode').select2("val");
        @this.set('ottSatuanPakan', data)
        });
        $('#rsatuanobat_kode').select2();
        $('#rsatuanobat_kode').on('change', function (e) {
            let data = $('#rsatuanobat_kode').select2("val");
        @this.set('ottSatuanObat', data)
        });

        $('#tkontrak_hargaayampcs,#tkontrak_upahmaklon,#tkontrak_biayaops,#tkontrak_upahpokok').autoNumeric('init', {
            aSep: '.',
            aDec: ','
        });
        $('#tkontrak_hargaayampcs').on('change', function (e) {
            let data = $('#tkontrak_hargaayampcs').val();
        @this.set('ottHargaAyam', data)
        });
        $('#tkontrak_upahmaklon').on('change', function (e) {
            let data = $('#tkontrak_upahmaklon').val();
        @this.set('ottUpahMaklon', data)
        });
        $('#tkontrak_biayaops').on('change', function (e) {
            let data = $('#tkontrak_biayaops').val();
        @this.set('ottBiayaOps', data)
        });
        $('#tkontrak_upahpokok').on('change', function (e) {
            let data = $('#tkontrak_upahpokok').val();
        @this.set('ottUpahPokok', data)
        });

        $('#tkontrak_tgl,#tkontrak_tglhabis').pickadate({
            format: 'dd-mm-yyyy',
        });
        $('#tkontrak_tgl').on('change', function (e) {
            let data = $('#tkontrak_tgl').val();
        @this.set('ottPickerTglKontrak', data)
        });
        $('#tkontrak_tglhabis').on('change', function (e) {
            let data = $('#tkontrak_tglhabis').val();
        @this.set('ottPickerTglHabis', data)
        });
    });
</script>
