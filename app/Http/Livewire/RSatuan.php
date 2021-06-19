<?php

namespace App\Http\Livewire;

use App\Helpers\ApiUtils;
use App\Helpers\ModuleTreeUtils;
use App\Helpers\Utility;
use App\Models\Api\R_satuan;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class RSatuan extends Component
{
    public $r_satuan, $rsatuan_kode, $rsatuan_nama;
    public $updateMode = false;

    public function render()
    {
        if (Session::has(env('SESSION_NAME'))) {
            $this->r_satuan = R_satuan::all();
            $this->emit('satuanList');
            return view('livewire.referensi.satuan.v_r_satuan')->layout('layouts.main', [
                'navMenu' => ModuleTreeUtils::getMenuNavSideBar(Utility::getSession('sysrole_kode')),
            ]);
        } else {
            session()->flash('login_expired', 'Session Login Habis Silahkan Login Kembali');
            return view('livewire.auth-login')->layout('layouts.login');
        }
    }

    private function resetInputFields()
    {
        $this->rsatuan_nama = '';
    }

    public function store()
    {
        try {
            $this->validate([
                'rsatuan_nama' => 'required'
            ]);
            R_satuan::create([
                'rsatuan_kode' => ApiUtils::GetNextId('r_satuan'),
                'rsatuan_nama' => $this->rsatuan_nama
            ]);
            session()->flash('success_message', 'TAMBAH DATA SUKSES');
            $this->resetInputFields();
            $this->emit('satuanStore');
        } catch (QueryException $e) {
            session()->flash('error_message', 'TAMBAH DATA GAGAL! ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $this->updateMode   = true;
        $r_satuan           = R_satuan::where('rsatuan_kode', $id)->first();
        $this->rsatuan_kode = $id;
        $this->rsatuan_nama = $r_satuan->rsatuan_nama;
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
                'rsatuan_nama' => 'required',
            ]);

            if ($this->rsatuan_kode) {
                $user = R_satuan::find($this->rsatuan_kode);
                $user->update([
                    'rsatuan_nama' => $this->rsatuan_nama,
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
                R_satuan::where('rsatuan_kode', $id)->delete();
                session()->flash('success_message', 'HAPUS DATA SUKSES');
            }
        } catch (QueryException $e) {
            session()->flash('error_message', 'HAPUS DATA GAGAL! ' . $e->getMessage());
        }

    }

}
