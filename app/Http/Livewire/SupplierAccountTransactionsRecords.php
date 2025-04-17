<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\SupplierAccountBalanceModel;
use Livewire\Component;

class SupplierAccountTransactionsRecords extends Component
{
    public $datefrom;
    public $dateto;
    public function updateddateto()
    {
        $this->validate([
            'datefrom' => 'required',
        ]);
        if ($this->dateto != null) {
            return redirect()->route('Supplier-Account-Transaction-Records', ['slug' => $this->datefrom, 'slug2' => $this->dateto]);
        }
    }
    public function mount(Request $request)
    {
        $this->datefrom = $request->slug;
        $this->dateto = $request->slug2;
    }

    public function render()
    {
        try {
            if ($this->dateto == null) {
                if (Auth::user()->utype == 'General Manager' || Auth::user()->utype == 'Administrator') {
                    $registeredsuppliertransactions = SupplierAccountBalanceModel::orderByDesc('id')->get();
                } else {
                    $registeredsuppliertransactions = SupplierAccountBalanceModel::Where('Branch', Auth::user()->Branch)->orderByDesc('id')->get();
                }
            } else {
                if (Auth::user()->utype == 'General Manager' || Auth::user()->utype == 'Administrator') {
                    $registeredsuppliertransactions = SupplierAccountBalanceModel::whereDate('created_at', '>=', $this->datefrom)->WhereDate('created_at', '<=', $this->dateto)->orderByDesc('id')->get();
                } else {
                    $registeredsuppliertransactions = SupplierAccountBalanceModel::whereDate('created_at', '>=', $this->datefrom)->WhereDate('created_at', '<=', $this->dateto)->Where('Branch', Auth::user()->Branch)->orderByDesc('id')->get();
                }
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
        return view('livewire.supplier-account-transactions-records', ['registeredsuppliertransactions' => $registeredsuppliertransactions])->layout('layouts.base');
    }
}
