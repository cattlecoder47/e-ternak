<div>
    <div id="updateModal" wire:ignore.self class="modal fade" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Setting Insentif</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <form action="#" class="form-horizontal">
                    <div class="modal-body">
                        <div class="form-group row">
                            <label class="col-form-label col-sm-3">Kode Insentif</label>
                            <div class="col-sm-9">
                                <input type="text" wire:model="rinsentif_kode"
                                       id="rinsentif_kode" readonly
                                       class="form-control" required>
                                <input type="hidden" wire:model="rjinsentif_kode" id="rjinsentif_kode">

                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-sm-3">Minimum</label>
                            <div class="col-sm-9" wire:ignore>
                                <input type="text" placeholder="Minimum"
                                       id="rinsentif_min"`
                                       class="form-control text-right" required>
                                @error('rinsentif_min') <label id="basic-error"
                                                               class="validation-invalid-label"
                                                               for="basic">{{$message}}</label>@enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-sm-3">Maximum</label>
                            <div class="col-sm-9" wire:ignore>
                                <input type="text" placeholder="Maximum"
                                       id="rinsentif_max"
                                       class="form-control text-right" required>
                                @error('rinsentif_max') <label id="basic-error" class="validation-invalid-label"
                                                               for="basic">{{$message}}</label>@enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-sm-3">Nominal</label>
                            <div class="col-sm-9" wire:ignore>
                                <input type="text" placeholder="Nominal"
                                       id="rinsentif_nominal"
                                       class="form-control text-right" required>
                                @error('rinsentif_nominal') <label id="basic-error" class="validation-invalid-label"
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
        $('#rinsentif_min,#rinsentif_max,#rinsentif_nominal').autoNumeric('init', {
            aSep: '.',
            aDec: ','
        });
        $('#rinsentif_min').on('change', function (e) {
            let data = $('#rinsentif_min').val();
        @this.set('ottRinsentifMin', data)
        });
        $('#rinsentif_max').on('change', function (e) {
            let data = $('#rinsentif_max').val();
        @this.set('ottRinsentifMax', data)
        });
        $('#rinsentif_nominal').on('change', function (e) {
            let data = $('#rinsentif_nominal').val();
        @this.set('ottRinsentifNominal', data)
        });

        window.livewire.on('selectedRinsentifMin', rinsentif_min => {
            $('#rinsentif_min').val(rinsentif_min);
        });
        window.livewire.on('selectedRinsentifMax', rinsentif_max => {
            $('#rinsentif_max').val(rinsentif_max);
        });
        window.livewire.on('selectedRinsentifNominal', rinsentif_nominal => {
            $('#rinsentif_nominal').val(rinsentif_nominal);
        });

    });
</script>

