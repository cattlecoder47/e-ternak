<?php

namespace App\Http\Livewire;

use App\Helpers\ModuleTreeUtils;
use App\Helpers\Utility;
use App\Models\Api\R_jenisproduk;
use App\Models\R_produk;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Livewire\WithPagination;

class RProduk extends Component
{
    public $objects = [];
    public $paginator = [];
    public $page = 1;
    public $items_per_page = 10;
    public $loading_message = "";

    use WithPagination;

    protected $updatesQueryString = ['page'];
    protected $paginationTheme = 'bootstrap';
    public $ottJenisProduk, $ottOrderField, $ottOrderBy;


    public $listeners = [
        "load_list" => "loadList"
    ];

    public $filter = [
        "search"      => "",
        "jenisproduk" => "",
        "order_field" => "",
        "order_type"  => "",
    ];

    public $jenisproduk;

    public function mount()
    {
        $this->loadList();
    }

    public function loadList()
    {
        $this->loading_message = "Loading Produk...";

        $query = [];

        if (!empty($this->ottJenisProduk)) {
            $query["r_produk.rjenisproduk_kode"] = $this->ottJenisProduk;
        }

        $objects = R_produk::query()->select('r_produk.rproduk_id',
            'r_jenisproduk.rjenisproduk_nama', 'r_produk.rproduk_desk', 'r_produk.rproduk_tglmasuk',
            'r_produk.rproduk_tglkadaluarsa', 'r_produk.rproduk_qty', 'r_produk.rproduk_hargasatuan',
            'r_satuan.rsatuan_nama', 'r_produk.rproduk_foto', 'sys_user.sysuser_nama', 'r_produk.rproduk_create_at')
            ->join('r_jenisproduk', 'r_produk.rjenisproduk_kode', '=', 'r_jenisproduk.rjenisproduk_kode')
            ->join('r_satuan', 'r_produk.rsatuan_kode', '=', 'r_satuan.rsatuan_kode')
            ->join('sys_user', 'r_produk.sysuser_id', '=', 'sys_user.sysuser_id')
            ->where($query);

        // Search
        if (!empty($this->filter["search"])) {
            $filter  = $this->filter;
            $objects = $objects->where(function ($query) use ($filter) {
                $query->where('rproduk_desk', 'LIKE', '%' . $this->filter['search'] . '%');
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
        $this->ottJenisProduk        = '';
        $this->ottOrderBy            = '';
        $this->ottOrderField         = '';
        $this->filter['search']      = '';
        $this->filter['jenisproduk'] = '';
        $this->filter['order_field'] = '';
        $this->filter['order_type']  = '';
        $this->loadList();
        $this->emit('resetFilter');
    }

    public function delete($id)
    {
        try {
            if ($id) {
                $r_produk = R_produk::where('rproduk_id', $id)->first();
                unlink(storage_path('app/foto_produk/' . $r_produk->rproduk_foto));
                R_produk::where('rproduk_id', $id)->delete();
                session()->flash('success_message', 'HAPUS DATA SUKSES');
                $this->loadList();
            }
        } catch (QueryException $e) {
            session()->flash('error_message', 'HAPUS DATA GAGAL! ' . $e->getMessage());
        }

    }


    /** @noinspection PhpUndefinedMethodInspection */
    public function render()
    {
        if (Session::has(env('SESSION_NAME'))) {
            $this->jenisproduk = R_jenisproduk::all();
            return view('livewire.master.produk.v_r_produk')->layout('layouts.main', [
                'navMenu' => ModuleTreeUtils::getMenuNavSideBar(Utility::getSession('sysrole_kode'))
            ]);
        } else {
            session()->flash('login_expired', 'Session Login Habis Silahkan Login Kembali');
            return view('livewire.auth-login')->layout('layouts.login');
        }
    }


}
