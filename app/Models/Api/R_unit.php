<?php

namespace App\Models\Api;

use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed runit_kode
 * @property mixed runit_nama
 * @property mixed runit_alamat
 * @property mixed runit_pimpinan
 * @property mixed|string runit_create_at
 * @method static where(string $string, $id)
 * @method static find($id)
 * @method static get()
 */
class R_unit extends Model
{
    protected $table = "r_unit";
    public $timestamps = false;
    protected $primaryKey = 'runit_kode';
    public $incrementing = false;
    protected $fillable = [
        'runit_kode', 'runit_nama', 'runit_alamat', 'runit_pimpinan', 'runit_create_at', 'runit_update_at'
    ];
}
