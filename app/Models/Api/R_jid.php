<?php

namespace App\Models\Api;

use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed rjid_kode
 * @property mixed rjid_nama
 * @method static where(string $string, $id)
 * @method static find($id)
 * @method static get()
 */
class R_jid extends Model
{
    protected $table = "r_jid";
    public $timestamps = false;
    protected $primaryKey = 'rjid_kode';
    public $incrementing = false;
    protected $fillable = [
        'rjid_kode', 'rjid_nama'
    ];
}
