<?php

namespace App\Models\Api;

use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed sysrole_kode
 * @property mixed sysrole_nama
 * @method static where(string $string, $id)
 * @method static find($id)
 * @method static get()
 */
class Sys_role extends Model
{
    protected $table        = "sys_role";
    public    $timestamps   = false;
    protected $primaryKey   = 'sysrole_kode';
    public    $incrementing = false;
    protected $fillable     = [
        'sysrole_kode', 'sysrole_nama'
    ];
}
