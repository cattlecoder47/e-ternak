<?php

namespace App\Http\Livewire;

use App\Helpers\ModuleTreeUtils;
use App\Helpers\Utility;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class HomePage extends Component
{
    /** @noinspection PhpUndefinedMethodInspection */
    public function render()
    {
        if (Session::has(env('SESSION_NAME'))) {
            return view('livewire.home-page')->layout('layouts.main', [
                'navMenu' => ModuleTreeUtils::getMenuNavSideBar(Utility::getSession('sysrole_kode'))
            ]);
        } else {
            session()->flash('login_expired', 'Session Login Habis Silahkan Login Kembali');
            return view('livewire.auth-login')->layout('layouts.login');
        }
    }

    public function logout()
    {
        Session::remove(env('SESSION_NAME'));
        return redirect('/login');
    }
}
