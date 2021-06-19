<?php

namespace App\Helpers;

use Illuminate\Support\Facades\DB;

class ApiUtils
{
    public static function GetNextId($tableName)
    {
        DB::statement("call getLastID('$tableName',@outprm);");
        $query = DB::select("SELECT @outprm AS out_param");
        return $query[0]->out_param;
    }
}
