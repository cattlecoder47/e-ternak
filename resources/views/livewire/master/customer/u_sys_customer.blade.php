<div>
    <div id="updateModal" wire:ignore.self class="modal fade" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Customer</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <form action="#" class="form-horizontal">
                    <div class="modal-body">
                        <div class="form-group row">
                            <label class="col-form-label col-sm-3">ID Customer</label>
                            <div class="col-sm-9">
                                <input type="text" wire:model="syscustomer_id"
                                       id="syscustomer_id" readonly
                                       class="form-control" required>

                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-sm-3">Nama Lengkap</label>
                            <div class="col-sm-9">
                                <input type="text" placeholder="Nama Lengkap" wire:model="syscustomer_namalengkap"
                                       id="syscustomer_namalengkap_edit"
                                       class="form-control" required>
                                @error('syscustomer_namalengkap') <label id="basic-error"
                                                                         class="validation-invalid-label"
                                                                         for="basic">{{$message}}</label>@enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-sm-3">Alamat</label>
                            <div class="col-sm-9">
                                <input type="text" placeholder="Alamat" wire:model="syscustomer_alamat"
                                       id="syscustomer_alamat_edit"
                                       class="form-control" required>
                                @error('syscustomer_alamat') <label id="basic-error" class="validation-invalid-label"
                                                                    for="basic">{{$message}}</label>@enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-sm-3">Tempat Lahir</label>
                            <div class="col-sm-9">
                                <input type="text" placeholder="Tempat Lahir" wire:model="syscutomer_tempatlahir"
                                       id="syscutomer_tempatlahir_edit"
                                       class="form-control" required>
                                @error('syscutomer_tempatlahir') <label id="basic-error"
                                                                        class="validation-invalid-label"
                                                                        for="basic">{{$message}}</label>@enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-sm-3">Tgl Lahir</label>
                            <div class="col-sm-9" wire:ignore>
                                <input type="text" placeholder="Tgl Lahir"
                                       id="syscustomer_tgllahir_edit"
                                       class="form-control" required>
                                @error('syscustomer_tgllahir') <label id="basic-error" class="validation-invalid-label"
                                                                      for="basic">{{$message}}</label>@enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-sm-3">Jenis Identitas</label>
                            <div class="col-sm-9" wire:ignore>
                                <select  class="form-control" id="rjid_kode_edit">
                                    <option value="">Pilih Jenis identitas</option>
                                    @foreach($jids as $itemJid)
                                        <option value="{{ $itemJid->rjid_kode }}">{{ $itemJid->rjid_nama }}</option>
                                    @endforeach
                                </select>
                                @error('rjid_kode') <label id="basic-error" class="validation-invalid-label"
                                                           for="basic">{{$message}}</label>@enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-sm-3">No Identitas</label>
                            <div class="col-sm-9">
                                <input type="text" placeholder="No Identitas" wire:model="syscustomer_noid"
                                       id="syscustomer_noid_edit"
                                       class="form-control" required>
                                @error('syscustomer_noid') <label id="basic-error" class="validation-invalid-label"
                                                                  for="basic">{{$message}}</label>@enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-sm-3">Wilayah</label>
                            <div class="col-sm-9">
                                <div class="relative">
                                    <div class="relative">
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Cari Kelurahan"
                                                   wire:model="query"
                                                   wire:keydown.escape="hideDropdown"
                                                   wire:keydown.tab="hideDropdown"
                                                   wire:keydown.Arrow-Up="decrementHighlight"
                                                   wire:keydown.Arrow-Down="incrementHighlight"
                                                   wire:keydown.enter.prevent="selectWilayah"
                                            >
                                            @if ($selectedWilayah)
                                                <span class="input-group-append">
												<button class="btn btn-danger" wire:click="reset"
                                                        type="button"><i class="icon-close2"></i> </button>
											</span>
                                            @endif

                                        </div>

                                        <input type="hidden" name="wilayah" id="wilayah_edit"
                                               wire:model="selectedWilayah">


                                    </div>

                                    @if(!empty($query) && $selectedWilayah == 0 && $showDropdown)
                                        <table class="table table-condensed">
                                            @if (!empty($wilayahs))
                                                @foreach($wilayahs as $i => $wilayah)

                                                    <tr>
                                                        <td>
                                                            <a href="#" wire:click="selectWilayah({{ $i }})"
                                                               class="text-default cursor-pointer">{{ $wilayah['nama_wilayah'] }}</a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td>No Results</td>
                                                </tr>
                                            @endif

                                        </table>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-sm-3">HP</label>
                            <div class="col-sm-9">
                                <input type="text" placeholder="HP" wire:model="syscustomer_hp"
                                       id="syscustomer_hp_edit"
                                       class="form-control" required>
                                @error('syscustomer_hp') <label id="basic-error" class="validation-invalid-label"
                                                                for="basic">{{$message}}</label>@enderror
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
<script>
    $(function () {
        $('#rjid_kode_edit').select2();
        $('#rjid_kode_edit').on('change', function (e) {
            let data = $('#rjid_kode_edit').select2("val");
        @this.set('ottJids', data)
        });

        $('#syscustomer_tgllahir_edit').pickadate({
            format: 'dd-mm-yyyy',
            selectYears: 99,
            selectMonths: true,
            max: moment().year(moment().year() - 17).toDate(),
        });
        $('#syscustomer_tgllahir_edit').on('change', function (e) {
            let data = $('#syscustomer_tgllahir_edit').val();
        @this.set('ottPickerTglLahir', data)
        });


        window.livewire.on('selectedJidKode', rjid_kode => {
            $("#rjid_kode_edit").select2("trigger", "select", {
                data: {id: rjid_kode}
            });
        });
        window.livewire.on('selectedTglLahir', syscustomer_tgllahir => {
            $('#syscustomer_tgllahir_edit').val(syscustomer_tgllahir);
        @this.set('ottPickerTglLahir', syscustomer_tgllahir)
        });
        window.livewire.on('customerUpdate', () => {
            $('#updateModal').modal('hide');
        });
    });
</script>

