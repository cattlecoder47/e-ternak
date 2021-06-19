<?php

namespace App\Http\Livewire;

use App\Helpers\ApiUtils;
use App\Helpers\ModuleTreeUtils;
use App\Helpers\Utility;
use App\Models\Api\R_kondjalan;
use App\Models\R_kandang;
use App\Models\Sys_customer;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Livewire\WithFileUploads;

class RKandangCreate extends Component
{
    public $customer, $ottCustomer;
    public $kondjalan, $ottKondjalan;
    use WithFileUploads;


    public $syscustomer_id, $rkandang_nama, $rkandang_lokasi, $rkandang_size, $rkandang_dayatampung, $rkondjalan_kode, $rkandang_foto1, $rkandang_foto2, $rkandang_foto3, $rkandang_foto4;

    /** @noinspection PhpUndefinedMethodInspection */
    public function render()
    {
        if (Session::has(env('SESSION_NAME'))) {
            $this->customer  = Sys_customer::whereRaw('syscustomer_verifikasi > 0')->get();
            $this->kondjalan = R_kondjalan::all();
            return view('livewire.master.kandang.c_r_kandang')->layout('layouts.main', [
                'navMenu' => ModuleTreeUtils::getMenuNavSideBar(Utility::getSession('sysrole_kode'))
            ]);
        } else {
            session()->flash('login_expired', 'Session Login Habis Silahkan Login Kembali');
            return view('livewire.auth-login')->layout('layouts.login');
        }
    }

    private function resetInputFields()
    {
        $this->syscustomer_id       = '';
        $this->rkandang_nama        = '';
        $this->rkandang_lokasi      = '';
        $this->rkandang_size        = '';
        $this->rkandang_dayatampung = '';
        $this->rkondjalan_kode      = '';
        $this->rkandang_foto1       = '';
        $this->rkandang_foto2       = '';
        $this->rkandang_foto3       = '';
        $this->rkandang_foto4       = '';
        $this->ottCustomer          = '';
        $this->ottKondjalan         = '';
    }

    public function store()
    {
        try {
            $this->validate([
                'rkandang_foto1'       => 'required|image|mimes:jpg,jpeg,png,svg,gif|max:' . getOption('max_upload_kandang') . '',
                'rkandang_foto2'       => 'required|image|mimes:jpg,jpeg,png,svg,gif|max:' . getOption('max_upload_kandang') . '',
                'rkandang_foto3'       => 'required|image|mimes:jpg,jpeg,png,svg,gif|max:' . getOption('max_upload_kandang') . '',
                'rkandang_foto4'       => 'required|image|mimes:jpg,jpeg,png,svg,gif|max:' . getOption('max_upload_kandang') . '',
                'rkandang_nama'        => 'required',
                'rkandang_lokasi'      => 'required',
                'rkandang_size'        => 'required|numeric',
                'rkandang_dayatampung' => 'required|numeric',
            ]);
            $filename1 = md5($this->rkandang_foto1 . microtime()) . '.' . $this->rkandang_foto1->extension();
            $filename2 = md5($this->rkandang_foto2 . microtime()) . '.' . $this->rkandang_foto2->extension();
            $filename3 = md5($this->rkandang_foto3 . microtime()) . '.' . $this->rkandang_foto3->extension();
            $filename4 = md5($this->rkandang_foto4 . microtime()) . '.' . $this->rkandang_foto4->extension();
            $this->rkandang_foto1->storeAs('foto_kandang', $filename1);
            $this->rkandang_foto2->storeAs('foto_kandang', $filename2);
            $this->rkandang_foto3->storeAs('foto_kandang', $filename3);
            $this->rkandang_foto4->storeAs('foto_kandang', $filename4);
            R_kandang::create([
                'rkandang_id'          => ApiUtils::GetNextId('r_kandang'),
                'syscustomer_id'       => $this->ottCustomer,
                'rkandang_nama'        => $this->rkandang_nama,
                'rkandang_lokasi'      => $this->rkandang_lokasi,
                'rkandang_size'        => $this->rkandang_size,
                'rkandang_dayatampung' => $this->rkandang_dayatampung,
                'rkondjalan_kode'      => $this->ottKondjalan,
                'rkandang_foto1'       => $filename1,
                'rkandang_foto2'       => $filename2,
                'rkandang_foto3'       => $filename3,
                'rkandang_foto4'       => $filename4,
                'rkandang_create_at'   => Carbon::parse(now())->format('Y-m-d H:m:s')
            ]);
            session()->flash('success_message', 'TAMBAH DATA SUKSES');
            $this->resetInputFields();
            return redirect()->to('/master/kandang/add');
        } catch (QueryException | Exception $e) {
            session()->flash('error_message', 'TAMBAH DATA GAGAL! ' . $e->getMessage());
        }

    }


}
