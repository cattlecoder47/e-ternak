<?php

namespace App\Models\Api;

use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed rjinsentif_kode
 * @property mixed rjinsentif_nama
 * @method static where(string $string, $id)
 * @method static find($id)
 * @method static get()
 */
class R_jinsentif extends Model
{
    protected $table = "r_jinsentif";
    public $timestamps = false;
    protected $primaryKey = 'rjinsentif_kode';
    public $incrementing = false;
    protected $fillable = [
        'rjinsentif_kode', 'rjinsentif_nama'
    ];
}
