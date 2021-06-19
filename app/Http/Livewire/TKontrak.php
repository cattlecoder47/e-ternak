<?php

namespace App\Http\Livewire;

use App\Helpers\ApiUtils;
use App\Helpers\ModuleTreeUtils;
use App\Helpers\Utility;
use App\Models\Api\R_jeniskontrak;
use App\Models\Api\R_satuan;
use App\Models\Api\R_unit;
use App\Models\T_kontrak;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Livewire\WithPagination;

class TKontrak extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $objects = [];
    public $paginator = [];
    public $page = 1;
    public $items_per_page = 10;
    protected $updatesQueryString = ['page'];
    public $ottJenisKontrakFilter, $ottOrderField, $ottOrderBy;

    public $filter = [
        "search"       => "",
        "jeniskontrak" => "",
        "order_field"  => "",
        "order_type"   => "",
    ];

    public $searchTerm;
    public $updateMode = false;
    public $jenisKontrak, $ottJenisKontrak;
    public $customers, $ottCustomers;
    public $units, $ottUnits;
    public $satuan, $ottSatuanPakan, $ottSatuanObat;
    public $ottHargaAyam, $ottUpahMaklon, $ottBiayaOps, $ottUpahPokok;
    public $ottPickerTglKontrak, $ottPickerTglHabis;
    public $ottKandang;

    public $kandangs = [];
    public $kandang;

    public $tkontrak_id, $rjeniskontrak_kode, $tkontrak_tgl, $syscustomer_id, $runit_kode, $tkontrak_no, $tkontrak_nama,
        $tkontrak_jmlayam, $tkontrak_hargaayampcs, $rsatuanpakan_kode, $tkontrak_pakan,
        $rsatuanobat_kode, $tkontrak_obat, $tkontrak_upahmaklon, $tkontrak_biayaops, $tkontrak_upahpokok, $tkontrak_tglhabis;

    public $d_tkontrak_id, $d_rjeniskontrak_nama, $d_tkontrak_tgl, $d_tkontrak_no,
        $d_syscustomer_namalengkap, $d_runit_nama, $d_runit_pimpinan,
        $d_tkontrak_nama, $d_tkontrak_jmlayam, $d_tkontrak_hargaayampcs,
        $d_rsatuanpakan_kode, $d_tkontrak_pakan, $d_rsatuanobat_kode,
        $d_tkontrak_obat, $d_tkontrak_upahmaklon, $d_tkontrak_biayaops,
        $d_tkontrak_upahpokok, $d_tkontrak_tglhabis, $d_tkontrak_create_at, $d_sysuser_nama,
        $d_rkandang_lokasi, $d_rkandang_size, $d_rkandang_dayatampung;

    public $selected_id;


    public function mount()
    {
        if ($this->updateMode) {
            $this->selected_id = $this->tkontrak_id;
        }
        $this->loadList();
    }

    public function loadList()
    {

        $query = [];

        if (!empty($this->ottJenisKontrakFilter)) {
            $query["t_kontrak.rjeniskontrak_kode"] = $this->ottJenisKontrakFilter;
        }
        if (Utility::getSession('isAdmin') == '0') {
            $query["t_kontrak.runit_kode"] = Utility::getSession('runit_kode');
        }

        $objects = T_kontrak::query()->select('t_kontrak.tkontrak_id', 'r_kandang.rkandang_lokasi', 'r_jeniskontrak.rjeniskontrak_nama',
            't_kontrak.tkontrak_tgl', 't_kontrak.tkontrak_no', 'sys_customer.syscustomer_namalengkap', 'r_unit.runit_nama',
            't_kontrak.tkontrak_nama', 't_kontrak.tkontrak_create_at', 't_kontrak.tkontrak_tglhabis', 'sys_user.sysuser_nama')
            ->join('r_jeniskontrak', 't_kontrak.rjeniskontrak_kode', '=', 'r_jeniskontrak.rjeniskontrak_kode')
            ->join('r_kandang', 't_kontrak.rkandang_id', '=', 'r_kandang.rkandang_id')
            ->join('sys_customer', 't_kontrak.syscustomer_id', '=', 'sys_customer.syscustomer_id')
            ->join('r_unit', 't_kontrak.runit_kode', '=', 'r_unit.runit_kode')
            ->join('sys_user', 't_kontrak.sysuser_id', '=', 'sys_user.sysuser_id')
            ->where($query)->orderBy('tkontrak_id', 'DESC');


        // Search
        if (!empty($this->filter["search"])) {
            $filter  = $this->filter;
            $objects = $objects->where(function ($query) use ($filter) {
                $query->where('tkontrak_no', 'LIKE', '%' . $this->filter['search'] . '%');
            });
        }

        // Ordering
        if (!empty($this->ottOrderField)) {
            $order_type = (!empty($this->ottOrderBy)) ? $this->ottOrderBy : 'ASC';
            $objects    = $objects->orderBy($this->ottOrderField, $order_type);
        }

        // Paginating
        $objects = $objects->paginate($this->items_per_page);


        $this->paginator = $objects->toArray();
        $this->objects   = $objects->items();


    }

    public function applyPagination($action, $value, $options = [])
    {

        if ($action == "previous_page" && $this->page > 1) {
            $this->page -= 1;
        }

        if ($action == "next_page") {
            $this->page += 1;

        }

        if ($action == "page") {
            $this->page = $value;
        }
        $this->loadList();

    }

    public function resetFilter()
    {
        $this->ottJenisKontrakFilter  = '';
        $this->ottOrderBy             = '';
        $this->ottOrderField          = '';
        $this->filter['search']       = '';
        $this->filter['jeniskontrak'] = '';
        $this->filter['order_field']  = '';
        $this->filter['order_type']   = '';
        $this->loadList();
        $this->emit('resetFilter');
    }


    /** @noinspection PhpUndefinedMethodInspection */
    public function render()
    {
        if (Session::has(env('SESSION_NAME'))) {
            $this->jenisKontrak = R_jeniskontrak::all();
            if (Utility::getSession('isAdmin') == '0') {
                $this->units = R_unit::where('runit_kode',Utility::getSession('runit_kode'))->get();
            } else {
                $this->units = R_unit::all();
            }
            $this->satuan = R_satuan::all();

            return view('livewire.master.kontrak.v_t_kontrak')->layout('layouts.main', [
                'navMenu' => ModuleTreeUtils::getMenuNavSideBar(Utility::getSession('sysrole_kode'))
            ]);
        } else {
            session()->flash('login_expired', 'Session Login Habis Silahkan Login Kembali');
            return view('livewire.auth-login')->layout('layouts.login');
        }
    }

    private function resetInputFields()
    {
        $this->rjeniskontrak_kode    = '';
        $this->tkontrak_tgl          = '';
        $this->tkontrak_no           = '';
        $this->tkontrak_nama         = '';
        $this->tkontrak_jmlayam      = '';
        $this->tkontrak_hargaayampcs = '';
        $this->tkontrak_pakan        = '';
        $this->tkontrak_obat         = '';
        $this->tkontrak_upahmaklon   = '';
        $this->tkontrak_biayaops     = '';
        $this->tkontrak_upahpokok    = '';
        $this->tkontrak_tglhabis     = '';
        $this->syscustomer_id        = '';
        $this->runit_kode            = '';
        $this->rsatuanpakan_kode     = '';
        $this->rsatuanobat_kode      = '';
    }

    public function store()
    {
        try {
            $this->validate([
                'tkontrak_no'      => 'required',
                'tkontrak_nama'    => 'required',
                'tkontrak_jmlayam' => 'required|numeric',
                'tkontrak_pakan'   => 'required|numeric',
                'tkontrak_obat'    => 'required|numeric'
            ]);
            T_kontrak::create([
                'tkontrak_id'           => ApiUtils::GetNextId('t_kontrak'),
                'rjeniskontrak_kode'    => $this->ottJenisKontrak,
                'tkontrak_tgl'          => Utility::convertDate($this->ottPickerTglKontrak),
                'tkontrak_no'           => $this->tkontrak_no,
                'syscustomer_id'        => $this->ottCustomers,
                'rkandang_id'           => $this->ottKandang,
                'runit_kode'            => $this->ottUnits,
                'tkontrak_nama'         => $this->tkontrak_nama,
                'tkontrak_jmlayam'      => $this->tkontrak_jmlayam,
                'tkontrak_hargaayampcs' => Utility::unformatMoney($this->ottHargaAyam),
                'rsatuanpakan_kode'     => $this->ottSatuanPakan,
                'tkontrak_pakan'        => $this->tkontrak_pakan,
                'rsatuanobat_kode'      => $this->ottSatuanObat,
                'tkontrak_obat'         => $this->tkontrak_obat,
                'tkontrak_upahmaklon'   => Utility::unformatMoney($this->ottUpahMaklon),
                'tkontrak_biayaops'     => Utility::unformatMoney($this->ottBiayaOps),
                'tkontrak_upahpokok'    => Utility::unformatMoney($this->ottUpahPokok),
                'tkontrak_tglhabis'     => Utility::convertDate($this->ottPickerTglHabis),
                'tkontrak_create_at'    => Carbon::parse(now())->format('Y-m-d H:m:s'),
                'sysuser_id'            => Utility::getSession('sysuser_id')
            ]);
            session()->flash('success_message', 'TAMBAH DATA SUKSES');
            $this->resetInputFields();
            $this->emit('kontrakStore');
            $this->loadList();
        } catch (QueryException $e) {
            session()->flash('error_message', 'TAMBAH DATA GAGAL! ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $this->updateMode            = true;
        $t_kontrak                   = T_kontrak::where('tkontrak_id', $id)->first();
        $this->tkontrak_id           = $id;
        $this->rjeniskontrak_kode    = $t_kontrak->rjeniskontrak_kode;
        $this->tkontrak_tgl          = Carbon::parse($t_kontrak->tkontrak_tgl)->format('d-m-Y');
        $this->tkontrak_no           = $t_kontrak->tkontrak_no;
        $this->syscustomer_id        = $t_kontrak->syscustomer_id;
        $this->runit_kode            = $t_kontrak->runit_kode;
        $this->tkontrak_nama         = $t_kontrak->tkontrak_nama;
        $this->tkontrak_jmlayam      = $t_kontrak->tkontrak_jmlayam;
        $this->tkontrak_hargaayampcs = Utility::currency($t_kontrak->tkontrak_hargaayampcs, 2);
        $this->rsatuanpakan_kode     = $t_kontrak->rsatuanpakan_kode;
        $this->tkontrak_pakan        = $t_kontrak->tkontrak_pakan;
        $this->rsatuanobat_kode      = $t_kontrak->rsatuanobat_kode;
        $this->tkontrak_obat         = $t_kontrak->tkontrak_obat;
        $this->tkontrak_upahmaklon   = Utility::currency($t_kontrak->tkontrak_upahmaklon, 2);
        $this->tkontrak_biayaops     = Utility::currency($t_kontrak->tkontrak_biayaops, 2);
        $this->tkontrak_upahpokok    = Utility::currency($t_kontrak->tkontrak_upahpokok, 2);
        $this->tkontrak_tglhabis     = Carbon::parse($t_kontrak->tkontrak_tglhabis)->format('d-m-Y');

        $this->emit('selectedjenisKontrak', $t_kontrak->rjeniskontrak_kode);
        $this->emit('selectedCustomer', $t_kontrak->syscustomer_id);
        $this->emit('selectedKandang', $t_kontrak->rkandang_id);
        $this->emit('selectedUnit', $t_kontrak->runit_kode);
        $this->emit('selectedSatuanPakan', $t_kontrak->rsatuanpakan_kode);
        $this->emit('selectedSatuanObat', $t_kontrak->rsatuanobat_kode);
        $this->emit('selectedHargaAyam', Utility::currency($t_kontrak->tkontrak_hargaayampcs, 2));
        $this->emit('selectedUpahMaklon', Utility::currency($t_kontrak->tkontrak_upahmaklon, 2));
        $this->emit('selectedBiayaOps', Utility::currency($t_kontrak->tkontrak_biayaops, 2));
        $this->emit('selectedUpahPokok', Utility::currency($t_kontrak->tkontrak_upahpokok, 2));
        $this->emit('selectedTglKontrak', Carbon::parse($t_kontrak->tkontrak_tgl)->format('d-m-Y'));
        $this->emit('selectedTglHabis', Carbon::parse($t_kontrak->tkontrak_tglhabis)->format('d-m-Y'));
        $this->emit('rerenderSidebar');

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
                'tkontrak_no'      => 'required',
                'tkontrak_nama'    => 'required',
                'tkontrak_jmlayam' => 'required|numeric',
                'tkontrak_pakan'   => 'required|numeric',
                'tkontrak_obat'    => 'required|numeric',
            ]);

            if ($this->tkontrak_id) {
                $kontrak = T_kontrak::find($this->tkontrak_id);
                $kontrak->update([
                    'rjeniskontrak_kode'    => $this->ottJenisKontrak,
                    'tkontrak_tgl'          => Utility::convertDate($this->ottPickerTglKontrak),
                    'tkontrak_no'           => $this->tkontrak_no,
                    'syscustomer_id'        => $this->ottCustomers,
                    'rkandang_id'           => $this->ottKandang,
                    'runit_kode'            => $this->ottUnits,
                    'tkontrak_nama'         => $this->tkontrak_nama,
                    'tkontrak_jmlayam'      => $this->tkontrak_jmlayam,
                    'tkontrak_hargaayampcs' => Utility::unformatMoney($this->ottHargaAyam),
                    'rsatuanpakan_kode'     => $this->ottSatuanPakan,
                    'tkontrak_pakan'        => $this->tkontrak_pakan,
                    'rsatuanobat_kode'      => $this->ottSatuanObat,
                    'tkontrak_obat'         => $this->tkontrak_obat,
                    'tkontrak_upahmaklon'   => Utility::unformatMoney($this->ottUpahMaklon),
                    'tkontrak_biayaops'     => Utility::unformatMoney($this->ottBiayaOps),
                    'tkontrak_upahpokok'    => Utility::unformatMoney($this->ottUpahPokok),
                    'tkontrak_tglhabis'     => Utility::convertDate($this->ottPickerTglHabis)
                ]);
                $this->updateMode = false;
                $this->loadList();
                session()->flash('success_message', 'UPDATE DATA SUKSES');
                $this->resetInputFields();
            }
        } catch (QueryException $e) {
            session()->flash('error_message', 'UPDATE DATA GAGAL! ' . $e->getMessage());

        }
    }

    public function detail($id)
    {
        $query = T_kontrak::query()->select('t_kontrak.tkontrak_id', 'r_jeniskontrak.rjeniskontrak_nama', 't_kontrak.tkontrak_tgl', 't_kontrak.tkontrak_no',
            'sys_customer.syscustomer_namalengkap', 'r_unit.runit_nama', 'r_unit.runit_pimpinan', 't_kontrak.tkontrak_nama', 't_kontrak.tkontrak_jmlayam',
            't_kontrak.tkontrak_hargaayampcs', 't_kontrak.rsatuanpakan_kode', 't_kontrak.tkontrak_pakan', 't_kontrak.rsatuanobat_kode',
            't_kontrak.tkontrak_obat', 't_kontrak.tkontrak_upahmaklon', 't_kontrak.tkontrak_biayaops', 't_kontrak.tkontrak_upahpokok',
            't_kontrak.tkontrak_tglhabis', 't_kontrak.tkontrak_create_at', 'sys_user.sysuser_nama',
            'r_kandang.rkandang_lokasi', 'r_kandang.rkandang_size', 'r_kandang.rkandang_dayatampung')
            ->join('r_jeniskontrak', 't_kontrak.rjeniskontrak_kode', '=', 'r_jeniskontrak.rjeniskontrak_kode')
            ->join('sys_customer', 't_kontrak.syscustomer_id', '=', 'sys_customer.syscustomer_id')
            ->join('r_kandang', 't_kontrak.rkandang_id', '=', 'r_kandang.rkandang_id')
            ->join('r_unit', 't_kontrak.runit_kode', '=', 'r_unit.runit_kode')
            ->join('sys_user', 't_kontrak.sysuser_id', '=', 'sys_user.sysuser_id')
            ->where('tkontrak_id', $id)->first();
        if (isset($query->tkontrak_id)) {
            $this->d_tkontrak_id = $query->tkontrak_id;
        }
        if (isset($query->rjeniskontrak_nama)) {
            $this->d_rjeniskontrak_nama = $query->rjeniskontrak_nama;
        }
        if (isset($query->tkontrak_tgl)) {
            $this->d_tkontrak_tgl = Carbon::parse($query->tkontrak_tgl)->format('d-m-Y');
        }
        if (!empty($query->tkontrak_no)) {
            $this->d_tkontrak_no = $query->tkontrak_no;
        }
        if (isset($query->syscustomer_namalengkap)) {
            $this->d_syscustomer_namalengkap = $query->syscustomer_namalengkap;
        }
        if (!empty($query->runit_nama)) {
            $this->d_runit_nama = $query->runit_nama;
        }
        if (isset($query->runit_pimpinan)) {
            $this->d_runit_pimpinan = $query->runit_pimpinan;
        }
        if (!empty($query->tkontrak_nama)) {
            $this->d_tkontrak_nama = $query->tkontrak_nama;
        }

        if (!empty($query->rkandang_size)) {
            $this->d_rkandang_size = $query->rkandang_size;
        }

        if (!empty($query->rkandang_dayatampung)) {
            $this->d_rkandang_dayatampung = $query->rkandang_dayatampung;
        }

        if (!empty($query->rkandang_lokasi)) {
            $this->d_rkandang_lokasi = $query->rkandang_lokasi;
        }

        if (isset($query->tkontrak_jmlayam)) {
            $this->d_tkontrak_jmlayam = $query->tkontrak_jmlayam;
        }

        if (!empty($query->tkontrak_hargaayampcs)) {
            $this->d_tkontrak_hargaayampcs = Utility::currency($query->tkontrak_hargaayampcs, 2);
        }
        if (isset($query->rsatuanpakan_kode)) {
            $qSatuanPakanNama          = R_satuan::where('rsatuan_kode', $query->rsatuanpakan_kode)->first();
            $this->d_rsatuanpakan_kode = $qSatuanPakanNama->rsatuan_nama;
        }
        if (isset($query->tkontrak_pakan)) {
            $this->d_tkontrak_pakan = Utility::currency($query->tkontrak_pakan, 2);
        }
        if (isset($query->rsatuanobat_kode)) {
            $qSatuanObatNama          = R_satuan::where('rsatuan_kode', $query->rsatuanobat_kode)->first();
            $this->d_rsatuanobat_kode = $qSatuanObatNama->rsatuan_nama;
        }
        if (!empty($query->tkontrak_obat)) {
            $this->d_tkontrak_obat = Utility::currency($query->tkontrak_obat, 2);
        }
        if (isset($query->tkontrak_upahmaklon)) {
            $this->d_tkontrak_upahmaklon = Utility::currency($query->tkontrak_upahmaklon, 2);
        }
        if (isset($query->tkontrak_biayaops)) {
            $this->d_tkontrak_biayaops = Utility::currency($query->tkontrak_biayaops, 2);
        }
        if (!empty($query->tkontrak_upahpokok)) {
            $this->d_tkontrak_upahpokok = Utility::currency($query->tkontrak_upahpokok, 2);
        }
        if (!empty($query->tkontrak_tglhabis)) {
            $this->d_tkontrak_tglhabis = Carbon::parse($query->tkontrak_tglhabis)->format('d-m-Y');
        }
        if (!empty($query->tkontrak_create_at)) {
            $this->d_tkontrak_create_at = Carbon::parse($query->tkontrak_create_at)->format('d-m-Y H:m:s');
        }
        if (!empty($query->sysuser_nama)) {
            $this->d_sysuser_nama = $query->sysuser_nama;
        }
    }

    public function delete($id)
    {
        try {
            if ($id) {
                T_kontrak::where('tkontrak_id', $id)->delete();
                $this->loadList();
                session()->flash('success_message', 'HAPUS DATA SUKSES');
            }
        } catch (QueryException $e) {
            session()->flash('error_message', 'HAPUS DATA GAGAL! ' . $e->getMessage());
        }

    }
}
