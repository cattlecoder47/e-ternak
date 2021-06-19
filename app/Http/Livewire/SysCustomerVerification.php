<?php

namespace App\Http\Livewire;

use App\Helpers\ModuleTreeUtils;
use App\Helpers\Utility;
use App\Models\Sys_customer;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Livewire\WithPagination;

class SysCustomerVerification extends Component
{
    public $objects = [];
    public $paginator = [];
    public $page = 1;
    public $items_per_page = 10;
    public $loading_message = "";

    use WithPagination;

    protected $updatesQueryString = ['page'];
    protected $paginationTheme = 'bootstrap';
    public $ottOrderField, $ottOrderBy;


    public $listeners = [
        "load_list" => "loadList"
    ];

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
        $this->loading_message = "Loading Customer...";

        $query = [];

        $objects = Sys_customer::query()->select('sys_customer.syscustomer_id', 'sys_customer.syscustomer_namalengkap',
            'sys_customer.syscustomer_alamat', 'sys_customer.syscutomer_tempatlahir', 'sys_customer.syscustomer_tgllahir',
            'sys_customer.syscustomer_noid', 'sys_customer.syscustomer_hp', 'sys_customer.syscustomer_create_at',
            'sys_customer.syscustomer_update_at', 'r_jid.rjid_kode', 'r_jid.rjid_nama', 'r_wilayah.rwilayah_provnama',
            'r_wilayah.rwilayah_jenis', 'r_wilayah.rwilayah_kotanama', 'r_wilayah.rwilayah_kecnama', 'r_wilayah.rwilayah_kelnama',
            'r_wilayah.rwilayah_kodepos')
            ->join('r_jid', 'sys_customer.rjid_kode', '=', 'r_jid.rjid_kode')
            ->join('r_wilayah', 'sys_customer.syscustomer_wilayahid', '=', 'r_wilayah.rwilayah_id')
            ->where('syscustomer_verifikasi', '=', 0)
            ->where($query);

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

    public function verifikasi($id)
    {
        try {
            if ($id) {
                $customer = Sys_customer::find($id);
                $customer->update([
                    'syscustomer_verifikasi' => 1
                ]);
                $this->loadList();
                session()->flash('success_message', 'VERIFIKASI DATA CUSTOMER SUKSES');
            }
        } catch (QueryException $e) {
            session()->flash('error_message', 'VERIFIKASI DATA CUSTOMER! ' . $e->getMessage());
        }

    }


    /** @noinspection PhpUndefinedMethodInspection */
    public function render()
    {
        if (Session::has(env('SESSION_NAME'))) {
            return view('livewire.master.customer.v_verif_sys_customer')->layout('layouts.main', [
                'navMenu' => ModuleTreeUtils::getMenuNavSideBar(Utility::getSession('sysrole_kode'))
            ]);
        } else {
            session()->flash('login_expired', 'Session Login Habis Silahkan Login Kembali');
            return view('livewire.auth-login')->layout('layouts.login');
        }
    }


}
