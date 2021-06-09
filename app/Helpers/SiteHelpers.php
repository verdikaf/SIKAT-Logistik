<?php

namespace App\Helpers;

use Illuminate\Support\Facades\DB;

class SiteHelpers{
    public static function cek_akses(){
        return 'Dika';
    }

    public static function main_menu(){
        $main_menu = DB::table('akses')
        ->join('menu', 'menu.id', 'akses.menu_id')
        ->select('menu.*', 'akses.*')
        ->where('akses.role_id', session('berhasil_login')['role'])
        ->where('menu.level_menu','main menu')
        ->get();

        return $main_menu;
    }

    public static function sub_menu(){
        $sub_menu = DB::table('akses')->join('menu', 'menu.id', '=', 'akses.menu_id')
        ->select('menu.*')
        ->where('akses.role_id', session('berhasil_login')['role'])
        ->where('menu.level_menu','submenu')->get();

        return $sub_menu;
    }
}
