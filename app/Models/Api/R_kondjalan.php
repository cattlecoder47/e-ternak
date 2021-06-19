<?php

namespace App\Models\Api;

use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed rkondjalan_kode
 * @property mixed rkondjalan_nama
 * @method static where(string $string, $id)
 * @method static find($id)
 * @method static get()
 * @method static create(array $array)
 */
class R_kondjalan extends Model
{
    protected $table = "r_kondjalan";
    public $timestamps = false;
    protected $primaryKey = 'rkondjalan_kode';
    public $incrementing = false;
    protected $fillable = [
        'rkondjalan_kode', 'rkondjalan_nama'
    ];
}
