<?php

namespace App\Http\Livewire;

use App\Helpers\ApiUtils;
use App\Helpers\ModuleTreeUtils;
use App\Helpers\Utility;
use App\Models\Api\R_jenisproduk;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class RJenisProduk extends Component
{
    public $r_jenisproduk, $rjenisproduk_kode, $rjenisproduk_nama;
    public $updateMode = false;

    /** @noinspection PhpUndefinedMethodInspection */
    public function render()
    {
        if (Session::has(env('SESSION_NAME'))) {
            $this->r_jenisproduk = R_jenisproduk::all();
            $this->emit('jenisprodukList');
            return view('livewire.referensi.jenisproduk.v_r_jenisproduk')->layout('layouts.main', [
                'navMenu' => ModuleTreeUtils::getMenuNavSideBar(Utility::getSession('sysrole_kode')),
            ]);
        } else {
            session()->flash('login_expired', 'Session Login Habis Silahkan Login Kembali');
            return view('livewire.auth-login')->layout('layouts.login');
        }
    }

    private function resetInputFields()
    {
        $this->rjenisproduk_nama = '';
    }

    public function store()
    {
        try {
            $this->validate([
                'rjenisproduk_nama' => 'required'
            ]);
            R_jenisproduk::create([
                'rjenisproduk_kode' => ApiUtils::GetNextId('r_jenisproduk'),
                'rjenisproduk_nama' => $this->rjenisproduk_nama
            ]);
            session()->flash('success_message', 'TAMBAH DATA SUKSES');
            $this->resetInputFields();
            $this->emit('jenisprodukStore');
        } catch (QueryException $e) {
            session()->flash('error_message', 'TAMBAH DATA GAGAL! ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $this->updateMode   = true;
        $r_jenisproduk           = R_jenisproduk::where('rjenisproduk_kode', $id)->first();
        $this->rjenisproduk_kode = $id;
        $this->rjenisproduk_nama = $r_jenisproduk->rjenisproduk_nama;
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
                'rjenisproduk_nama' => 'required',
            ]);

            if ($this->rjenisproduk_kode) {
                $user = R_jenisproduk::find($this->rjenisproduk_kode);
                $user->update([
                    'rjenisproduk_nama' => $this->rjenisproduk_nama,
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
                R_jenisproduk::where('rjenisproduk_kode', $id)->delete();
                session()->flash('success_message', 'HAPUS DATA SUKSES');
            }
        } catch (QueryException $e) {
            session()->flash('error_message', 'HAPUS DATA GAGAL! ' . $e->getMessage());
        }

    }

}
