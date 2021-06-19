<div id="detailModal" wire:ignore.self class="modal fade" tabindex="-1">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header pb-3">
                <h5 class="modal-title">Detail Kontrak</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body py-0">
                <div class="table-responsive">
                    <table class="table">
                        <tbody>
                        <tr>
                            <td>ID Kontrak</td>
                            <td>:</td>
                            <td>{{$d_tkontrak_id}}</td>
                        </tr>
                        <tr>
                            <td>Jenis Kontrak</td>
                            <td>:</td>
                            <td>{{$d_rjeniskontrak_nama}}</td>
                        </tr>
                        <tr>
                            <td>Tgl Kontrak</td>
                            <td>:</td>
                            <td>{{$d_tkontrak_tgl}}</td>
                        </tr>
                        <tr>
                            <td>Tgl Habis Kontrak</td>
                            <td>:</td>
                            <td>{{$d_tkontrak_tglhabis}}</td>
                        </tr>
                        <tr>
                            <td>No Kontrak</td>
                            <td>:</td>
                            <td>{{$d_tkontrak_no}}</td>
                        </tr>
                        <tr>
                            <td>Nama Customer</td>
                            <td>:</td>
                            <td>{{$d_syscustomer_namalengkap}}</td>
                        </tr>
                        <tr>
                            <td>Lokasi Kandang</td>
                            <td>:</td>
                            <td>{{$d_rkandang_lokasi}}</td>
                        </tr>
                        <tr>
                            <td>Ukuran Kandang</td>
                            <td>:</td>
                            <td>{{$d_rkandang_size}} m2</td>
                        </tr>
                        <tr>
                            <td>Daya Tampung Kandang</td>
                            <td>:</td>
                            <td>{{$d_rkandang_dayatampung}}</td>
                        </tr>
                        <tr>
                            <td>Nama Unit</td>
                            <td>:</td>
                            <td>{{$d_runit_nama}}</td>
                        </tr>
                        <tr>
                            <td>Pimpinan Unit</td>
                            <td>:</td>
                            <td>{{$d_runit_pimpinan}}</td>
                        </tr>
                        <tr>
                            <td>Nama Kontrak</td>
                            <td>:</td>
                            <td>{{$d_tkontrak_nama}}</td>
                        </tr>
                        <tr>
                            <td>Jumlah Ayam</td>
                            <td>:</td>
                            <td>{{$d_tkontrak_jmlayam}}</td>
                        </tr>
                        <tr>
                            <td>Harga Ayam (pcs)</td>
                            <td>:</td>
                            <td>{{$d_tkontrak_hargaayampcs}}</td>
                        </tr>
                        <tr>
                            <td>Pakan Ayam</td>
                            <td>:</td>
                            <td>{{$d_tkontrak_pakan}} {{$d_rsatuanpakan_kode}}</td>
                        </tr>
                        <tr>
                            <td>Obat</td>
                            <td>:</td>
                            <td>{{$d_tkontrak_obat}} {{$d_rsatuanobat_kode}}</td>
                        </tr>
                        <tr>
                            <td>Upah Maklon</td>
                            <td>:</td>
                            <td>{{$d_tkontrak_upahmaklon}}</td>
                        </tr>
                        <tr>
                            <td>Biaya Operasional</td>
                            <td>:</td>
                            <td>{{$d_tkontrak_biayaops}}</td>
                        </tr>
                        <tr>
                            <td>Upah Pokok</td>
                            <td>:</td>
                            <td>{{$d_tkontrak_upahpokok}}</td>
                        </tr>
                        <tr>
                            <td>Tgl Input Kontrak</td>
                            <td>:</td>
                            <td>{{$d_tkontrak_create_at}}</td>
                        </tr>
                        <tr>
                            <td>Diinput Oleh</td>
                            <td>:</td>
                            <td>{{$d_sysuser_nama}}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="modal-footer pt-3">
                <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
