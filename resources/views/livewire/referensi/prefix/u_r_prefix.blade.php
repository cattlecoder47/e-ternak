<div>
    <div id="updateModal" wire:ignore.self class="modal fade" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">EditPrefix</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <form action="#" class="form-horizontal">
                    <div class="modal-body">
                        <div class="form-group row">
                            <label class="col-form-label col-sm-3">Nama Tabel</label>
                            <div class="col-sm-9">
                                <input type="text" placeholder="Nama Tabel" wire:model="rprefix_tablename"
                                       id="rprefix_tablename"
                                       class="form-control" required readonly>
                                @error('rprefix_tablename') <label id="basic-error" class="validation-invalid-label"
                                                                   for="basic">{{$message}}</label>@enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-sm-3">Nama ID Field</label>
                            <div class="col-sm-9">
                                <input type="text" placeholder="Nama ID Field" wire:model="rprefix_fieldid"
                                       id="rprefix_fieldid"
                                       class="form-control" required>
                                @error('rprefix_fieldid') <label id="basic-error" class="validation-invalid-label"
                                                                 for="basic">{{$message}}</label>@enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-sm-3">Kode Prefix</label>
                            <div class="col-sm-9">
                                <input type="text" placeholder="Kode Prefix" wire:model="rprefix_kode"
                                       id="rprefix_kode"
                                       class="form-control" required>
                                @error('rprefix_kode') <label id="basic-error" class="validation-invalid-label"
                                                              for="basic">{{$message}}</label>@enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-sm-3">Length Prefix</label>
                            <div class="col-sm-9">
                                <input type="text" placeholder="Length Prefix" wire:model="rprefix_idlength"
                                       id="rprefix_idlength"
                                       class="form-control" required>
                                @error('rprefix_idlength') <label id="basic-error" class="validation-invalid-label"
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
