<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed sysuserlog_id
 * @property mixed sysuser_id
 * @property mixed rtypelog_kode
 * @property mixed sysuser_logdesk
 * @method static where(string $string, $id)
 * @method static find($id)
 * @method static get()
 * @method static create(array $array)
 */
class Sys_userlog extends Model
{
    protected $table = "sys_userlog";
    public $timestamps = false;
    protected $primaryKey = 'sysuserlog_id';
    public $incrementing = false;
    protected $fillable = [
        'sysuserlog_id', 'sysuser_id', 'rtypelog_kode', 'sysuser_logdesk', 'sysuser_logcreate_at',
        'sysuser_logupdate_at'
    ];
}
