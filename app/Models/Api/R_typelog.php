<?php

namespace App\Models\Api;

use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed rtypelog_kode
 * @property mixed rtypelog_nama
 * @method static where(string $string, $id)
 * @method static find($id)
 * @method static get()
 */
class R_typelog extends Model
{
    protected $table = "r_typelog";
    public $timestamps = false;
    protected $primaryKey = 'rtypelog_kode';
    public $incrementing = false;
    protected $fillable = [
        'rtypelog_kode', 'rtypelog_nama'
    ];
}
