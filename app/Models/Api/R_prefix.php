<?php

namespace App\Models\Api;

use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed rprefix_tablename
 * @property mixed rprefix_fieldid
 * @property mixed rprefix_kode
 * @property mixed rprefix_idlength
 * @method static where(string $string, $id)
 * @method static find($id)
 * @method static get()
 * @method static create(array $array)
 */
class R_prefix extends Model
{
    protected $table = "r_prefix";
    public $timestamps = false;
    protected $primaryKey = 'rprefix_tablename';
    public $incrementing = false;
    protected $fillable = [
        'rprefix_tablename', 'rprefix_fieldid', 'rprefix_kode', 'rprefix_idlength'
    ];
}
