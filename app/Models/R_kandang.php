<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed rkandang_id
 * @property mixed syscustomer_id
 * @property mixed rkandang_nama
 * @property mixed rkandang_lokasi
 * @property mixed rkandang_size
 * @property mixed rkandang_dayatampung
 * @property mixed rkondjalan_kode
 * @property mixed rkandang_foto1
 * @property mixed rkandang_foto2
 * @property mixed rkandang_foto3
 * @property mixed rkandang_foto4
 * @property mixed rkandang_create_at
 * @property mixed rkandang_update_at
 * @method static where(string $string, $id)
 * @method static find($id)
 * @method static get()
 * @method static create(array $array)
 */
class R_kandang extends Model
{
    protected $table = "r_kandang";
    public $timestamps = false;
    protected $primaryKey = 'rkandang_id';
    public $incrementing = false;
    protected $fillable = [
        'rkandang_id', 'syscustomer_id', 'rkandang_nama', 'rkandang_lokasi', 'rkandang_size', 'rkandang_dayatampung', 'rkondjalan_kode',
        'rkandang_foto1', 'rkandang_foto2', 'rkandang_foto3', 'rkandang_foto4', 'rkandang_create_at', 'rkandang_update_at'
    ];
}
