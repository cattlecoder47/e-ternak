<div>
    <div id="createModal" wire:ignore.self class="modal fade" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Jenis Kontrak</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <form action="#" class="form-horizontal">
                    <div class="modal-body">
                        <div class="form-group row">
                            <label class="col-form-label col-sm-3">Nama Jenis Kontrak</label>
                            <div class="col-sm-9">
                                <input type="text" placeholder="Nama Jenis Kontrak" wire:model="rjeniskontrak_nama"
                                       id="rjeniskontrak_nama"
                                       class="form-control" required>
                                @error('rjeniskontrak_nama') <label id="basic-error" class="validation-invalid-label"
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
