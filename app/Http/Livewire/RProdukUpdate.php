<?php

namespace App\Http\Livewire;

use App\Helpers\ModuleTreeUtils;
use App\Helpers\Utility;
use App\Models\Api\R_jenisproduk;
use App\Models\Api\R_satuan;
use App\Models\R_produk;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Livewire\WithFileUploads;

class RProdukUpdate extends Component
{
    public $jenisproduk, $ottJenisProduk;
    public $satuan, $ottSatuan;
    public $ottPickerTglMasukProduk, $ottPickerTglKadaluarsaProduk, $ottHargaSatuan;

    use WithFileUploads;


    public $rproduk_id, $rjenisproduk_kode, $rproduk_desk, $rproduk_tglmasuk, $rproduk_tglkadaluarsa, $rproduk_qty, $rproduk_hargasatuan, $rsatuan_kode, $rproduk_foto, $rproduk_foto_before;

    public function mount()
    {
        $this->edit(Request::segment(4));
    }

    public function edit($id)
    {
        $r_produk                    = R_produk::where('rproduk_id', $id)->first();
        $this->rproduk_id            = $id;
        $this->rproduk_desk          = $r_produk->rproduk_desk;
        $this->rproduk_qty           = $r_produk->rproduk_qty;
        $this->rjenisproduk_kode     = $r_produk->rjenisproduk_kode;
        $this->rproduk_tglmasuk      = Carbon::parse($r_produk->rproduk_tglmasuk)->format('d-m-Y');
        $this->rproduk_tglkadaluarsa = Carbon::parse($r_produk->rproduk_tglkadaluarsa)->format('d-m-Y');
        $this->rsatuan_kode          = $r_produk->rsatuan_kode;
        $this->rproduk_hargasatuan   = Utility::currency($r_produk->rproduk_hargasatuan, 2);
        $this->rproduk_foto_before   = $r_produk->rproduk_foto;

    }

    public function update()
    {
        $r_produk = R_produk::find($this->rproduk_id);
        try {
            if ($this->rproduk_id) {
                if (!empty($this->rproduk_foto)) {
                    $this->validate([
                        'rproduk_foto' => 'required|image|mimes:jpg,jpeg,png,svg,gif|max:2048',
                        'rproduk_desk' => 'required',
                        'rproduk_qty'  => 'required|numeric',
                    ]);
                } else {
                    $this->validate([
                        'rproduk_desk' => 'required',
                        'rproduk_qty'  => 'required|numeric',
                    ]);
                }

                if (!empty($this->rproduk_foto)) {
                    unlink(storage_path('app/foto_produk/' . $r_produk->rproduk_foto));
                    $filename = md5($this->rproduk_foto . microtime()) . '.' . $this->rproduk_foto->extension();
                    $this->rproduk_foto->storeAs('foto_produk', $filename);
                } else {
                    $filename = $r_produk->rproduk_foto;
                }

                $r_produk->update([
                    'rjenisproduk_kode'     => $this->ottJenisProduk,
                    'rproduk_desk'          => $this->rproduk_desk,
                    'rproduk_tglmasuk'      => Utility::convertDate($this->ottPickerTglMasukProduk),
                    'rproduk_tglkadaluarsa' => Utility::convertDate($this->ottPickerTglKadaluarsaProduk),
                    'rproduk_qty'           => $this->rproduk_qty,
                    'rproduk_hargasatuan'   => Utility::unformatMoney($this->ottHargaSatuan),
                    'rsatuan_kode'          => $this->ottSatuan,
                    'rproduk_foto'          => $filename
                ]);
                session()->flash('success_message', 'UPDATE DATA SUKSES');
                return redirect()->to('/master/produk');
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
            $this->jenisproduk = R_jenisproduk::all();
            $this->satuan      = R_satuan::all();
            return view('livewire.master.produk.u_r_produk')->layout('layouts.main', [
                'navMenu' => ModuleTreeUtils::getMenuNavSideBar(Utility::getSession('sysrole_kode'))
            ]);
        } else {
            session()->flash('login_expired', 'Session Login Habis Silahkan Login Kembali');
            return view('livewire.auth-login')->layout('layouts.login');
        }
    }
}
