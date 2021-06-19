<?php

namespace App\Http\Livewire;

use App\Helpers\ApiUtils;
use App\Helpers\ModuleTreeUtils;
use App\Helpers\Utility;
use App\Models\Api\R_jinsentif;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class RJinsentif extends Component
{
    public $r_jinsentif, $rjinsentif_kode, $rjinsentif_nama;
    public $updateMode = false;

    public function render()
    {
        if (Session::has(env('SESSION_NAME'))) {
            $this->r_jinsentif = R_jinsentif::all();
            $this->emit('jinsentifList');
            return view('livewire.referensi.jinsentif.v_r_jinsentif')->layout('layouts.main', [
                'navMenu' => ModuleTreeUtils::getMenuNavSideBar(Utility::getSession('sysrole_kode')),
            ]);
        } else {
            session()->flash('login_expired', 'Session Login Habis Silahkan Login Kembali');
            return view('livewire.auth-login')->layout('layouts.login');
        }
    }

    private function resetInputFields()
    {
        $this->rjinsentif_nama = '';
    }

    public function store()
    {
        try {
            $this->validate([
                'rjinsentif_nama' => 'required'
            ]);
            R_jinsentif::create([
                'rjinsentif_kode' => ApiUtils::GetNextId('r_jinsentif'),
                'rjinsentif_nama' => $this->rjinsentif_nama
            ]);
            session()->flash('success_message', 'TAMBAH DATA SUKSES');
            $this->resetInputFields();
            $this->emit('jinsentifStore');
        } catch (QueryException $e) {
            session()->flash('error_message', 'TAMBAH DATA GAGAL! ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $this->updateMode   = true;
        $r_jinsentif           = R_jinsentif::where('rjinsentif_kode', $id)->first();
        $this->rjinsentif_kode = $id;
        $this->rjinsentif_nama = $r_jinsentif->rjinsentif_nama;
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
                'rjinsentif_nama' => 'required',
            ]);

            if ($this->rjinsentif_kode) {
                $user = R_jinsentif::find($this->rjinsentif_kode);
                $user->update([
                    'rjinsentif_nama' => $this->rjinsentif_nama,
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
                R_jinsentif::where('rjinsentif_kode', $id)->delete();
                session()->flash('success_message', 'HAPUS DATA SUKSES');
            }
        } catch (QueryException $e) {
            session()->flash('error_message', 'HAPUS DATA GAGAL! ' . $e->getMessage());
        }

    }

}
