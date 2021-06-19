<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed rwilayah_id
 * @property mixed rwilayah_provnama
 * @property mixed rwilayah_jenis
 * @property mixed rwilayah_kotanama
 * @property mixed rwilayah_kecnama
 * @property mixed rwilayah_kelnama
 * @property mixed rwilayah_kodepos
 * @method static where(string $string, $id)
 * @method static find($id)
 * @method static get()
 * @method static create(array $array)
 */
class R_wilayah extends Model
{
    protected $table = "r_wilayah";
    public $timestamps = false;
    protected $primaryKey = 'rwilayah_id';
    public $incrementing = false;
    protected $fillable = [
        'rwilayah_id', 'rwilayah_provnama', 'rwilayah_jenis', 'rwilayah_kotanama', 'rwilayah_kecnama', 'rwilayah_kelnama', 'rwilayah_kodepos'
    ];
}
