<div>
    <div id="createModal" wire:ignore.self class="modal fade" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Unit</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <form action="#" class="form-horizontal">
                    <div class="modal-body">
                        <div class="form-group row">
                            <label class="col-form-label col-sm-3">Nama Unit</label>
                            <div class="col-sm-9">
                                <input type="text" placeholder="Nama Unit" wire:model="runit_nama"
                                       id="runit_nama"
                                       class="form-control" required>
                                @error('runit_nama') <label id="basic-error" class="validation-invalid-label"
                                                                    for="basic">{{$message}}</label>@enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-sm-3">Alamat Unit</label>
                            <div class="col-sm-9">
                                <input type="text" placeholder="Alamat Unit" wire:model="runit_alamat"
                                       id="runit_alamat"
                                       class="form-control" required>
                                @error('runit_alamat') <label id="basic-error" class="validation-invalid-label"
                                                                    for="basic">{{$message}}</label>@enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-sm-3">Pimpinan Unit</label>
                            <div class="col-sm-9">
                                <input type="text" placeholder="Pimpinan Unit" wire:model="runit_pimpinan"
                                       id="runit_pimpinan"
                                       class="form-control" required>
                                @error('runit_pimpinan') <label id="basic-error" class="validation-invalid-label"
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
