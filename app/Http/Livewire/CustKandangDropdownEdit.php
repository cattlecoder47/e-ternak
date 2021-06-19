<?php

namespace App\Http\Livewire;

use App\Models\R_kandang;
use App\Models\Sys_customer;
use Livewire\Component;

class CustKandangDropdownEdit extends Component
{
    public $customers;
    public $kandangs = [];
    public $customer;
    public $kandang;


    public function mount()
    {
        $this->refreshData();
    }

    private function refreshData()
    {
        $this->customers = Sys_customer::whereRaw('syscustomer_verifikasi > 0')->get();
        $this->kandangs  = R_kandang::where('syscustomer_id', $this->customer)->get();

        $this->emit('select2kandangEdit');
    }

    public function render()
    {
        $this->refreshData();
        return view('livewire.cust-kandang-dropdown-edit');
    }
}
