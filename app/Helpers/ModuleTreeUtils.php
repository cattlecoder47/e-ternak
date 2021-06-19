<?php

namespace App\Helpers;


use App\Models\Api\Sys_modul;
use App\Models\Api\Sys_rmodul;

class ModuleTreeUtils
{

    public static function getParent()
    {
        return Sys_modul::query()->select('sysmodul_kode', 'sysmodul_nama', 'sysmodul_parent', 'sysmodul_tag',
            'sysmodul_url', 'sysmodul_icon')
            ->WhereNull('sysmodul_parent')
            ->orWhere('sysmodul_parent', "")
            ->orderBy('sysmodul_nourut')->get();
    }

    public static function getChildren($SYSMODUL_KODE)
    {
        return Sys_modul::query()->select('sysmodul_kode', 'sysmodul_nama', 'sysmodul_parent', 'sysmodul_tag',
            'sysmodul_url', 'sysmodul_icon')
            ->where('sysmodul_parent', $SYSMODUL_KODE)
            ->orderBy('sysmodul_nourut')->first();
    }

    public static function loopChildren($SYSMODUL_KODE)
    {
        return Sys_modul::query()->select('sysmodul_kode', 'sysmodul_nama', 'sysmodul_parent', 'sysmodul_tag',
            'sysmodul_url', 'sysmodul_icon')
            ->where('sysmodul_parent', $SYSMODUL_KODE)
            ->orderBy('sysmodul_nourut')->get();
    }

    public static function isChildren($SYSMODUL_KODE): array
    {
        $children      = array();
        $loop_children = self::loopChildren($SYSMODUL_KODE);
        foreach ($loop_children as $child_node) {
            $nodes = array(
                'SYSMODUL_KODE' => $child_node->sysmodul_kode,
                'SYSMODUL_NAMA' => $child_node->sysmodul_nama,
                'children'      => self::isChildren($child_node->sysmodul_kode)
            );
            array_push($children, $nodes);
        }
        return $children;
    }

    public static function isChildrenRole($SYSROLE_KODE, $SYSMODUL_KODE): array
    {
        $IsChildren = array();
        $loop_child = self::loopChildrenRole($SYSROLE_KODE, $SYSMODUL_KODE);
        foreach ($loop_child as $child_node) {
            $Children = self::getChildrenRole($SYSROLE_KODE, $child_node->sysmodul_kode);
            if (!empty ($Children->sysmodul_parent)) {

                if ($Children->sysmodul_parent == $child_node->sysmodul_kode) {
                    $ArrCHildNode = array(
                        'SYSMODUL_KODE'   => $child_node->sysmodul_kode,
                        'SYSMODUL_NAMA'   => $child_node->sysmodul_nama,
                        'SYSMODUL_PARENT' => $child_node->sysmodul_parent,
                        'SYSMODUL_TAG'    => $child_node->sysmodul_tag,
                        'SYSMODUL_URL'    => $child_node->sysmodul_url,
                        'EXPAND'          => 'expand',
                        'children'        => self::isChildrenRole($SYSROLE_KODE, $child_node->sysmodul_kode)
                    );
                } else {
                    $ArrCHildNode = array(
                        'SYSMODUL_KODE'   => $child_node->sysmodul_kode,
                        'SYSMODUL_NAMA'   => $child_node->sysmodul_nama,
                        'SYSMODUL_PARENT' => $child_node->sysmodul_parent,
                        'SYSMODUL_TAG'    => $child_node->sysmodul_tag,
                        'SYSMODUL_URL'    => $child_node->sysmodul_url,
                        'children'        => self::isChildrenRole($SYSROLE_KODE, $child_node->sysmodul_kode)
                    );
                }
            } else {
                $ArrCHildNode = array(
                    'SYSMODUL_KODE'   => $child_node->sysmodul_kode,
                    'SYSMODUL_NAMA'   => $child_node->sysmodul_nama,
                    'SYSMODUL_PARENT' => $child_node->sysmodul_parent,
                    'SYSMODUL_TAG'    => $child_node->sysmodul_tag,
                    'SYSMODUL_URL'    => $child_node->sysmodul_url,
                    'children'        => self::isChildrenRole($SYSROLE_KODE, $child_node->sysmodul_kode)
                );
            }
            array_push($IsChildren, $ArrCHildNode);
        }
        return $IsChildren;
    }

    public static function getParentRole($SYSROLE_KODE)
    {
        return Sys_rmodul::query()->select('sys_rmodul.sysrole_kode', 'sys_modul.sysmodul_kode',
            'sys_modul.sysmodul_nama', 'sysmodul_url', 'sysmodul_icon', 'sysmodul_parent', 'sysmodul_tag', 'sysmodul_nourut')
            ->join('sys_modul', 'sys_modul.sysmodul_kode', '=', 'sys_rmodul.sysmodul_kode')
            ->where('sys_rmodul.sysrole_kode', $SYSROLE_KODE)
            ->WhereNull('sysmodul_parent')
            ->orWhere('sysmodul_parent', "")
            ->orderBy('sysmodul_nourut')->get();
    }

    public static function getChildrenRole($SYSROLE_KODE, $SYSMODUL_KODE)
    {
        return Sys_rmodul::query()->select('sys_rmodul.sysrole_kode', 'sys_modul.sysmodul_kode',
            'sys_modul.sysmodul_nama', 'sysmodul_url', 'sysmodul_icon', 'sysmodul_parent', 'sysmodul_tag', 'sysmodul_nourut')
            ->join('sys_modul', 'sys_modul.sysmodul_kode', '=', 'sys_rmodul.sysmodul_kode')
            ->where('sys_rmodul.sysrole_kode', $SYSROLE_KODE)
            ->where('sys_modul.sysmodul_parent', $SYSMODUL_KODE)
            ->orderBy('sysmodul_nourut')->first();
    }

    public static function loopChildrenRole($SYSROLE_KODE, $SYSMODUL_KODE)
    {
        return Sys_rmodul::query()->select('sys_rmodul.sysrole_kode', 'sys_modul.sysmodul_kode',
            'sys_modul.sysmodul_nama', 'sysmodul_url', 'sysmodul_icon', 'sysmodul_parent', 'sysmodul_tag', 'sysmodul_nourut')
            ->join('sys_modul', 'sys_modul.sysmodul_kode', '=', 'sys_rmodul.sysmodul_kode')
            ->where('sys_rmodul.sysrole_kode', $SYSROLE_KODE)
            ->where('sys_modul.sysmodul_parent', $SYSMODUL_KODE)->get();
    }

    public static function getMenuNavSideBar($SYSROLE_KODE): array
    {
        $array = array();
        $modul = self::getParentRole($SYSROLE_KODE);
        foreach ($modul as $fields) {
            $Children = self::getChildrenRole($SYSROLE_KODE, $fields->sysmodul_kode);
            if (!empty ($Children->sysmodul_parent)) {
                if ($Children->sysmodul_parent == $fields->sysmodul_kode) {
                    $Menu = array(
                        'SYSMODUL_KODE'   => $fields->sysmodul_kode,
                        'SYSMODUL_NAMA'   => $fields->sysmodul_nama,
                        'SYSMODUL_PARENT' => $fields->sysmodul_parent,
                        'SYSMODUL_TAG'    => $fields->sysmodul_tag,
                        'SYSMODUL_URL'    => $fields->sysmodul_url,
                        'SYSMODUL_ICON'   => $fields->sysmodul_icon,
                        'children'        => self::isChildrenRole($SYSROLE_KODE, $fields->sysmodul_kode)
                    );
                } else {
                    $Menu = array(
                        'SYSMODUL_KODE'   => $fields->sysmodul_kode,
                        'SYSMODUL_NAMA'   => $fields->sysmodul_nama,
                        'SYSMODUL_PARENT' => $fields->sysmodul_parent,
                        'SYSMODUL_TAG'    => $fields->sysmodul_tag,
                        'SYSMODUL_URL'    => $fields->sysmodul_url,
                        'SYSMODUL_ICON'   => $fields->sysmodul_icon
                    );
                }
            } else {
                $Menu = array(
                    'SYSMODUL_KODE'   => $fields->sysmodul_kode,
                    'SYSMODUL_NAMA'   => $fields->sysmodul_nama,
                    'SYSMODUL_PARENT' => $fields->sysmodul_parent,
                    'SYSMODUL_TAG'    => $fields->sysmodul_tag,
                    'SYSMODUL_URL'    => $fields->sysmodul_url,
                    'SYSMODUL_ICON'   => $fields->sysmodul_icon
                );
            }
            array_push($array, $Menu);
        }
        return $array;
    }

}
