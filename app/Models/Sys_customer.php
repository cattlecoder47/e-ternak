<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed syscustomer_id
 * @property mixed syscustomer_namalengkap
 * @property mixed syscustomer_alamat
 * @property mixed syscutomer_tempatlahir
 * @property mixed syscustomer_tgllahir
 * @property mixed rjid_kode
 * @property mixed syscustomer_noid
 * @property mixed syscustomer_wilayahid
 * @property mixed syscustomer_hp
 * @property mixed syscustomer_verifikasi
 * @property mixed syscustomer_create_at
 * @property mixed syscustomer_update_at
 * @method static where(string $string, $id)
 * @method static find($id)
 * @method static get()
 * @method static create(array $array)
 */
class Sys_customer extends Model
{
    protected $table = "sys_customer";
    public $timestamps = false;
    protected $primaryKey = 'syscustomer_id';
    public $incrementing = false;
    protected $fillable = [
        'syscustomer_id', 'syscustomer_namalengkap', 'syscustomer_alamat', 'syscutomer_tempatlahir', 'syscustomer_tgllahir',
        'rjid_kode', 'syscustomer_noid', 'syscustomer_wilayahid', 'syscustomer_hp', 'syscustomer_verifikasi',
        'syscustomer_create_at', 'syscustomer_update_at'
    ];
}
