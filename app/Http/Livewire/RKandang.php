<?php

namespace App\Http\Livewire;

use App\Helpers\ModuleTreeUtils;
use App\Helpers\Utility;
use App\Models\Sys_customer;
use App\Models\R_kandang;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Livewire\WithPagination;

class RKandang extends Component
{
    public $objects = [];
    public $paginator = [];
    public $page = 1;
    public $items_per_page = 10;
    public $loading_message = "";

    use WithPagination;

    protected $updatesQueryString = ['page'];
    protected $paginationTheme = 'bootstrap';
    public $ottCustomer, $ottOrderField, $ottOrderBy;

    public $g_rkandang_foto1, $g_rkandang_foto2, $g_rkandang_foto3, $g_rkandang_foto4;


    public $listeners = [
        "load_list" => "loadList"
    ];

    public $filter = [
        "search"      => "",
        "customer"    => "",
        "order_field" => "",
        "order_type"  => "",
    ];

    public $customer;

    public function mount()
    {
        $this->loadList();
    }

    public function loadList()
    {
        $this->loading_message = "Loading Kandang...";

        $query = [];

        if (!empty($this->ottCustomer)) {
            $query["r_kandang.syscustomer_id"] = $this->ottCustomer;
        }

        $objects = R_kandang::query()->select('r_kandang.rkandang_id', 'sys_customer.syscustomer_namalengkap',
            'r_kandang.rkandang_lokasi', 'r_kandang.rkandang_nama','r_kandang.rkandang_size', 'r_kandang.rkandang_dayatampung',
            'r_kondjalan.rkondjalan_nama')
            ->join('sys_customer', 'r_kandang.syscustomer_id', '=', 'sys_customer.syscustomer_id')
            ->join('r_kondjalan', 'r_kandang.rkondjalan_kode', '=', 'r_kondjalan.rkondjalan_kode')
            ->where($query);

        // Search
        if (!empty($this->filter["search"])) {
            $filter  = $this->filter;
            $objects = $objects->where(function ($query) use ($filter) {
                $query->where('rkandang_lokasi', 'LIKE', '%' . $this->filter['search'] . '%');
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
        $this->ottCustomer           = '';
        $this->ottOrderBy            = '';
        $this->ottOrderField         = '';
        $this->filter['search']      = '';
        $this->filter['customer']    = '';
        $this->filter['order_field'] = '';
        $this->filter['order_type']  = '';
        $this->loadList();
        $this->emit('resetFilter');
    }

    public function delete($id)
    {
        try {
            if ($id) {
                $r_kandang = R_kandang::where('rkandang_id', $id)->first();
                unlink(storage_path('app/foto_kandang/' . $r_kandang->rkandang_foto1));
                unlink(storage_path('app/foto_kandang/' . $r_kandang->rkandang_foto2));
                unlink(storage_path('app/foto_kandang/' . $r_kandang->rkandang_foto3));
                unlink(storage_path('app/foto_kandang/' . $r_kandang->rkandang_foto4));
                R_kandang::where('rkandang_id', $id)->delete();
                session()->flash('success_message', 'HAPUS DATA SUKSES');
                $this->loadList();
            }
        } catch (QueryException $e) {
            session()->flash('error_message', 'HAPUS DATA GAGAL! ' . $e->getMessage());
        }

    }

    public function gallery($id)
    {
        $query                  = R_kandang::where('rkandang_id', $id)->first();
        $this->g_rkandang_foto1 = $query->rkandang_foto1;
        $this->g_rkandang_foto2 = $query->rkandang_foto2;
        $this->g_rkandang_foto3 = $query->rkandang_foto3;
        $this->g_rkandang_foto4 = $query->rkandang_foto4;
    }


    /** @noinspection PhpUndefinedMethodInspection */
    public function render()
    {
        if (Session::has(env('SESSION_NAME'))) {
            $this->customer = Sys_customer::all();
            return view('livewire.master.kandang.v_r_kandang')->layout('layouts.main', [
                'navMenu' => ModuleTreeUtils::getMenuNavSideBar(Utility::getSession('sysrole_kode'))
            ]);
        } else {
            session()->flash('login_expired', 'Session Login Habis Silahkan Login Kembali');
            return view('livewire.auth-login')->layout('layouts.login');
        }
    }


}
