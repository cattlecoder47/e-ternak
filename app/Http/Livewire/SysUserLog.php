<?php

namespace App\Http\Livewire;

use App\Helpers\ModuleTreeUtils;
use App\Helpers\Utility;
use App\Models\Sys_userlog;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Livewire\WithPagination;

class SysUserLog extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $searchTerm;

    public function render()
    {
        if (Session::has(env('SESSION_NAME'))) {
            $searchTerm = '%' . $this->searchTerm . '%';
            $result     = Sys_userlog::query()->select('sys_userlog.sysuserlog_id', 'r_typelog.rtypelog_nama','sys_user.sysuser_nama',
                'sys_userlog.sysuser_logdesk', 'sys_userlog.sysuser_logcreate_at')
                ->where('sysuser_logdesk', 'like', $searchTerm)
                ->join('r_typelog', 'sys_userlog.rtypelog_kode', '=', 'r_typelog.rtypelog_kode')
                ->join('sys_user', 'sys_userlog.sysuser_id', '=', 'sys_user.sysuser_id')
                ->orderBy('sysuserlog_id', 'DESC')->paginate(10);
            return view('livewire.user.sysuserlog.v_sys_userlog', [
                'logs' => $result
            ])->layout('layouts.main', [
                'navMenu' => ModuleTreeUtils::getMenuNavSideBar(Utility::getSession('sysrole_kode'))
            ]);
        } else {
            session()->flash('login_expired', 'Session Login Habis Silahkan Login Kembali');
            return view('livewire.auth-login')->layout('layouts.login');
        }
    }
}
