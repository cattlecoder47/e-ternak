<?php

namespace App\Http\Livewire;

use App\Helpers\ModuleTreeUtils;
use App\Helpers\Utility;
use App\Models\Api\R_kondjalan;
use App\Models\R_kandang;
use App\Models\Sys_customer;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Livewire\WithFileUploads;

class RKandangUpdate extends Component
{
    public $customer, $ottCustomer;
    public $kondjalan, $ottKondjalan;
    use WithFileUploads;


    public $rkandang_id, $syscustomer_id, $rkandang_nama, $rkandang_lokasi, $rkandang_size, $rkandang_dayatampung, $rkondjalan_kode, $rkandang_foto1, $rkandang_foto2, $rkandang_foto3, $rkandang_foto4;
    public $rkandang_foto1_before, $rkandang_foto2_before, $rkandang_foto3_before, $rkandang_foto4_before;

    public function mount()
    {
        $this->edit(Request::segment(4));
    }

    public function edit($id)
    {
        $r_kandang                   = R_kandang::where('rkandang_id', $id)->first();
        $this->rkandang_id           = $id;
        $this->syscustomer_id        = $r_kandang->syscustomer_id;
        $this->rkandang_nama         = $r_kandang->rkandang_nama;
        $this->rkandang_lokasi       = $r_kandang->rkandang_lokasi;
        $this->rkandang_size         = $r_kandang->rkandang_size;
        $this->rkandang_dayatampung  = $r_kandang->rkandang_dayatampung;
        $this->rkondjalan_kode       = $r_kandang->rkondjalan_kode;
        $this->rkandang_foto1_before = $r_kandang->rkandang_foto1;
        $this->rkandang_foto2_before = $r_kandang->rkandang_foto2;
        $this->rkandang_foto3_before = $r_kandang->rkandang_foto3;
        $this->rkandang_foto4_before = $r_kandang->rkandang_foto4;

    }

    public function update()
    {
        $r_kandang = R_kandang::find($this->rkandang_id);
        try {
            if ($this->rkandang_id) {
                if (!empty($this->rkandang_foto1)) {
                    $this->validate([
                        'rkandang_foto1' => 'required|image|mimes:jpg,jpeg,png,svg,gif|max:' . getOption('max_upload_kandang') . '',
                    ]);
                }

                if (!empty($this->rkandang_foto2)) {
                    $this->validate([
                        'rkandang_foto2' => 'required|image|mimes:jpg,jpeg,png,svg,gif|max:' . getOption('max_upload_kandang') . '',
                    ]);
                }
                if (!empty($this->rkandang_foto3)) {
                    $this->validate([
                        'rkandang_foto3' => 'required|image|mimes:jpg,jpeg,png,svg,gif|max:' . getOption('max_upload_kandang') . '',
                    ]);
                }
                if (!empty($this->rkandang_foto4)) {
                    $this->validate([
                        'rkandang_foto4' => 'required|image|mimes:jpg,jpeg,png,svg,gif|max:' . getOption('max_upload_kandang') . '',
                    ]);
                }
                $this->validate([
                    'rkandang_lokasi'      => 'required',
                    'rkandang_size'        => 'required|numeric',
                    'rkandang_dayatampung' => 'required|numeric',
                ]);

                if (!empty($this->rkandang_foto1)) {
                    unlink(storage_path('app/foto_kandang/' . $r_kandang->rkandang_foto1));
                    $filename1 = md5($this->rkandang_foto1 . microtime()) . '.' . $this->rkandang_foto1->extension();
                    $this->rkandang_foto1->storeAs('foto_kandang', $filename1);
                } else {
                    $filename1 = $r_kandang->rkandang_foto1;
                }
                if (!empty($this->rkandang_foto2)) {
                    unlink(storage_path('app/foto_kandang/' . $r_kandang->rkandang_foto2));
                    $filename2 = md5($this->rkandang_foto2 . microtime()) . '.' . $this->rkandang_foto2->extension();
                    $this->rkandang_foto2->storeAs('foto_kandang', $filename2);
                } else {
                    $filename2 = $r_kandang->rkandang_foto2;
                }
                if (!empty($this->rkandang_foto3)) {
                    unlink(storage_path('app/foto_kandang/' . $r_kandang->rkandang_foto3));
                    $filename3 = md5($this->rkandang_foto3 . microtime()) . '.' . $this->rkandang_foto3->extension();
                    $this->rkandang_foto3->storeAs('foto_kandang', $filename3);
                } else {
                    $filename3 = $r_kandang->rkandang_foto3;
                }
                if (!empty($this->rkandang_foto4)) {
                    unlink(storage_path('app/foto_kandang/' . $r_kandang->rkandang_foto4));
                    $filename4 = md5($this->rkandang_foto4 . microtime()) . '.' . $this->rkandang_foto4->extension();
                    $this->rkandang_foto4->storeAs('foto_kandang', $filename4);
                } else {
                    $filename4 = $r_kandang->rkandang_foto4;
                }
                $r_kandang->update([
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
                ]);
                session()->flash('success_message', 'UPDATE DATA SUKSES');
                return redirect()->to('/master/kandang');
            } else {
                session()->flash('error_message', 'UPDATE DATA GAGAL! ');

            }
        } catch (QueryException | Exception $e) {
            session()->flash('error_message', 'UPDATE DATA GAGAL! ' . $e->getMessage());
        }


    }


    /** @noinspection PhpUndefinedMethodInspection */
    public function render()
    {
        if (Session::has(env('SESSION_NAME'))) {
            $this->customer  = Sys_customer::whereRaw('syscustomer_verifikasi > 0')->get();
            $this->kondjalan = R_kondjalan::all();
            return view('livewire.master.kandang.u_r_kandang')->layout('layouts.main', [
                'navMenu' => ModuleTreeUtils::getMenuNavSideBar(Utility::getSession('sysrole_kode'))
            ]);
        } else {
            session()->flash('login_expired', 'Session Login Habis Silahkan Login Kembali');
            return view('livewire.auth-login')->layout('layouts.login');
        }
    }
}
