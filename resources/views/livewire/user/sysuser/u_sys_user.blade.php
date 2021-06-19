<div>
    <div id="updateModal" wire:ignore.self class="modal fade">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Pengguna</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <form action="#" class="form-horizontal">
                    <div class="modal-body">
                        <div class="form-group row">
                            <label class="col-form-label col-sm-3">Role</label>
                            <div class="col-sm-9" wire:ignore>
                                <select class="form-control" id="sysrole_kode_edit">
                                    <option value="">Pilih Role</option>
                                    @foreach($roles as $itemRole)
                                        <option
                                            value="{{ $itemRole->sysrole_kode }}">{{ $itemRole->sysrole_nama }}</option>
                                    @endforeach
                                </select>
                                @error('sysrole_kode') <label id="basic-error" class="validation-invalid-label"
                                                              for="basic">{{$message}}</label>@enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-sm-3">Unit</label>
                            <div class="col-sm-9" wire:ignore>
                                <select class="form-control" id="runit_kode_edit">
                                    <option value="">Pilih Unit</option>
                                    @foreach($units as $value)
                                        <option
                                            value="{{ $value->runit_kode }}">{{ $value->runit_nama }}</option>
                                    @endforeach
                                </select>
                                @if (\App\Helpers\Utility::getSession('isAdmin')=='1')
                                    <span class="text-muted">(*Kosongkan jika user sebagai super admin)</span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-form-label col-sm-3">Username</label>
                            <div class="col-sm-9">
                                <input type="text" placeholder="Username" wire:model="sysuser_nama"
                                       id="sysuser_nama_edit"
                                       class="form-control" required>
                                @error('sysuser_nama') <label id="basic-error" class="validation-invalid-label"
                                                              for="basic">{{$message}}</label>@enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-sm-3">Nama Lengkap</label>
                            <div class="col-sm-9">
                                <input type="text" placeholder="Nama Lengkap" wire:model="sysuser_namalengkap"
                                       id="sysuser_namalengkap_edit"
                                       class="form-control" required>
                                @error('sysuser_namalengkap') <label id="basic-error" class="validation-invalid-label"
                                                                     for="basic">{{$message}}</label>@enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-sm-3">HP</label>
                            <div class="col-sm-9">
                                <input type="text" placeholder="HP" wire:model="sysuser_hp"
                                       id="sysuser_hp_edit"
                                       class="form-control" required>
                                @error('sysuser_hp') <label id="basic-error" class="validation-invalid-label"
                                                            for="basic">{{$message}}</label>@enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-sm-3">Email</label>
                            <div class="col-sm-9">
                                <input type="text" placeholder="Email" wire:model="sysuser_email"
                                       id="sysuser_email_edit"
                                       class="form-control" required>
                                @error('sysuser_email') <label id="basic-error" class="validation-invalid-label"
                                                               for="basic">{{$message}}</label>@enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-sm-3">Otorize</label>
                            <div class="col-sm-9" wire:ignore>
                                <select class="form-control" id="sysuser_otorize_edit">
                                    <option value="">Pilih Otorize</option>
                                    <option value="1">Ya</option>
                                    <option value="0">Tidak</option>
                                </select>

                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" wire:click.prevent="cancel()" class="btn btn-link" data-dismiss="modal">Close</button>
                        <button wire:click.prevent="update" class="btn bg-primary">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    $(function () {
        $('#sysrole_kode_edit,#sysuser_otorize_edit,#runit_kode_edit').select2();
        $('#sysrole_kode_edit').on('change', function (e) {
            let data = $('#sysrole_kode_edit').select2("val");
        @this.set('ottRoles', data)
        });
        $('#sysuser_otorize_edit').on('change', function (e) {
            let data = $('#sysuser_otorize_edit').select2("val");
        @this.set('ottOtorize', data)
        });
        $('#runit_kode_edit').on('change', function (e) {
            let data = $('#runit_kode_edit').select2("val");
        @this.set('ottUnits', data)
        });
        window.livewire.on('selectedRoleKode', sysrole_kode => {
            $("#sysrole_kode_edit").select2("trigger", "select", {
                data: {id: sysrole_kode}
            });
        });
        window.livewire.on('selectedOtorize', sysuser_otorize => {
            $("#sysuser_otorize_edit").select2("trigger", "select", {
                data: {id: sysuser_otorize}
            });
        });
        window.livewire.on('selectedUnit', runit_kode => {
            $("#runit_kode_edit").select2("trigger", "select", {
                data: {id: runit_kode}
            });
        });


        window.livewire.on('sysuserUpdate', () => {
            $('#updateModal').modal('hide');
        });
    });
</script>
