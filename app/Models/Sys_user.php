<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed sysuser_id
 * @property mixed sysrole_kode
 * @property mixed runit_kode
 * @property mixed sysuser_nama
 * @property mixed sysuser_namalengkap
 * @property mixed sysuser_passw
 * @property mixed sysuser_hp
 * @property mixed sysuser_email
 * @property mixed sysuser_otorize
 * @property mixed sysuser_create_at
 * @property mixed sysuser_update_at
 * @method static where(string $string, $id)
 * @method static find($id)
 * @method static get()
 * @method static create(array $array)
 */
class Sys_user extends Model
{
    protected $table = "sys_user";
    public $timestamps = false;
    protected $primaryKey = 'sysuser_id';
    public $incrementing = false;
    protected $fillable = [
        'sysuser_id', 'sysrole_kode', 'runit_kode', 'sysuser_nama', 'sysuser_namalengkap',
        'sysuser_passw', 'sysuser_hp', 'sysuser_email', 'sysuser_otorize', 'sysuser_create_at', 'sysuser_update_at'
    ];
}
