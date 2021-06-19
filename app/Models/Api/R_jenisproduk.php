<?php

namespace App\Models\Api;

use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed rjenisproduk_kode
 * @property mixed rjenisproduk_nama
 * @method static where(string $string, $id)
 * @method static find($id)
 * @method static get()
 * @method static create(array $array)
 */
class R_jenisproduk extends Model
{
    protected $table        = "r_jenisproduk";
    public    $timestamps   = false;
    protected $primaryKey   = 'rjenisproduk_kode';
    public    $incrementing = false;
    protected $fillable     = [
        'rjenisproduk_kode', 'rjenisproduk_nama'
    ];
}
