<div>
    <div class="page-header page-header-light">
        <div class="page-header-content header-elements-md-inline">
            <div class="page-title d-flex">
                <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Master</span> - Kandang -
                    Edit Kandang
                </h4>
                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>
            @include('header-elements')
        </div>

        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
            <div class="d-flex">
                <div class="breadcrumb">
                    <a href="{{url('/')}}/home" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
                    <a href="#" class="breadcrumb-item">Master</a>
                    <a href="{{url('/')}}/master/kandang" class="breadcrumb-item">Kandang</a>
                    <span class="breadcrumb-item active">Edit Kandang</span>
                </div>

                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>

        </div>
    </div>
    <div class="content">
        @if (session()->has('success_message'))
            <div class="alert alert-success border-0 alert-dismissible">
                <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
                <span class="font-weight-semibold">Sukses!</span> {{ session('success_message') }}
            </div>
        @endif
        @if (session()->has('error_message'))
            <div class="alert alert-danger border-0 alert-dismissible">
                <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
                <span class="font-weight-semibold">Gagal!</span> {{ session('error_message') }}
            </div>
        @endif
        <div class="card">
            <div class="card-header header-elements-inline">
                <h5 class="card-title">Edit Kandang</h5>
            </div>

            <div class="card-body">
                <form>
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group" wire:ignore>
                                <label>Customer</label>
                                <select class="form-control" id="syscustomer_id">
                                    <option value="">Pilih Customer</option>
                                    @foreach($customer as $value)
                                        <option
                                            value="{{ $value->syscustomer_id }}">{{ $value->syscustomer_namalengkap }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Nama Kandang</label>
                                <input type="text" placeholder="Nama Kandang" wire:model="rkandang_nama"
                                       id="rkandang_nama"
                                       class="form-control" required>
                                @error('rkandang_nama') <label id="basic-error" class="validation-invalid-label"
                                                                 for="basic">{{$message}}</label>@enderror
                            </div>
                            <div class="form-group">
                                <label>Lokasi Kandang</label>
                                <input type="text" placeholder="Lokasi Kandang" wire:model="rkandang_lokasi"
                                       id="rkandang_lokasi"
                                       class="form-control" required>
                                @error('rkandang_lokasi') <label id="basic-error" class="validation-invalid-label"
                                                                 for="basic">{{$message}}</label>@enderror
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Ukuran Kandang (m2)</label>
                                        <input type="text" placeholder="Ukuran Kandang (m2)" wire:model="rkandang_size"
                                               id="rkandang_size"
                                               class="form-control" required>
                                        @error('rkandang_size') <label id="basic-error" class="validation-invalid-label"
                                                                       for="basic">{{$message}}</label>@enderror
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Daya Tampung</label>
                                        <input type="text" placeholder="Daya Tampung" wire:model="rkandang_dayatampung"
                                               id="rkandang_dayatampung"
                                               class="form-control" required>
                                        @error('rkandang_dayatampung') <label id="basic-error"
                                                                              class="validation-invalid-label"
                                                                              for="basic">{{$message}}</label>@enderror
                                    </div>

                                </div>
                            </div>


                        </div>
                        <div class="col-md-7">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group" wire:ignore>
                                        <label>Kondisi Jalan</label>
                                        <select class="form-control" id="rkondjalan_kode">
                                            <option value="">Pilih Kondisi Jalan</option>
                                            @foreach($kondjalan as $value)
                                                <option
                                                    value="{{ $value->rkondjalan_kode }}">{{ $value->rkondjalan_nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Foto Kandang 1 Sebelumnya</label><br/>
                                                <a
                                                    href="{{url('/')}}/public/foto_kandang/{{ $rkandang_foto1_before }}"
                                                    data-popup="lightbox"><img
                                                        src="{{url('/')}}/public/foto_kandang/{{$rkandang_foto1_before }}"
                                                        class="img-preview rounded"> </a></td>

                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Foto Kandang 1</label>
                                                <input type="file" class="form-control" wire:model="rkandang_foto1">
                                                @error('rkandang_foto1') <span
                                                    class="text-danger">{{ $message }}</span> @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                   <div class="row">
                                       <div class="col-md-6">
                                           <div class="form-group">
                                               <label>Foto Kandang 2 Sebelumnya</label><br/>
                                               <a
                                                   href="{{url('/')}}/public/foto_kandang/{{ $rkandang_foto2_before }}"
                                                   data-popup="lightbox"><img
                                                       src="{{url('/')}}/public/foto_kandang/{{$rkandang_foto2_before }}"
                                                       class="img-preview rounded"> </a></td>

                                           </div>

                                       </div>
                                       <div class="col-md-6">
                                           <div class="form-group">
                                               <label>Foto Kandang 2</label>
                                               <input type="file" class="form-control" wire:model="rkandang_foto2">
                                               @error('rkandang_foto2') <span
                                                   class="text-danger">{{ $message }}</span> @enderror
                                           </div>
                                       </div>
                                   </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Foto Kandang 3 Sebelumnya</label><br/>
                                                <a
                                                    href="{{url('/')}}/public/foto_kandang/{{ $rkandang_foto3_before }}"
                                                    data-popup="lightbox"><img
                                                        src="{{url('/')}}/public/foto_kandang/{{$rkandang_foto3_before }}"
                                                        class="img-preview rounded"> </a></td>

                                            </div>

                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Foto Kandang 3</label>
                                                <input type="file" class="form-control" wire:model="rkandang_foto3">
                                                @error('rkandang_foto3') <span
                                                    class="text-danger">{{ $message }}</span> @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Foto Kandang 4 Sebelumnya</label><br/>
                                                <a
                                                    href="{{url('/')}}/public/foto_kandang/{{ $rkandang_foto4_before }}"
                                                    data-popup="lightbox"><img
                                                        src="{{url('/')}}/public/foto_kandang/{{$rkandang_foto4_before }}"
                                                        class="img-preview rounded"> </a></td>

                                            </div>

                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Foto Kandang 4</label>
                                                <input type="file" class="form-control" wire:model="rkandang_foto4">
                                                @error('rkandang_foto4') <span
                                                    class="text-danger">{{ $message }}</span> @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="text-right">
                        <button wire:click.prevent="update" class="btn btn-primary">Simpan <i
                                class="icon-paperplane ml-2"></i>
                        </button>
                        <a href="{{url('/')}}/master/kandang" class="btn btn-danger"><i class="icon-arrow-left8"></i>
                            Back to List </a>
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
        @this.set('ottCustomer', data)
        });
        $("#syscustomer_id").select2("trigger", "select", {
            data: {id: '{{$syscustomer_id}}'}
        });

        $('#rkondjalan_kode').select2();
        $('#rkondjalan_kode').on('change', function (e) {
            let data = $('#rkondjalan_kode').select2("val");
        @this.set('ottKondjalan', data)
        });
        $("#rkondjalan_kode").select2("trigger", "select", {
            data: {id: '{{$rkondjalan_kode}}'}
        });
        $('[data-popup="lightbox"]').fancybox({
            padding: 3
        });
        $('#rkandang_foto1_before').attr('src', '{{url('/')}}/public/foto_kandang/{{$rkandang_foto1}}')
        $('#rkandang_foto2_before').attr('src', '{{url('/')}}/public/foto_kandang/{{$rkandang_foto2}}')
        $('#rkandang_foto3_before').attr('src', '{{url('/')}}/public/foto_kandang/{{$rkandang_foto3}}')
        $('#rkandang_foto4_before').attr('src', '{{url('/')}}/public/foto_kandang/{{$rkandang_foto4}}')


    })
</script>
