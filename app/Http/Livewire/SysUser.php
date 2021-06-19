<?php

namespace App\Http\Livewire;

use App\Helpers\ApiUtils;
use App\Helpers\ModuleTreeUtils;
use App\Helpers\Utility;
use App\Models\Api\R_unit;
use App\Models\Api\Sys_role;
use App\Models\R_produk;
use App\Models\Sys_user;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Livewire\WithPagination;

class SysUser extends Component
{
    public $sysuser_id, $sysrole_kode, $runit_kode, $sysuser_nama, $sysuser_namalengkap, $sysuser_passw, $sysuser_passw_confirmation, $sysuser_hp, $sysuser_email, $sysuser_otorize;
    public $updateMode = false;
    public $ottRoles, $ottOtorize, $ottUnits;
    public $roles;
    public $units;
    public $objects = [];
    public $paginator = [];
    public $page = 1;
    public $items_per_page = 10;
    public $ottRoleFilter, $ottOrderField, $ottOrderBy;

    use WithPagination;

    protected $updatesQueryString = ['page'];
    protected $paginationTheme = 'bootstrap';


    public $filter = [
        "search"      => "",
        "role"        => "",
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

        if (!empty($this->ottRoleFilter)) {
            $query["sys_user.sysrole_kode"] = $this->ottRoleFilter;
        }
        if (Utility::getSession('isAdmin') == '0') {
            $query["sys_user.runit_kode"] = Utility::getSession('runit_kode');
        }

        $objects = Sys_user::query()->select('sys_user.sysuser_id', 'sys_role.sysrole_nama', 'sys_user.sysuser_nama',
            'sys_user.sysuser_namalengkap', 'sys_user.sysuser_hp',
            'sys_user.sysuser_email', 'sys_user.sysuser_otorize', 'sys_user.sysuser_create_at', 'r_unit.runit_nama')
            ->join('sys_role', 'sys_user.sysrole_kode', '=', 'sys_role.sysrole_kode')
            ->leftJoin('r_unit', 'sys_user.runit_kode', '=', 'r_unit.runit_kode')
            ->where($query);

        // Search
        if (!empty($this->filter["search"])) {
            $filter  = $this->filter;
            $objects = $objects->where(function ($query) use ($filter) {
                $query->where('sysuser_namalengkap', 'LIKE', '%' . $this->filter['search'] . '%');
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

    /** @noinspection PhpUndefinedMethodInspection */
    public function render()
    {
        if (Session::has(env('SESSION_NAME'))) {
            $this->roles = Sys_role::all();
            if (Utility::getSession('isAdmin') == '0') {
                $this->units = R_unit::where('runit_kode', Utility::getSession('runit_kode'))->get();
            } else {
                $this->units = R_unit::all();
            }
            return view('livewire.user.sysuser.v_sys_user')->layout('layouts.main', [
                'navMenu' => ModuleTreeUtils::getMenuNavSideBar(Utility::getSession('sysrole_kode')),
            ]);
        } else {
            session()->flash('login_expired', 'Session Login Habis Silahkan Login Kembali');
            return view('livewire.auth-login')->layout('layouts.login');
        }
    }

    private function resetInputFields()
    {
        $this->sysuser_id                 = '';
        $this->sysrole_kode               = '';
        $this->runit_kode                 = '';
        $this->sysuser_nama               = '';
        $this->sysuser_namalengkap        = '';
        $this->sysuser_passw              = '';
        $this->sysuser_passw_confirmation = '';
        $this->sysuser_hp                 = '';
        $this->sysuser_email              = '';
        $this->sysuser_otorize            = '';
    }

    public function resetFilter()
    {
        $this->ottRoleFilter         = '';
        $this->ottOrderBy            = '';
        $this->ottOrderField         = '';
        $this->filter['search']      = '';
        $this->filter['role']        = '';
        $this->filter['order_field'] = '';
        $this->filter['order_type']  = '';
        $this->loadList();
        $this->emit('resetFilter');
    }

    public function store()
    {
        try {
            $this->validate([
                'sysuser_nama'               => 'required',
                'sysuser_namalengkap'        => 'required',
                'sysuser_passw'              => 'required|required_with:sysuser_passw_confirmation|string|confirmed',
                'sysuser_passw_confirmation' => 'required',
                'sysuser_hp'                 => 'required',
                'sysuser_email'              => 'required|email'
            ]);
            if (empty($this->ottUnits)) {
                $unit = NULL;
            } else {
                $unit = $this->ottUnits;
            }
            if (Utility::getSession('isAdmin') == '0') {
                if (empty($this->ottUnits)) {
                    $this->emit('emptyUnit');
                    return;
                }
            }
            Sys_user::create([
                'sysuser_id'          => ApiUtils::GetNextId('sys_user'),
                'sysrole_kode'        => $this->ottRoles,
                'runit_kode'          => $unit,
                'sysuser_nama'        => $this->sysuser_nama,
                'sysuser_namalengkap' => $this->sysuser_namalengkap,
                'sysuser_passw'       => Hash::make($this->sysuser_passw),
                'sysuser_hp'          => $this->sysuser_hp,
                'sysuser_email'       => $this->sysuser_email,
                'sysuser_otorize'     => $this->ottOtorize,
                'sysuser_create_at'   => Carbon::parse(now())->format('Y-m-d H:m:s')
            ]);
            session()->flash('success_message', 'TAMBAH DATA SUKSES');
            $this->resetInputFields();
            $this->emit('sysuserStore');
            $this->loadList();
        } catch (QueryException $e) {
            session()->flash('error_message', 'TAMBAH DATA GAGAL! ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $this->updateMode          = true;
        $sys_user                  = Sys_user::where('sysuser_id', $id)->first();
        $this->sysuser_id          = $id;
        $this->sysrole_kode        = $sys_user->sysrole_kode;
        $this->runit_kode          = $sys_user->runit_kode;
        $this->sysuser_nama        = $sys_user->sysuser_nama;
        $this->sysuser_namalengkap = $sys_user->sysuser_namalengkap;
        $this->sysuser_hp          = $sys_user->sysuser_hp;
        $this->sysuser_email       = $sys_user->sysuser_email;
        $this->sysuser_otorize     = $sys_user->sysuser_otorize;
        $this->emit('selectedRoleKode', $sys_user->sysrole_kode);
        $this->emit('selectedOtorize', $sys_user->sysuser_otorize);
        $this->emit('selectedUnit', $sys_user->runit_kode);
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
                'sysuser_nama'        => 'required',
                'sysuser_namalengkap' => 'required',
                'sysuser_hp'          => 'required',
                'sysuser_email'       => 'required',
            ]);

            if ($this->sysuser_id) {
                if (empty($this->ottUnits)) {
                    $unit = NULL;
                } else {
                    $unit = $this->ottUnits;
                }
                if (Utility::getSession('isAdmin') == '0') {
                    if (empty($this->ottUnits)) {
                        $this->emit('emptyUnit');
                        return;
                    }
                }
                $user = Sys_user::find($this->sysuser_id);
                $user->update([
                    'sysrole_kode'        => $this->ottRoles,
                    'runit_kode'          => $unit,
                    'sysuser_nama'        => $this->sysuser_nama,
                    'sysuser_namalengkap' => $this->sysuser_namalengkap,
                    'sysuser_hp'          => $this->sysuser_hp,
                    'sysuser_email'       => $this->sysuser_email,
                    'sysuser_otorize'     => $this->ottOtorize,
                ]);
                $this->updateMode = false;
                session()->flash('success_message', 'UPDATE DATA SUKSES');
                $this->resetInputFields();
                $this->loadList();
                $this->emit('sysuserUpdate');
            }
        } catch (QueryException $e) {
            session()->flash('error_message', 'UPDATE DATA GAGAL! ' . $e->getMessage());

        }
    }

    public function delete($id)
    {
        try {
            if ($id) {
                if (Utility::getSession('sysuser_id') == $id) {
                    session()->flash('error_message', 'TIDAK BISA MENGHAPUS USER YANG SEDANG AKTIF');
                } else {
                    Sys_user::where('sysuser_id', $id)->delete();
                    $this->loadList();
                    session()->flash('success_message', 'HAPUS DATA SUKSES');
                }

            }
        } catch (QueryException $e) {
            session()->flash('error_message', 'HAPUS DATA GAGAL! ' . $e->getMessage());
        }

    }


}
