<?php

namespace App\Http\Livewire;

use App\Helpers\ApiUtils;
use App\Helpers\ModuleTreeUtils;
use App\Helpers\Utility;
use App\Models\Api\R_jeniskontrak;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class RJeniskontrak extends Component
{
    public $r_jeniskontrak, $rjeniskontrak_kode, $rjeniskontrak_nama;
    public $updateMode = false;

    public function render()
    {
        if (Session::has(env('SESSION_NAME'))) {
            $this->r_jeniskontrak = R_jeniskontrak::all();
            $this->emit('jeniskontrakList');
            return view('livewire.referensi.jeniskontrak.v_r_jeniskontrak')->layout('layouts.main', [
                'navMenu' => ModuleTreeUtils::getMenuNavSideBar(Utility::getSession('sysrole_kode')),
            ]);
        } else {
            session()->flash('login_expired', 'Session Login Habis Silahkan Login Kembali');
            return view('livewire.auth-login')->layout('layouts.login');
        }
    }

    private function resetInputFields()
    {
        $this->rjeniskontrak_nama = '';
    }

    public function store()
    {
        try {
            $this->validate([
                'rjeniskontrak_nama' => 'required'
            ]);
            R_jeniskontrak::create([
                'rjeniskontrak_kode' => ApiUtils::GetNextId('r_jeniskontrak'),
                'rjeniskontrak_nama' => $this->rjeniskontrak_nama
            ]);
            session()->flash('success_message', 'TAMBAH DATA SUKSES');
            $this->resetInputFields();
            $this->emit('jeniskontrakStore');
        } catch (QueryException $e) {
            session()->flash('error_message', 'TAMBAH DATA GAGAL! ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $this->updateMode   = true;
        $r_jeniskontrak           = R_jeniskontrak::where('rjeniskontrak_kode', $id)->first();
        $this->rjeniskontrak_kode = $id;
        $this->rjeniskontrak_nama = $r_jeniskontrak->rjeniskontrak_nama;
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
                'rjeniskontrak_nama' => 'required',
            ]);

            if ($this->rjeniskontrak_kode) {
                $user = R_jeniskontrak::find($this->rjeniskontrak_kode);
                $user->update([
                    'rjeniskontrak_nama' => $this->rjeniskontrak_nama,
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
                R_jeniskontrak::where('rjeniskontrak_kode', $id)->delete();
                session()->flash('success_message', 'HAPUS DATA SUKSES');
            }
        } catch (QueryException $e) {
            session()->flash('error_message', 'HAPUS DATA GAGAL! ' . $e->getMessage());
        }

    }

}
