<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\SalesFinalModel;
use Livewire\Component;

class PaymentsRecordsComponent extends Component
{
    public $datefrom;
    public $dateto;
    public function updateddateto()
    {
        $this->validate([
            'datefrom' => 'required',
        ]);
        if ($this->dateto != null) {
            return redirect()->route('Payment-Records', ['slug' => $this->datefrom, 'slug2' => $this->dateto]);
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
                    $registeredpayments = SalesFinalModel::all();
                } else {
                    $registeredpayments = SalesFinalModel::Where('Branch', Auth::user()->Branch)->get();
                }
            } else {
                if (Auth::user()->utype == 'General Manager' || Auth::user()->utype == 'Administrator') {
                    $registeredpayments = SalesFinalModel::whereDate('created_at', '>=', $this->datefrom)->WhereDate('created_at', '<=', $this->dateto)->get();
                } else {
                    $registeredpayments = SalesFinalModel::whereDate('created_at', '>=', $this->datefrom)->WhereDate('created_at', '<=', $this->dateto)->Where('Branch', Auth::user()->Branch)->get();
                }
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
        return view('livewire.payments-records-component', ['registeredpayments' => $registeredpayments])->layout('layouts.base');
    }
}
