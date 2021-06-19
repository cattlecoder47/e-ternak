<?php

namespace App\Models\Api;

use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed sysmodul_kode
 * @property mixed sysmodul_nama
 * @property mixed sysmodul_url
 * @property mixed sysmodul_icon
 * @property mixed sysmodul_parent
 * @property mixed sysmodul_nourut
 * @method static where(string $string, $id)
 * @method static find($id)
 * @method static get()
 */
class Sys_rmodul extends Model
{
    protected $table = "sys_rmodul";
    public $timestamps = false;
    protected $primaryKey = 'sysrole_kode';
    public $incrementing = false;
    protected $fillable = [
        'sysrole_kode', 'sysmodul_kode'
    ];
}
