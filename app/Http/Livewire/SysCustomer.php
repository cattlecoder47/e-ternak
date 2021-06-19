<?php

namespace App\Http\Livewire;

use App\Helpers\ApiUtils;
use App\Helpers\ModuleTreeUtils;
use App\Helpers\Utility;
use App\Models\Api\R_jid;
use App\Models\R_kandang;
use App\Models\R_produk;
use App\Models\R_wilayah;
use App\Models\Sys_customer;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Livewire\WithPagination;

class SysCustomer extends Component
{

    public $syscustomer_id, $syscustomer_namalengkap, $syscustomer_alamat, $syscutomer_tempatlahir, $syscustomer_tgllahir, $rjid_kode, $syscustomer_noid, $syscustomer_hp;
    public $updateMode = false;
    public $ottJids = '';
    public $ottPickerTglLahir = '';
    public $jids;

    public $query = '';
    public $wilayahs = [];
    public $selectedWilayah = 0;
    public $highlightIndex = 0;
    public $showDropdown;
    public $kandang = [];
    public $loading_kandang = "";

    public $objects = [];
    public $paginator = [];
    public $page = 1;
    public $items_per_page = 10;

    use WithPagination;

    protected $updatesQueryString = ['page'];
    protected $paginationTheme = 'bootstrap';
    public $ottOrderField, $ottOrderBy;


    public $filter = [
        "search"      => "",
        "order_field" => "",
        "order_type"  => "",
    ];

    public function mount()
    {
        $this->loadList();
    }

    public function loadList()
    {

        $query = [];


        $objects = Sys_customer::query()->select('sys_customer.syscustomer_id', 'sys_customer.syscustomer_namalengkap',
            'sys_customer.syscustomer_alamat', 'sys_customer.syscutomer_tempatlahir', 'sys_customer.syscustomer_tgllahir',
            'sys_customer.syscustomer_noid', 'sys_customer.syscustomer_hp', 'sys_customer.syscustomer_create_at',
            'sys_customer.syscustomer_update_at', 'r_jid.rjid_kode', 'r_jid.rjid_nama', 'r_wilayah.rwilayah_provnama',
            'r_wilayah.rwilayah_jenis', 'r_wilayah.rwilayah_kotanama', 'r_wilayah.rwilayah_kecnama', 'r_wilayah.rwilayah_kelnama',
            'r_wilayah.rwilayah_kodepos')->where($query)
            ->join('r_jid', 'sys_customer.rjid_kode', '=', 'r_jid.rjid_kode')
            ->join('r_wilayah', 'sys_customer.syscustomer_wilayahid', '=', 'r_wilayah.rwilayah_id')
            ->where('syscustomer_verifikasi', '>', 0)
            ->orderBy('syscustomer_id', 'DESC');


        // Search
        if (!empty($this->filter["search"])) {
            $filter  = $this->filter;
            $objects = $objects->where(function ($query) use ($filter) {
                $query->where('syscustomer_namalengkap', 'LIKE', '%' . $this->filter['search'] . '%');
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
        $this->emit('actFilter');

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
        $this->ottOrderBy            = '';
        $this->ottOrderField         = '';
        $this->filter['search']      = '';
        $this->filter['order_field'] = '';
        $this->filter['order_type']  = '';
        $this->loadList();
        $this->emit('resetFilter');

    }

    /** @noinspection PhpUndefinedMethodInspection */
    public function render()
    {
        if (Session::has(env('SESSION_NAME'))) {
            $this->jids = R_jid::all();
            return view('livewire.master.customer.v_sys_customer')->layout('layouts.main', [
                'navMenu' => ModuleTreeUtils::getMenuNavSideBar(Utility::getSession('sysrole_kode'))
            ]);
        } else {
            session()->flash('login_expired', 'Session Login Habis Silahkan Login Kembali');
            return view('livewire.auth-login')->layout('layouts.login');
        }
    }

    private function resetInputFields()
    {
        $this->syscustomer_id          = '';
        $this->rjid_kode               = '';
        $this->syscustomer_namalengkap = '';
        $this->syscustomer_alamat      = '';
        $this->rjid_kode               = '';
        $this->syscutomer_tempatlahir  = '';
        $this->syscustomer_tgllahir    = '';
        $this->syscustomer_noid        = '';
        $this->syscustomer_hp          = '';
        $this->reset();
    }

    public function store()
    {
        try {
            $this->validate([
                'syscustomer_namalengkap' => 'required',
                'syscustomer_alamat'      => 'required',
                'syscutomer_tempatlahir'  => 'required',
                'syscustomer_noid'        => 'required',
                'syscustomer_hp'          => 'required'
            ]);
            Sys_customer::create([
                'syscustomer_id'          => ApiUtils::GetNextId('sys_customer'),
                'syscustomer_namalengkap' => $this->syscustomer_namalengkap,
                'syscustomer_alamat'      => $this->syscustomer_alamat,
                'syscutomer_tempatlahir'  => $this->syscutomer_tempatlahir,
                'syscustomer_tgllahir'    => Utility::convertDate($this->ottPickerTglLahir),
                'rjid_kode'               => $this->ottJids,
                'syscustomer_noid'        => $this->syscustomer_noid,
                'syscustomer_wilayahid'   => $this->selectedWilayah,
                'syscustomer_hp'          => $this->syscustomer_hp,
                'syscustomer_create_at'   => Carbon::parse(now())->format('Y-m-d H:m:s')
            ]);
            session()->flash('success_message', 'TAMBAH DATA SUKSES');
            $this->resetInputFields();
            $this->loadList();
            $this->emit('customerStore');
        } catch (QueryException $e) {
            session()->flash('error_message', 'TAMBAH DATA GAGAL! ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $this->updateMode              = true;
        $sys_customer                  = Sys_customer::where('syscustomer_id', $id)->first();
        $this->syscustomer_id          = $id;
        $this->syscustomer_namalengkap = $sys_customer->syscustomer_namalengkap;
        $this->syscustomer_alamat      = $sys_customer->syscustomer_alamat;
        $this->syscutomer_tempatlahir  = $sys_customer->syscutomer_tempatlahir;
        $this->syscustomer_tgllahir    = Carbon::parse($sys_customer->syscustomer_tgllahir)->format('d-m-Y');
        $this->rjid_kode               = $sys_customer->rjid_kode;
        $this->syscustomer_noid        = $sys_customer->syscustomer_noid;
        $this->selectedWilayah         = $sys_customer->syscustomer_wilayahid;
        $wilayah                       = R_wilayah::query()->selectRaw("CONCAT(rwilayah_provnama,',',rwilayah_kotanama,',',rwilayah_kecnama,',',rwilayah_kelnama,',',rwilayah_kodepos)
            nama_wilayah")->where('rwilayah_id', $sys_customer->syscustomer_wilayahid)->first();
        $this->query                   = $wilayah->nama_wilayah;
        $this->syscustomer_hp          = $sys_customer->syscustomer_hp;
        $this->emit('selectedJidKode', $sys_customer->rjid_kode);
        $this->emit('selectedTglLahir', Carbon::parse($sys_customer->syscustomer_tgllahir)->format('d-m-Y'));
    }

    public function viewKandang($id)
    {
        $this->loading_kandang = "Memuat Data Kandang...";
        $this->kandang         = R_kandang::query()->select('r_kandang.rkandang_id', 'sys_customer.syscustomer_namalengkap',
            'rkandang_size', 'rkandang_dayatampung', 'r_kondjalan.rkondjalan_nama', 'rkandang_foto1', 'rkandang_foto2', 'rkandang_foto3',
            'rkandang_foto4', 'rkandang_create_at')
            ->join('sys_customer', 'r_kandang.syscustomer_id', '=', 'sys_customer.syscustomer_id')
            ->join('r_kondjalan', 'r_kandang.rkondjalan_kode', '=', 'r_kondjalan.rkondjalan_kode')
            ->where('sys_customer.syscustomer_id', $id)->get();
        if (count($this->kandang) == 0) {
            $this->emit('emptyKandang');
        }
        $this->emit('customerKandang');
    }

    public function resetKandang()
    {
        $this->kandang = [];
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
                'syscustomer_namalengkap' => 'required',
                'syscustomer_alamat'      => 'required',
                'syscutomer_tempatlahir'  => 'required',
                'syscustomer_tgllahir'    => 'required',
                'syscustomer_noid'        => 'required',
                'syscustomer_hp'          => 'required'
            ]);

            if ($this->syscustomer_id) {
                $customer = Sys_customer::find($this->syscustomer_id);
                $customer->update([
                    'syscustomer_namalengkap' => $this->syscustomer_namalengkap,
                    'syscustomer_alamat'      => $this->syscustomer_alamat,
                    'syscutomer_tempatlahir'  => $this->syscutomer_tempatlahir,
                    'syscustomer_tgllahir'    => Utility::convertDate($this->ottPickerTglLahir),
                    'rjid_kode'               => $this->ottJids,
                    'syscustomer_noid'        => $this->syscustomer_noid,
                    'syscustomer_wilayahid'   => $this->selectedWilayah,
                    'syscustomer_hp'          => $this->syscustomer_hp,
                ]);
                $this->updateMode = false;
                session()->flash('success_message', 'UPDATE DATA SUKSES');
                $this->resetInputFields();
                $this->emit('customerUpdate');
                $this->loadList();
            }
        } catch (QueryException $e) {
            session()->flash('error_message', 'UPDATE DATA GAGAL! ' . $e->getMessage());

        }
    }

    public function delete($id)
    {
        try {
            if ($id) {
                Sys_customer::where('syscustomer_id', $id)->delete();
                $this->loadList();
                session()->flash('success_message', 'HAPUS DATA SUKSES');
            }
        } catch (QueryException $e) {
            session()->flash('error_message', 'HAPUS DATA GAGAL! ' . $e->getMessage());
        }

    }


    public function reset(...$properties)
    {
        $this->wilayahs        = [];
        $this->highlightIndex  = 0;
        $this->query           = '';
        $this->selectedWilayah = 0;
        $this->showDropdown    = true;
    }

    public function hideDropdown()
    {
        $this->showDropdown = false;
    }

    public function incrementHighlight()
    {
        if ($this->highlightIndex === count($this->wilayahs) - 1) {
            $this->highlightIndex = 0;
            return;
        }

        $this->highlightIndex++;
    }

    public function decrementHighlight()
    {
        if ($this->highlightIndex === 0) {
            $this->highlightIndex = count($this->wilayahs) - 1;
            return;
        }

        $this->highlightIndex--;
    }

    public function selectWilayah($id = null)
    {
        $id = $id ?: $this->highlightIndex;

        $wilayah = $this->wilayahs[$id] ?? null;

        if ($wilayah) {
            $this->showDropdown    = true;
            $this->query           = $wilayah['nama_wilayah'];
            $this->selectedWilayah = $wilayah['rwilayah_id'];
        }
    }

    public function updatedQuery()
    {
        $this->wilayahs = R_wilayah::query()
            ->selectRaw("CONCAT(rwilayah_provnama,',',rwilayah_kotanama,',',rwilayah_kecnama,',',rwilayah_kelnama,',',rwilayah_kodepos)
            nama_wilayah,rwilayah_id")->where('rwilayah_kelnama', 'like', '%' . $this->query . '%')
            ->take(5)
            ->get()
            ->toArray();
    }


}
