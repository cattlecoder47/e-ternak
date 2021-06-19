<?php

namespace App\Models\Api;

use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed rjeniskontrak_kode
 * @property mixed rjeniskontrak_nama
 * @method static where(string $string, $id)
 * @method static find($id)
 * @method static get()
 */
class R_jeniskontrak extends Model
{
    protected $table = "r_jeniskontrak";
    public $timestamps = false;
    protected $primaryKey = 'rjeniskontrak_kode';
    public $incrementing = false;
    protected $fillable = [
        'rjeniskontrak_kode', 'rjeniskontrak_nama'
    ];
}
