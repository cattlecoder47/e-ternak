<?php

namespace App\Http\Livewire;

use App\Helpers\ApiUtils;
use App\Helpers\ModuleTreeUtils;
use App\Helpers\Utility;
use App\Models\Api\R_unit;
use App\Models\R_produk;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Livewire\WithPagination;


class RUnit extends Component
{
    public $runit_kode, $runit_nama, $runit_alamat, $runit_pimpinan;
    public $updateMode = false;
    use WithPagination;

    public $objects = [];
    public $paginator = [];
    public $page = 1;
    public $items_per_page = 10;
    public $ottOrderField, $ottOrderBy;

    protected $updatesQueryString = ['page'];
    protected $paginationTheme = 'bootstrap';


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

        $objects = R_unit::query()->select('runit_kode', 'runit_nama', 'runit_alamat', 'runit_pimpinan', 'runit_create_at')
            ->where($query);

        // Search
        if (!empty($this->filter["search"])) {
            $filter  = $this->filter;
            $objects = $objects->where(function ($query) use ($filter) {
                $query->where('runit_nama', 'LIKE', '%' . $this->filter['search'] . '%');
            });
        }
        if (Utility::getSession('isAdmin') == '0') {
            $objects = $objects->where(function ($query) {
                $query->where('runit_kode', Utility::getSession('runit_kode'));
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
            return view('livewire.master.unit.v_r_unit')->layout('layouts.main', [
                'navMenu' => ModuleTreeUtils::getMenuNavSideBar(Utility::getSession('sysrole_kode')),
            ]);
        } else {
            session()->flash('login_expired', 'Session Login Habis Silahkan Login Kembali');
            return view('livewire.auth-login')->layout('layouts.login');
        }
    }

    private function resetInputFields()
    {
        $this->runit_nama     = '';
        $this->runit_alamat   = '';
        $this->runit_pimpinan = '';
    }

    public function store()
    {
        try {
            $this->validate([
                'runit_nama'     => 'required',
                'runit_alamat'   => 'required',
                'runit_pimpinan' => 'required',
            ]);
            R_unit::create([
                'runit_kode'      => ApiUtils::GetNextId('r_unit'),
                'runit_nama'      => $this->runit_nama,
                'runit_alamat'    => $this->runit_alamat,
                'runit_pimpinan'  => $this->runit_pimpinan,
                'runit_create_at' => Carbon::parse(now())->format('Y-m-d H:m:s')
            ]);
            session()->flash('success_message', 'TAMBAH DATA SUKSES');
            $this->resetInputFields();
            $this->loadList();
            $this->emit('runitStore');
        } catch (QueryException $e) {
            session()->flash('error_message', 'TAMBAH DATA GAGAL! ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $this->updateMode     = true;
        $r_unit               = R_unit::where('runit_kode', $id)->first();
        $this->runit_kode     = $id;
        $this->runit_nama     = $r_unit->runit_nama;
        $this->runit_alamat   = $r_unit->runit_alamat;
        $this->runit_pimpinan = $r_unit->runit_pimpinan;
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
                'runit_nama'     => 'required',
                'runit_alamat'   => 'required',
                'runit_pimpinan' => 'required',
            ]);

            if ($this->runit_kode) {
                $user = R_unit::find($this->runit_kode);
                $user->update([
                    'runit_nama'     => $this->runit_nama,
                    'runit_alamat'   => $this->runit_alamat,
                    'runit_pimpinan' => $this->runit_pimpinan,
                ]);
                $this->updateMode = false;
                session()->flash('success_message', 'UPDATE DATA SUKSES');
                $this->resetInputFields();
                $this->loadList();
            }
        } catch (QueryException $e) {
            session()->flash('success_message', 'UPDATE DATA GAGAL! ' . $e->getMessage());

        }
    }

    public function delete($id)
    {
        try {
            if ($id) {
                R_unit::where('runit_kode', $id)->delete();
                $this->loadList();
                session()->flash('success_message', 'HAPUS DATA SUKSES');
            }
        } catch (QueryException $e) {
            session()->flash('error_message', 'HAPUS DATA GAGAL! ' . $e->getMessage());
        }

    }

}
