<?php

use Illuminate\Support\Facades\DB;

if (!function_exists('getOption')) {
    function getOption($name = null, $if_none = null, $set_if_none = false)
    {
        if (!isset($name)) {
            return null;
        }
        if ($name) {
            $result          = DB::table('sys_option')->where('sysoption_nama', $name)->first();
            $sysoption_value = $result->sysoption_value;
            if (isset($sysoption_value)) {
                return $sysoption_value;
            }
        }
        if ($set_if_none) {
            updateOption($name, $if_none);
        }
        return $if_none;
    }
}

if (!function_exists('updateOption')) {
    function updateOption($name = null, $value = null)
    {
        if (!isset($name) && !isset($value)) {
            return null;
        }

        $options = DB::table('sys_option')->select('sysoption_value')
            ->where('sysoption_nama', $name)->get();
        if ($options->count() > 0) {
            DB::table('sys_option')->where('sysoption_nama', $name)
                ->update(['sysoption_value' => $value]);
        } else {
            $data = array("sysoption_nama" => $name, "sysoption_value" => $value);
            DB::table('sys_option')->insert($data);
        }

        return DB::getPdo()->lastInsertId();
    }
}
