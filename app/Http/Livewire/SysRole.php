<?php

namespace App\Http\Livewire;

use App\Helpers\ApiUtils;
use App\Helpers\ModuleTreeUtils;
use App\Helpers\Utility;
use App\Models\Api\Sys_role;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class SysRole extends Component
{
    public $sys_role, $sysrole_kode, $sysrole_nama;
    public $updateMode = false;

    public function render()
    {
        if (Session::has(env('SESSION_NAME'))) {
            $this->sys_role = Sys_role::all();
            $this->emit('roleList');
            return view('livewire.user.role.v_sys_role')->layout('layouts.main', [
                'navMenu' => ModuleTreeUtils::getMenuNavSideBar(Utility::getSession('sysrole_kode')),
            ]);
        } else {
            session()->flash('login_expired', 'Session Login Habis Silahkan Login Kembali');
            return view('livewire.auth-login')->layout('layouts.login');
        }
    }

    private function resetInputFields()
    {
        $this->sysrole_nama = '';
    }

    public function store()
    {
        try {
            $this->validate([
                'sysrole_nama' => 'required'
            ]);
            Sys_role::create([
                'sysrole_kode' => ApiUtils::GetNextId('sys_role'),
                'sysrole_nama' => $this->sysrole_nama
            ]);
            session()->flash('success_message', 'TAMBAH DATA SUKSES');
            $this->resetInputFields();
            $this->emit('roleStore');
        } catch (QueryException $e) {
            session()->flash('error_message', 'TAMBAH DATA GAGAL! ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $this->updateMode   = true;
        $sys_role           = Sys_role::where('sysrole_kode', $id)->first();
        $this->sysrole_kode = $id;
        $this->sysrole_nama = $sys_role->sysrole_nama;
    }

    public function cancel()
    {
        $this->updateMode = false;
        $this->resetInputFields();
    }

    public function update()
    {
        try {
            $this->validate([
                'sysrole_nama' => 'required',
            ]);

            if ($this->sysrole_kode) {
                $user = Sys_role::find($this->sysrole_kode);
                $user->update([
                    'sysrole_nama' => $this->sysrole_nama,
                ]);
                $this->updateMode = false;
                session()->flash('success_message', 'UPDATE DATA SUKSES');
                $this->resetInputFields();
            }
        } catch (QueryException $e) {
            session()->flash('success_message', 'UPDATE DATA GAGAL! ' . $e->getMessage());

        }
    }

    public function delete($id)
    {
        try {
            if ($id) {
                Sys_role::where('sysrole_kode', $id)->delete();
                session()->flash('success_message', 'HAPUS DATA SUKSES');
            }
        } catch (QueryException $e) {
            session()->flash('error_message', 'HAPUS DATA GAGAL! ' . $e->getMessage());
        }

    }

}
