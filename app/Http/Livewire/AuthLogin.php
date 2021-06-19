<?php

namespace App\Http\Livewire;

use App\Models\Sys_user;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class AuthLogin extends Component
{
    public $sysuser_nama, $sysuser_passw;

    /** @noinspection PhpUndefinedMethodInspection */
    public function render()
    {
        return view('livewire.auth-login')->layout('layouts.login');
    }

    public function login()
    {
        $this->validate([
            'sysuser_nama'  => 'required',
            'sysuser_passw' => 'required',
        ]);
        $login = Sys_user::query()->select('sysuser_id', 'sys_role.sysrole_kode',
            'sysrole_nama', 'sysuser_nama', 'sysuser_namalengkap', 'sysuser_passw', 'sysuser_hp',
            'sysuser_email', 'sysuser_otorize', 'sysuser_create_at', 'sys_user.runit_kode','r_unit.runit_nama')
            ->join('sys_role', 'sys_user.sysrole_kode', '=', 'sys_role.sysrole_kode')
            ->leftJoin('r_unit', 'sys_user.runit_kode', '=', 'r_unit.runit_kode')
            ->where('sysuser_nama', $this->sysuser_nama)->limit(1);
        if ($login->count() >= 1) {
            $passwordDB = '';
            $info       = $login->first();

            if (!empty($info->sysuser_passw)) {
                $passwordDB = $info->sysuser_passw;
            }
            if (empty($info->runit_kode)) {
                $arrIsAdmin   = [
                    'isAdmin' => '1'
                ];
            } else {
                $arrIsAdmin   = [
                    'isAdmin' => '0'
                ];
            }
            $finalSession = array_merge_recursive($info->toArray(), $arrIsAdmin);
            if (Hash::check($this->sysuser_passw, $passwordDB)) {
                Session::push(env('SESSION_NAME'), $finalSession);
                session()->flash('message', "Login Sukses");
                redirect()->to('/home');
            } else {
                session()->flash('error', 'Login Gagal!, Password Salah');
            }
        } else {
            session()->flash('error', 'Login Gagal!, Username Tidak Ditemukan/Salah');
        }
    }
}
