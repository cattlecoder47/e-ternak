<?php

namespace App\Http\Livewire;

use App\Helpers\ModuleTreeUtils;
use App\Helpers\Utility;
use App\Models\Api\R_prefix;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class RPrefix extends Component
{
    public $r_prefix, $rprefix_tablename, $rprefix_fieldid, $rprefix_kode, $rprefix_idlength;
    public $updateMode = false;

    public function render()
    {
        if (Session::has(env('SESSION_NAME'))) {
            $this->r_prefix = R_prefix::all();
            $this->emit('prefixList');
            return view('livewire.referensi.prefix.v_r_prefix')->layout('layouts.main', [
                'navMenu' => ModuleTreeUtils::getMenuNavSideBar(Utility::getSession('sysrole_kode')),
            ]);
        } else {
            session()->flash('login_expired', 'Session Login Habis Silahkan Login Kembali');
            return view('livewire.auth-login')->layout('layouts.login');
        }
    }

    private function resetInputFields()
    {
        $this->rprefix_tablename = '';
        $this->rprefix_fieldid   = '';
        $this->rprefix_kode      = '';
        $this->rprefix_idlength  = '';
    }

    public function store()
    {
        try {
            $this->validate([
                'rprefix_tablename' => 'required',
                'rprefix_fieldid'   => 'required',
                'rprefix_kode'      => 'required',
                'rprefix_idlength'  => 'required|numeric',
            ]);
            R_prefix::create([
                'rprefix_tablename' => $this->rprefix_tablename,
                'rprefix_fieldid'   => $this->rprefix_fieldid,
                'rprefix_kode'      => $this->rprefix_kode,
                'rprefix_idlength'  => $this->rprefix_idlength,
            ]);
            session()->flash('success_message', 'TAMBAH DATA SUKSES');
            $this->resetInputFields();
            $this->emit('prefixStore');
        } catch (QueryException $e) {
            session()->flash('error_message', 'TAMBAH DATA GAGAL! ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $this->updateMode        = true;
        $r_prefix                = R_prefix::where('rprefix_tablename', $id)->first();
        $this->rprefix_tablename = $id;
        $this->rprefix_fieldid   = $r_prefix->rprefix_fieldid;
        $this->rprefix_kode      = $r_prefix->rprefix_kode;
        $this->rprefix_idlength  = $r_prefix->rprefix_idlength;
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
                'rprefix_fieldid'  => 'required',
                'rprefix_kode'     => 'required',
                'rprefix_idlength' => 'required|numeric',
            ]);

            if ($this->rprefix_tablename) {
                $user = R_prefix::find($this->rprefix_tablename);
                $user->update([
                    'rprefix_fieldid'  => $this->rprefix_fieldid,
                    'rprefix_kode'     => $this->rprefix_kode,
                    'rprefix_idlength' => $this->rprefix_idlength,
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
                R_prefix::where('rprefix_tablename', $id)->delete();
                session()->flash('success_message', 'HAPUS DATA SUKSES');
            }
        } catch (QueryException $e) {
            session()->flash('error_message', 'HAPUS DATA GAGAL! ' . $e->getMessage());
        }

    }

}
