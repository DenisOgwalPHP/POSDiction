<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use App\Models\StaffPaymentModel;
use Illuminate\Http\Request;
use Livewire\Component;

class StaffPaymentRecords extends Component
{
    public $datefrom;
    public $dateto;
    public function updateddateto()
    {
        $this->validate([
            'datefrom' => 'required',
        ]);
        if ($this->dateto != null) {
            return redirect()->route('Staff-Payment-Records', ['slug' => $this->datefrom, 'slug2' => $this->dateto]);
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
                    $registeredstaffpayment = StaffPaymentModel::orderby('id', 'DESC')->with('hasstaff')->get();
                } else {
                    $registeredstaffpayment = StaffPaymentModel::Where('Branch', Auth::user()->Branch)->orderby('id', 'DESC')->with('hasstaff')->get();
                }
            } else {
                if (Auth::user()->utype == 'General Manager' || Auth::user()->utype == 'Administrator') {
                    $registeredstaffpayment = StaffPaymentModel::whereDate('PaymentDate', '>=', $this->datefrom)->WhereDate('PaymentDate', '<=', $this->dateto)->orderby('id', 'DESC')->with('hasstaff')->get();
                } else {
                    $registeredstaffpayment = StaffPaymentModel::whereDate('PaymentDate', '>=', $this->datefrom)->WhereDate('PaymentDate', '<=', $this->dateto)->Where('Branch', Auth::user()->Branch)->orderby('id', 'DESC')->with('hasstaff')->get();
                }
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
        return view('livewire.staff-payment-records', ['registeredstaffpayment' => $registeredstaffpayment])->layout('layouts.base');
    }
}
