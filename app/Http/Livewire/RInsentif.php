<?php

namespace App\Http\Livewire;

use App\Helpers\ModuleTreeUtils;
use App\Helpers\Utility;
use App\Models\Api\R_insentif;
use App\Models\Api\R_jinsentif;
use App\Models\R_wilayah;
use App\Models\Sys_customer;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class RInsentif extends Component
{
    public $jinsentif;
    public $insentif = [];
    public $ottJinsentif;
    public $updateMode = false;
    public $rinsentif_kode, $rjinsentif_kode, $rinsentif_min, $rinsentif_max, $rinsentif_nominal;
    public $ottRinsentifMin;
    public $ottRinsentifMax;
    public $ottRinsentifNominal;


    public function render()
    {
        if (Session::has(env('SESSION_NAME'))) {
            $this->jinsentif = R_jinsentif::all();
            return view('livewire.master.insentif.v_r_insentif')->layout('layouts.main', [
                'navMenu' => ModuleTreeUtils::getMenuNavSideBar(Utility::getSession('sysrole_kode'))
            ]);
        } else {
            session()->flash('login_expired', 'Session Login Habis Silahkan Login Kembali');
            return view('livewire.auth-login')->layout('layouts.login');
        }
    }

    public function filter()
    {
        $this->insentif = R_insentif::query()->select('rinsentif_kode', 'rjinsentif_nama', 'rinsentif_min', 'rinsentif_max', 'rinsentif_nominal')
            ->join('r_jinsentif', 'r_insentif.rjinsentif_kode', '=', 'r_jinsentif.rjinsentif_kode')
            ->where('r_jinsentif.rjinsentif_kode', '=', $this->ottJinsentif)->get();
        $this->emit('actFilter');
    }

    private function resetInputFields()
    {
        $this->rinsentif_kode    = '';
        $this->rjinsentif_kode   = '';
        $this->rinsentif_min     = '';
        $this->rinsentif_max     = '';
        $this->rinsentif_nominal = '';
    }

    public function clear()
    {
        $this->insentif = [];
        $this->emit('clearFilter');
    }

    public function edit($id)
    {
        $this->updateMode        = true;
        $this->filter();
        $r_insentif              = R_insentif::where('rinsentif_kode', $id)->first();
        $this->rinsentif_kode    = $r_insentif->rinsentif_kode;
        $this->rjinsentif_kode   = $r_insentif->rjinsentif_kode;
        $this->rinsentif_min     = Utility::currency($r_insentif->rinsentif_min, 2);
        $this->rinsentif_max     = Utility::currency($r_insentif->rinsentif_max, 2);
        $this->rinsentif_nominal = Utility::currency($r_insentif->rinsentif_nominal, 2);
        $this->emit('selectedRinsentifMin', $r_insentif->rinsentif_min);
        $this->emit('selectedRinsentifMax', $r_insentif->rinsentif_max);
        $this->emit('selectedRinsentifNominal', $r_insentif->rinsentif_nominal);
    }

    public function update()
    {
        try {
            if ($this->rinsentif_kode) {
                $insentif = R_insentif::find($this->rinsentif_kode);
                $insentif->update([
                    'rjinsentif_kode'   => $this->rjinsentif_kode,
                    'rinsentif_min'     => Utility::unformatMoney($this->ottRinsentifMin),
                    'rinsentif_max'     => Utility::unformatMoney($this->ottRinsentifMax),
                    'rinsentif_nominal' => Utility::unformatMoney($this->ottRinsentifNominal),
                ]);
                $this->updateMode = false;
                session()->flash('success_message', 'UPDATE DATA SUKSES');
                $this->filter();
            }
        } catch (QueryException $e) {
            session()->flash('error_message', 'UPDATE DATA GAGAL! ' . $e->getMessage());
        }
    }


    public function cancel()
    {
        $this->updateMode = false;
        $this->resetInputFields();
    }
}
