<div>
    <div id="createModal" wire:ignore.self class="modal fade">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Customer</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <form action="#" class="form-horizontal">
                    <div class="modal-body">
                        <div class="form-group row">
                            <label class="col-form-label col-sm-3">Nama Lengkap</label>
                            <div class="col-sm-9">
                                <input type="text" placeholder="Nama Lengkap" wire:model="syscustomer_namalengkap"
                                       id="syscustomer_namalengkap"
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
                                       id="syscustomer_alamat"
                                       class="form-control" required>
                                @error('syscustomer_alamat') <label id="basic-error" class="validation-invalid-label"
                                                                    for="basic">{{$message}}</label>@enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-sm-3">Tempat Lahir</label>
                            <div class="col-sm-9">
                                <input type="text" placeholder="Tempat Lahir" wire:model="syscutomer_tempatlahir"
                                       id="syscutomer_tempatlahir"
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
                                       id="syscustomer_tgllahir"
                                       class="form-control" required>
                                @error('syscustomer_tgllahir') <label id="basic-error" class="validation-invalid-label"
                                                                      for="basic">{{$message}}</label>@enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-sm-3">Jenis Identitas</label>
                            <div class="col-sm-9" wire:ignore>
                                <select wire:model="rjid_kode" class="form-control" id="rjid_kode">
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
                                       id="syscustomer_noid"
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
                                                   wire:click="reset"
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

                                        <input type="hidden" name="wilayah" id="wilayah" wire:model="selectedWilayah">


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
                                       id="syscustomer_hp"
                                       class="form-control" required>
                                @error('syscustomer_hp') <label id="basic-error" class="validation-invalid-label"
                                                                for="basic">{{$message}}</label>@enderror
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
        $('#rjid_kode').select2();
        $('#rjid_kode').on('change', function (e) {
            let data = $('#rjid_kode').select2("val");
        @this.set('ottJids', data)
        });
        $('#syscustomer_tgllahir').pickadate({
            format: 'dd-mm-yyyy',
            selectYears: 99,
            selectMonths: true,
            max: moment().year(moment().year() - 17).toDate(),
        });
        $('#syscustomer_tgllahir').on('change', function (e) {
            let data = $('#syscustomer_tgllahir').val();
        @this.set('ottPickerTglLahir', data)
        });


    });
</script>
