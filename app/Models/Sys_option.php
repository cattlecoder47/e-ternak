<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed sysoption_id
 * @property mixed sysoption_tipe
 * @property mixed sysoption_nama
 * @property mixed sysoption_alias
 * @property mixed sysoption_value
 * @property mixed sysoption_create_at
 * @property mixed sysoption_update_at
 * @method static where(string $string, $id)
 * @method static find($id)
 * @method static get()
 * @method static create(array $array)
 */
class Sys_option extends Model
{
    protected $table = "sys_option";
    public $timestamps = false;
    protected $primaryKey = 'sysoption_id';
    public $incrementing = false;
    protected $fillable = [
        'sysoption_id', 'sysoption_tipe', 'sysoption_nama', 'sysoption_alias',
        'sysoption_value', 'sysoption_create_at', 'sysoption_update_at'
    ];
}
