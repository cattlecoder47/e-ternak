<?php

namespace App\Models\Api;

use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed rinsentif_kode
 * @property mixed rjinsentif_kode
 * @property mixed rinsentif_min
 * @property mixed rinsentif_max
 * @property mixed rinsentif_nominal
 * @method static where(string $string, $id)
 * @method static find($id)
 * @method static get()
 */
class R_insentif extends Model
{
    protected $table = "r_insentif";
    public $timestamps = false;
    protected $primaryKey = 'rinsentif_kode';
    public $incrementing = false;
    protected $fillable = [
        'rinsentif_kode', 'rjinsentif_kode', 'rinsentif_min', 'rinsentif_max', 'rinsentif_nominal'
    ];
}
