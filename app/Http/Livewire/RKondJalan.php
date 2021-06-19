<?php

namespace App\Http\Livewire;

use App\Helpers\ApiUtils;
use App\Helpers\ModuleTreeUtils;
use App\Helpers\Utility;
use App\Models\Api\R_kondjalan;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class RKondJalan extends Component
{
    public $r_kondjalan, $rkondjalan_kode, $rkondjalan_nama;
    public $updateMode = false;

    public function render()
    {
        if (Session::has(env('SESSION_NAME'))) {
            $this->r_kondjalan = R_kondjalan::all();
            $this->emit('kondjalanList');
            return view('livewire.referensi.kondjalan.v_r_kondjalan')->layout('layouts.main', [
                'navMenu' => ModuleTreeUtils::getMenuNavSideBar(Utility::getSession('sysrole_kode')),
            ]);
        } else {
            session()->flash('login_expired', 'Session Login Habis Silahkan Login Kembali');
            return view('livewire.auth-login')->layout('layouts.login');
        }
    }

    private function resetInputFields()
    {
        $this->rkondjalan_nama = '';
    }

    public function store()
    {
        try {
            $this->validate([
                'rkondjalan_nama' => 'required'
            ]);
            R_kondjalan::create([
                'rkondjalan_kode' => ApiUtils::GetNextId('r_kondjalan'),
                'rkondjalan_nama' => $this->rkondjalan_nama
            ]);
            session()->flash('success_message', 'TAMBAH DATA SUKSES');
            $this->resetInputFields();
            $this->emit('kondjalanStore');
        } catch (QueryException $e) {
            session()->flash('error_message', 'TAMBAH DATA GAGAL! ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $this->updateMode   = true;
        $r_kondjalan           = R_kondjalan::where('rkondjalan_kode', $id)->first();
        $this->rkondjalan_kode = $id;
        $this->rkondjalan_nama = $r_kondjalan->rkondjalan_nama;
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
                'rkondjalan_nama' => 'required',
            ]);

            if ($this->rkondjalan_kode) {
                $user = R_kondjalan::find($this->rkondjalan_kode);
                $user->update([
                    'rkondjalan_nama' => $this->rkondjalan_nama,
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
                R_kondjalan::where('rkondjalan_kode', $id)->delete();
                session()->flash('success_message', 'HAPUS DATA SUKSES');
            }
        } catch (QueryException $e) {
            session()->flash('error_message', 'HAPUS DATA GAGAL! ' . $e->getMessage());
        }

    }

}
