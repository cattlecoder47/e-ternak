<?php

namespace App\Http\Livewire;

use App\Helpers\ApiUtils;
use App\Helpers\ModuleTreeUtils;
use App\Helpers\Utility;
use App\Models\Api\R_typelog;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class RTypeLog extends Component
{
    public $r_typelog, $rtypelog_kode, $rtypelog_nama;
    public $updateMode = false;

    public function render()
    {
        if (Session::has(env('SESSION_NAME'))) {
            $this->r_typelog = R_typelog::all();
            $this->emit('typelogList');
            return view('livewire.user.typelog.v_r_typelog')->layout('layouts.main', [
                'navMenu' => ModuleTreeUtils::getMenuNavSideBar(Utility::getSession('sysrole_kode')),
            ]);
        } else {
            session()->flash('login_expired', 'Session Login Habis Silahkan Login Kembali');
            return view('livewire.auth-login')->layout('layouts.login');
        }
    }

    private function resetInputFields()
    {
        $this->rtypelog_nama = '';
    }

    public function store()
    {
        try {
            $this->validate([
                'rtypelog_nama' => 'required'
            ]);
            R_typelog::create([
                'rtypelog_kode' => ApiUtils::GetNextId('r_typelog'),
                'rtypelog_nama' => $this->rtypelog_nama
            ]);
            session()->flash('success_message', 'TAMBAH DATA SUKSES');
            $this->resetInputFields();
            $this->emit('typelogStore');
        } catch (QueryException $e) {
            session()->flash('error_message', 'TAMBAH DATA GAGAL! ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $this->updateMode   = true;
        $r_typelog           = R_typelog::where('rtypelog_kode', $id)->first();
        $this->rtypelog_kode = $id;
        $this->rtypelog_nama = $r_typelog->rtypelog_nama;
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
                'rtypelog_nama' => 'required',
            ]);

            if ($this->rtypelog_kode) {
                $user = R_typelog::find($this->rtypelog_kode);
                $user->update([
                    'rtypelog_nama' => $this->rtypelog_nama,
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
                R_typelog::where('rtypelog_kode', $id)->delete();
                session()->flash('success_message', 'HAPUS DATA SUKSES');
            }
        } catch (QueryException $e) {
            session()->flash('error_message', 'HAPUS DATA GAGAL! ' . $e->getMessage());
        }

    }

}
