<?php

namespace App\Helpers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;
use function Livewire\str;

class Utility
{
    public static function giveResponse($http_response_code, $response_code, $response_message, $response_data = ""): JsonResponse
    {
        $res = array(
            'response_code'    => $response_code,
            'response_message' => $response_message,
            'response_data'    => $response_data
        );
        return response()->json($res, $http_response_code);
    }

    public static function getSession($key)
    {
        $session = Session::get(env('SESSION_NAME'));
        return $session[0][$key];
    }

    public static function sideBarMenu($menu_array)
    {
        foreach ($menu_array as $menu) {
            if (!empty($menu['SYSMODUL_ICON'])) {
                $icon = $menu['SYSMODUL_ICON'];
            } else {
                $icon = "";
            }
            $navItem = '';
            if (array_key_exists('children', $menu)) {
                if (count($menu['children']) > 0) {
                    $navItem = 'nav-item-submenu';
                }
            }
            $tag      = "";
            $labelTag = "";
            if (!empty($menu['SYSMODUL_TAG'])) {
                $arrLabelTag  = explode(',', env('TAG_MODUL'));
                $new          = $arrLabelTag[0];
                $onDevel      = $arrLabelTag[1];
                $construction = $arrLabelTag[2];
                if ($menu['SYSMODUL_TAG'] == $new) {
                    $labelTag = 'bg-blue-400';
                } else if ($menu['SYSMODUL_TAG'] == $onDevel) {
                    $labelTag = 'bg-orange-400';
                } else if ($menu['SYSMODUL_TAG'] == $construction) {
                    $labelTag = 'bg-danger';
                }
                $tag = '<span class="badge ' . $labelTag . ' align-self-center ml-auto">' . $menu["SYSMODUL_TAG"] . '</span>';
            }
            echo " <li class='nav-item " . $navItem . " " . Utility::set_item_open([$menu['SYSMODUL_URL']]) . "' ><a class='nav-link  " . Utility::set_active([$menu['SYSMODUL_URL']]) . " '
            href='" . url('/') . "/{$menu['SYSMODUL_URL']}'   >
        <i class='$icon'></i> <span>{$menu['SYSMODUL_NAMA']}</span> " . $tag . " </a>";
            if (array_key_exists('children', $menu)) {
                $groupSub = '';
                if (count($menu['children']) > 0) {
                    $groupSub = 'nav-group-sub';
                }

                echo '<ul class="nav ' . $groupSub . '" >';
                self::sideBarMenu($menu['children']);
                echo '</ul>';
            }
            echo '</li>';
        }
    }

    public static function set_active($path, $active = 'active')
    {

        return call_user_func_array('Request::is', (array)$path) ? $active : '';
    }

    public static function set_item_open($path, $itemOpen = 'nav-item-open')
    {

        return call_user_func_array('Request::is', (array)$path) ? $itemOpen : '';
    }

    public static function convertDate($date)
    {
        if ($date == '') {
            $date = "";
        } else {
            $date = date('Y-m-d', strtotime($date));
        }
        return $date;
    }

    public static function currency($value, $dec): string
    {
        return number_format($value, $dec, ',', '.');
    }

    public static function unformatMoney($money)
    {
        $cleanString       = preg_replace('/([^0-9\.,])/i', '', $money);
        $onlyNumbersString = preg_replace('/([^0-9])/i', '', $money);

        $separatorsCountToBeErased = strlen($cleanString) - strlen($onlyNumbersString) - 1;

        $stringWithCommaOrDot     = preg_replace('/([,\.])/', '', $cleanString, $separatorsCountToBeErased);
        $removedThousendSeparator = preg_replace('/(\.|,)(?=[0-9]{3,}$)/', '', $stringWithCommaOrDot);

        return (string)str_replace(',', '.', $removedThousendSeparator);
    }


}
