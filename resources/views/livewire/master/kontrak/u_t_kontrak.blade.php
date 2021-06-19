<div>
    <div id="updateModal" wire:ignore.self class="modal fade">
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
                                <div class="col-sm-12">
                                    <label>ID Kontrak</label>
                                    <input type="text" class="form-control"
                                           wire:model="tkontrak_id"
                                           id="tkontrak_id_edit" readonly>

                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-6" wire:ignore>
                                    <label>Jenis Kontrak</label>
                                    <select class="form-control" id="rjeniskontrak_kode_edit">
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
                                           id="tkontrak_no_edit">
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
                                           id="tkontrak_tgl_edit"
                                           class="form-control" required>
                                </div>
                                <div class="col-sm-6" wire:ignore>
                                    <label>Tgl Habis Kontrak</label>
                                    <input type="text" placeholder="Tgl Habis Kontrak"
                                           id="tkontrak_tglhabis_edit"
                                           class="form-control" required>
                                </div>

                            </div>
                        </div>
                        @livewire('cust-kandang-dropdown-edit')


                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-6" wire:ignore>
                                    <label>Unit</label>
                                    <select class="form-control" id="runit_kode_edit">
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
                                           id="tkontrak_nama_edit">
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
                                           id="tkontrak_jmlayam_edit">
                                    @error('tkontrak_jmlayam') <label id="basic-error" class="validation-invalid-label"
                                                                      for="basic">{{$message}}</label>@enderror
                                </div>
                                <div class="col-sm-6" wire:ignore>
                                    <label>Harga Ayam (pcs)</label>
                                    <input type="text" placeholder="Harga Ayam (pcs)" class="form-control text-right"
                                           id="tkontrak_hargaayampcs_edit">
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
                                    <select class="form-control text-right"
                                            id="rsatuanpakan_kode_edit">
                                        <option value="">Pilih Satuan Pakan</option>
                                        @foreach($satuan as $itemSatuanPakan)
                                            <option
                                                value="{{ $itemSatuanPakan->rsatuan_kode }}">{{ $itemSatuanPakan->rsatuan_nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label>Pakan Ayam</label>
                                    <input type="text" placeholder="Pakan Ayam" class="form-control"
                                           wire:model="tkontrak_pakan"
                                           id="tkontrak_pakan_edit">
                                    @error('tkontrak_pakan') <label id="basic-error" class="validation-invalid-label"
                                                                    for="basic">{{$message}}</label>@enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-6" wire:ignore>
                                    <label>Satuan Obat Ayam</label>
                                    <select class="form-control"
                                            id="rsatuanobat_kode_edit">
                                        <option value="">Pilih Satuan Pakan</option>
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
                                           id="tkontrak_obat_edit">
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
                                           id="tkontrak_upahmaklon_edit">
                                    <small>Khusus Jenis Kontrak Maklon</small>
                                    @error('tkontrak_upahmaklon') <label id="basic-error"
                                                                         class="validation-invalid-label"
                                                                         for="basic">{{$message}}</label>@enderror
                                </div>
                                <div class="col-sm-6" wire:ignore>
                                    <label>Biaya Operasional</label>
                                    <input type="text" placeholder="Biaya Operasional" class="form-control text-right"
                                           id="tkontrak_biayaops_edit">
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
                                           id="tkontrak_upahpokok_edit">
                                    @error('tkontrak_upahpokok') <label id="basic-error"
                                                                        class="validation-invalid-label"
                                                                        for="basic">{{$message}}</label>@enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" wire:click.prevent="cancel()" class="btn btn-link" data-dismiss="modal">
                            Cancel
                        </button>
                        <button wire:click.prevent="update" class="btn bg-primary" data-dismiss="modal">Simpan
                            Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
<script type="text/javascript">
    $(function () {
        $('#rjeniskontrak_kode_edit').select2();
        $('#rjeniskontrak_kode_edit').on('change', function (e) {
            let data               = $('#rjeniskontrak_kode_edit').select2("val");
            @this.set('ottJenisKontrak', data)
            let rjeniskontrak_kode = $('#rjeniskontrak_kode_edit').val();
            if (rjeniskontrak_kode === '01') {
                $('#tkontrak_upahmaklon_edit').attr('readonly', true);
            } else {
                $('#tkontrak_upahmaklon_edit').attr('readonly', false);
            }
        });
        $('#syscustomer_id_edit').select2();
        $('#syscustomer_id_edit').on('change', function (e) {
            let data = $('#syscustomer_id_edit').select2("val");
        @this.set('ottCustomers', data)
        });
        window.livewire.on('select2kandangEdit', () => {
            $('#rkandang_id_edit').select2();
            $('#rkandang_id_edit').on('change', function (e) {
                let data = $('#rkandang_id_edit').select2("val");
            @this.set('ottKandang', data)
            });

        });

        $('#runit_kode_edit').select2();
        $('#runit_kode_edit').on('change', function (e) {
            let data = $('#runit_kode_edit').select2("val");
        @this.set('ottUnits', data)
        });
        $('#rsatuanpakan_kode_edit').select2();
        $('#rsatuanpakan_kode_edit').on('change', function (e) {
            let data = $('#rsatuanpakan_kode_edit').select2("val");
        @this.set('ottSatuanPakan', data)
        });
        $('#rsatuanobat_kode_edit').select2();
        $('#rsatuanobat_kode_edit').on('change', function (e) {
            let data = $('#rsatuanobat_kode_edit').select2("val");
        @this.set('ottSatuanObat', data)
        });

        $('#tkontrak_hargaayampcs_edit,#tkontrak_upahmaklon_edit,#tkontrak_biayaops_edit,#tkontrak_upahpokok_edit').autoNumeric('init', {
            aSep: '.',
            aDec: ','
        });
        $('#tkontrak_hargaayampcs_edit').on('change', function (e) {
            let data = $('#tkontrak_hargaayampcs_edit').val();
        @this.set('ottHargaAyam', data)
        });
        $('#tkontrak_upahmaklon_edit').on('change', function (e) {
            let data = $('#tkontrak_upahmaklon_edit').val();
        @this.set('ottUpahMaklon', data)
        });
        $('#tkontrak_biayaops_edit').on('change', function (e) {
            let data = $('#tkontrak_biayaops_edit').val();
        @this.set('ottBiayaOps', data)
        });
        $('#tkontrak_upahpokok_edit').on('change', function (e) {
            let data = $('#tkontrak_upahpokok_edit').val();
        @this.set('ottUpahPokok', data)
        });

        $('#tkontrak_tgl_edit,#tkontrak_tglhabis_edit').pickadate({
            format: 'dd-mm-yyyy',
        });
        $('#tkontrak_tgl_edit').on('change', function (e) {
            let data = $('#tkontrak_tgl_edit').val();
        @this.set('ottPickerTglKontrak', data)
        });

        $('#tkontrak_tglhabis_edit').on('change', function (e) {
            let data = $('#tkontrak_tglhabis_edit').val();
        @this.set('ottPickerTglHabis', data)
        });


        window.livewire.on('selectedjenisKontrak', rjeniskontrak_kode => {
            $("#rjeniskontrak_kode_edit").select2("trigger", "select", {
                data: {id: rjeniskontrak_kode}
            });
            if (rjeniskontrak_kode === '01') {
                $('#tkontrak_upahmaklon_edit').attr('readonly', true);
            } else {
                $('#tkontrak_upahmaklon_edit').attr('readonly', false);
            }
        });

        window.livewire.on('selectedCustomer', syscustomer_id => {
            $("#syscustomer_id_edit").select2("trigger", "select", {
                data: {id: syscustomer_id}
            });
        });
        window.livewire.on('selectedUnit', runit_kode => {
            $("#runit_kode_edit").select2("trigger", "select", {
                data: {id: runit_kode}
            });
        });
        window.livewire.on('selectedSatuanPakan', rsatuanpakan_kode => {
            $("#rsatuanpakan_kode_edit").select2("trigger", "select", {
                data: {id: rsatuanpakan_kode}
            });
        });
        window.livewire.on('selectedSatuanObat', rsatuanobat_kode => {
            $("#rsatuanobat_kode_edit").select2("trigger", "select", {
                data: {id: rsatuanobat_kode}
            });
        });

        window.livewire.on('selectedHargaAyam', tkontrak_hargaayampcs => {
            $('#tkontrak_hargaayampcs_edit').val(tkontrak_hargaayampcs);
        @this.set('ottHargaAyam', tkontrak_hargaayampcs)
        });
        window.livewire.on('selectedUpahMaklon', tkontrak_upahmaklon => {
            $('#tkontrak_upahmaklon_edit').val(tkontrak_upahmaklon);
        @this.set('ottUpahMaklon', tkontrak_upahmaklon)

        });
        window.livewire.on('selectedBiayaOps', tkontrak_biayaops => {
            $('#tkontrak_biayaops_edit').val(tkontrak_biayaops);
        @this.set('ottBiayaOps', tkontrak_biayaops)

        });
        window.livewire.on('selectedUpahPokok', tkontrak_upahpokok => {
            $('#tkontrak_upahpokok_edit').val(tkontrak_upahpokok);
        @this.set('ottUpahPokok', tkontrak_upahpokok)

        });
        window.livewire.on('selectedTglKontrak', tkontrak_tgl => {
            $('#tkontrak_tgl_edit').val(tkontrak_tgl);
        @this.set('ottPickerTglKontrak', tkontrak_tgl)

        });
        window.livewire.on('selectedTglHabis', tkontrak_tglhabis => {
            $('#tkontrak_tglhabis_edit').val(tkontrak_tglhabis);
        @this.set('ottPickerTglHabis', tkontrak_tglhabis)

        });
    });
</script>
