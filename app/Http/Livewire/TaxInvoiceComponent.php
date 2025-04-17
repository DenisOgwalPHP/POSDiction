<?php

namespace App\Http\Livewire;
use Illuminate\Support\Facades\Auth;
use App\Models\SalesFinalModel;
use App\Models\SalesModel;
use Illuminate\Http\Request;
use Livewire\Component;

class TaxInvoiceComponent extends Component
{
    public $purchaseids;
    public $purchaseidd;
    public $selectedsales;
    public $slug;
    public function mount(Request $request)
    {if (Auth::user()->utype == 'General Manager' || Auth::user()->utype == 'Administrator') {
        $this->purchaseids = SalesFinalModel::orderByDesc('id')->get();
    }else{
        $this->purchaseids = SalesFinalModel::Where('Branch', Auth::user()->Branch)->orderBy('id', 'DESC')->get();
    }
        $this->slug = $request->query('slug');
        $this->purchaseidd= $this->slug;
        $this->selectedsales=SalesModel::where('Payment_id',$this->slug)->get();
    }
    public function updatedpurchaseidd($value)
    {
        return redirect()->route('Tax-Invoice',['slug'=>$value]);

    }
    public function render()
    {
        return view('livewire.tax-invoice-component')->layout('layouts.base');
    }
}
