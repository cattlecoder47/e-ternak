<div id="galleryModal" wire:ignore.self class="modal fade" tabindex="-1">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header pb-3">
                <h5 class="modal-title">Gallery Kandang</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body py-0">
                <table class="table">
                    <tr>
                        <td class="text-center"><a
                                href="{{url('/')}}/public/foto_kandang/{{ $g_rkandang_foto1 }}"
                                data-popup="lightbox"><img
                                    src="{{url('/')}}/public/foto_kandang/{{ $g_rkandang_foto1}}"
                                    class="img-preview rounded"> </a></td>
                        <td class="text-center"><a
                                href="{{url('/')}}/public/foto_kandang/{{ $g_rkandang_foto2 }}"
                                data-popup="lightbox"><img
                                    src="{{url('/')}}/public/foto_kandang/{{ $g_rkandang_foto2}}"
                                    class="img-preview rounded"> </a></td>
                    </tr>
                    <tr>
                        <td class="text-center"><a
                                href="{{url('/')}}/public/foto_kandang/{{ $g_rkandang_foto3 }}"
                                data-popup="lightbox"><img
                                    src="{{url('/')}}/public/foto_kandang/{{ $g_rkandang_foto3}}"
                                    class="img-preview rounded"> </a></td>
                        <td class="text-center"><a
                                href="{{url('/')}}/public/foto_kandang/{{ $g_rkandang_foto4 }}"
                                data-popup="lightbox"><img
                                    src="{{url('/')}}/public/foto_kandang/{{ $g_rkandang_foto4}}"
                                    class="img-preview rounded"> </a></td>
                    </tr>
                </table>
            </div>

            <div class="modal-footer pt-3">
                <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
