<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed tkontrak_id
 * @property mixed rjeniskontrak_kode
 * @property mixed tkontrak_tgl
 * @property mixed tkontrak_no
 * @property mixed syscustomer_id
 * @property mixed rkandang_id
 * @property mixed runit_kode
 * @property mixed tkontrak_nama
 * @property mixed tkontrak_jmlayam
 * @property mixed tkontrak_hargaayampcs
 * @property mixed rsatuanpakan_kode
 * @property mixed tkontrak_pakan
 * @property mixed rsatuanobat_kode
 * @property mixed tkontrak_obat
 * @property mixed tkontrak_upahmaklon
 * @property mixed tkontrak_biayaops
 * @property mixed tkontrak_upahpokok
 * @property mixed tkontrak_tglhabis
 * @property mixed tkontrak_create_at
 * @property mixed tkontrak_update_at
 * @property mixed sysuser_id
 * @method static where(string $string, $id)
 * @method static find($id)
 * @method static get()
 * @method static create(array $array)
 */
class T_kontrak extends Model
{
    protected $table = "t_kontrak";
    public $timestamps = false;
    protected $primaryKey = 'tkontrak_id';
    public $incrementing = false;
    protected $fillable = [
        'tkontrak_id', 'rjeniskontrak_kode', 'tkontrak_tgl', 'tkontrak_no', 'syscustomer_id', 'rkandang_id', 'runit_kode', 'tkontrak_nama',
        'tkontrak_jmlayam', 'tkontrak_hargaayampcs', 'rsatuanpakan_kode', 'tkontrak_pakan', 'rsatuanobat_kode',
        'tkontrak_obat', 'tkontrak_upahmaklon', 'tkontrak_biayaops', 'tkontrak_upahpokok', 'tkontrak_tglhabis',
        'tkontrak_create_at', 'tkontrak_update_at', 'sysuser_id'
    ];
}
