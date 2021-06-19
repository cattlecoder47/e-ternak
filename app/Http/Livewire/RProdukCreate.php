<?php

namespace App\Http\Livewire;

use App\Helpers\ApiUtils;
use App\Helpers\ModuleTreeUtils;
use App\Helpers\Utility;
use App\Models\Api\R_jenisproduk;
use App\Models\Api\R_satuan;
use App\Models\R_produk;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Livewire\WithFileUploads;

class RProdukCreate extends Component
{
    public $jenisproduk, $ottJenisProduk;
    public $satuan, $ottSatuan;
    use WithFileUploads;

    public $ottPickerTglMasukProduk, $ottPickerTglKadaluarsaProduk, $ottHargaSatuan;

    public $rjenisproduk_kode, $rproduk_desk, $rproduk_tglmasuk, $rproduk_tglkadaluarsa, $rproduk_qty, $rproduk_hargasatuan, $rsatuan_kode, $rproduk_foto;

    /** @noinspection PhpUndefinedMethodInspection */
    public function render()
    {
        if (Session::has(env('SESSION_NAME'))) {
            $this->jenisproduk = R_jenisproduk::all();
            $this->satuan      = R_satuan::all();
            return view('livewire.master.produk.c_r_produk')->layout('layouts.main', [
                'navMenu' => ModuleTreeUtils::getMenuNavSideBar(Utility::getSession('sysrole_kode'))
            ]);
        } else {
            session()->flash('login_expired', 'Session Login Habis Silahkan Login Kembali');
            return view('livewire.auth-login')->layout('layouts.login');
        }
    }

    private function resetInputFields()
    {
        $this->rjenisproduk_kode            = '';
        $this->rproduk_desk                 = '';
        $this->rproduk_tglmasuk             = '';
        $this->rproduk_tglkadaluarsa        = '';
        $this->rproduk_qty                  = '';
        $this->rproduk_hargasatuan          = '';
        $this->rsatuan_kode                 = '';
        $this->rproduk_foto                 = '';
        $this->ottJenisProduk               = '';
        $this->ottPickerTglMasukProduk      = '';
        $this->ottPickerTglKadaluarsaProduk = '';
        $this->ottHargaSatuan               = '';
        $this->ottSatuan                    = '';
    }

    public function store()
    {
        try {
            $this->validate([
                'rproduk_foto' => 'required|image|mimes:jpg,jpeg,png,svg,gif|max:2048',
                'rproduk_desk' => 'required',
                'rproduk_qty'  => 'required|numeric',
            ]);
            $filename = md5($this->rproduk_foto . microtime()) . '.' . $this->rproduk_foto->extension();
            $this->rproduk_foto->storeAs('foto_produk', $filename);
            R_produk::create([
                'rproduk_id'            => ApiUtils::GetNextId('r_produk'),
                'rjenisproduk_kode'     => $this->ottJenisProduk,
                'rproduk_desk'          => $this->rproduk_desk,
                'rproduk_tglmasuk'      => Utility::convertDate($this->ottPickerTglMasukProduk),
                'rproduk_tglkadaluarsa' => Utility::convertDate($this->ottPickerTglKadaluarsaProduk),
                'rproduk_qty'           => $this->rproduk_qty,
                'rproduk_hargasatuan'   => Utility::unformatMoney($this->ottHargaSatuan),
                'rsatuan_kode'          => $this->ottSatuan,
                'rproduk_foto'          => $filename,
                'sysuser_id'            => Utility::getSession('sysuser_id'),
                'rproduk_create_at'     => Carbon::parse(now())->format('Y-m-d H:m:s')
            ]);
            session()->flash('success_message', 'TAMBAH DATA SUKSES');
            $this->resetInputFields();
            return redirect()->to('/master/produk/add');
        } catch (QueryException | Exception $e) {
            session()->flash('error_message', 'TAMBAH DATA GAGAL! ' . $e->getMessage());
        }

    }


}
