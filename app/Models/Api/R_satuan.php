<?php

namespace App\Models\Api;

use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed rsatuan_kode
 * @property mixed rsatuan_nama
 * @method static where(string $string, $id)
 * @method static find($id)
 * @method static get()
 */
class R_satuan extends Model
{
    protected $table        = "r_satuan";
    public    $timestamps   = false;
    protected $primaryKey   = 'rsatuan_kode';
    public    $incrementing = false;
    protected $fillable     = [
        'rsatuan_kode', 'rsatuan_nama'
    ];
}
