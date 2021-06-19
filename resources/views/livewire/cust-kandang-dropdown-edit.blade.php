<div>
    <div class="form-group">
        <div class="row">
            <div class="col-sm-6" wire:ignore>
                <label>Nama Customer</label>
                <select wire:model="customer" class="form-control" id="syscustomer_id_edit">
                    <option value="">Pilih Customer</option>
                    @foreach($customers as $customer)
                        <option
                            value="{{ $customer->syscustomer_id }}">{{ $customer->syscustomer_namalengkap }}</option>
                    @endforeach
                </select>
            </div>
            @if(count($kandangs) > 0)
                <div class="col-sm-6" wire:ignore>
                    <label>Kandang</label>
                    <select wire:model="kandang" class="form-control {{ count($kandangs)==0 ? 'hidden' : '' }}"
                            id="rkandang_id_edit">
                        <option value="">Pilih Kandang</option>
                        @foreach($kandangs as $kandang)
                            <option
                                value="{{ $kandang->rkandang_id }}">{{ $kandang->rkandang_lokasi }}</option>
                        @endforeach
                    </select>
                </div>
            @endif
        </div>
    </div>

</div>
<script type="text/javascript">
    $(function (){
        $('#syscustomer_id_edit').on('change', function (e) {
            let data = $('#syscustomer_id_edit').select2("val");
        @this.set('customer', data)
        });

        $('#rkandang_id_edit').on('change', function (e) {
            let data = $('#rkandang_id_edit').select2("val");
        @this.set('kandang', data)
        });



    })
</script>

