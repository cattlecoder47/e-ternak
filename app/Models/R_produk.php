<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed rproduk_id
 * @property mixed rjenisproduk_kode
 * @property mixed rproduk_desk
 * @property mixed rproduk_tglmasuk
 * @property mixed rproduk_tglkadaluarsa
 * @property mixed rproduk_qty
 * @property mixed rproduk_hargasatuan
 * @property mixed rsatuan_kode
 * @property mixed rproduk_foto
 * @property mixed sysuser_id
 * @property mixed rproduk_create_at
 * @property mixed rproduk_update_at
 * @method static where(string $string, $id)
 * @method static find($id)
 * @method static get()
 * @method static create(array $array)
 */
class R_produk extends Model
{
    protected $table = "r_produk";
    public $timestamps = false;
    protected $primaryKey = 'rproduk_id';
    public $incrementing = false;
    protected $fillable = [
        'rproduk_id', 'rjenisproduk_kode', 'rproduk_desk', 'rproduk_tglmasuk', 'rproduk_tglkadaluarsa',
        'rproduk_qty', 'rproduk_hargasatuan', 'rsatuan_kode', 'rproduk_foto', 'sysuser_id', 'rproduk_create_at', 'rproduk_update_at'
    ];
}
