<?php

namespace App\Http\Livewire;

use App\Helpers\ModuleTreeUtils;
use App\Helpers\Utility;
use App\Models\Sys_customer;
use App\Models\Sys_option;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class SysOption extends Component
{
    public $site_items, $app_items;


    public function render()
    {
        if (Session::has(env('SESSION_NAME'))) {

            $this->site_items = Sys_option::where('sysoption_tipe', 'site')->get();
            $this->app_items  = Sys_option::where('sysoption_tipe', 'app')->get();
            return view('livewire.setting.option.v_sys_option')->layout('layouts.main', [
                'navMenu' => ModuleTreeUtils::getMenuNavSideBar(Utility::getSession('sysrole_kode'))
            ]);
        } else {
            session()->flash('login_expired', 'Session Login Habis Silahkan Login Kembali');
            return view('livewire.auth-login')->layout('layouts.login');
        }
    }

    public function update($id)
    {
        $sys_option = Sys_option::find($id);
        $sys_option->update([
            'sysoption_value' => $this->sysoption_value,
        ]);
    }
}
