<?php

namespace App\Http\Livewire;

use App\Models\BranchBalanceModel;
use App\Models\ClientAccountModel;
use App\Models\PaymentMethodModel;
use App\Models\ProductModel;
use App\Models\SalesFinalModel;
use App\Models\SalesModel;
use App\Models\SalesreturnModel;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Salesreturn extends Component
{
    public $purchaseids;
    public $purchaseid;
    public $productnames;
    public $productname;
    public $quantity;
    public $unitcost;
    public $origin;
    public $weight;
    public $sellingprice;
    public $defaultcost;
    public $defaultprice;
    public $description;
    public $unitprice;
    public $salesaccount;
    public $paymentmethod;

    public function CreateProductReturn()
    {
        $this->validate([
            'purchaseid' => 'required',
            'productname' => 'required',
            'quantity' => 'required',
            'unitcost' => 'required',
            'origin' => 'required',
            'weight' => 'required',
            'description' => 'required',
            'unitprice' => 'required',
        ]);
        try {
            $productreturn = new SalesreturnModel();
            $productreturn->SalesRefer = $this->purchaseid;
            $productreturn->ProductRefer = $this->productname;
            $productreturn->Quantity  = $this->quantity;
            $productreturn->PriceRate   = $this->unitprice;
            $productreturn->CostRate  = $this->unitcost;
            $productreturn->ClientAccount  = $this->salesaccount;
            $productreturn->Reason  = $this->description;
            $productreturn->User_id = Auth::user()->id;
            $productreturn->Branch = Auth::user()->Branch;
            $productreturn->save();

            $productinbranch = BranchBalanceModel::where('ProductRefer', $this->productname)->where('Branch', Auth::user()->Branch)->first();
            if ($productinbranch) {
                $ProductfromBranch = BranchBalanceModel::find($productinbranch->id);
                $ProductfromBranch->ItemBalance  = ($productinbranch->ItemBalance + $this->quantity);
                $ProductfromBranch->save();
            }

            $salestransaction = SalesModel::where('Payment_id', $this->purchaseid)->where('ProductRefer', $this->productname)->first();
            if ($salestransaction) {
                $usedaccount=ClientAccountModel::find($salestransaction->Account_id);
                $usedaccount->Received="No";
                $usedaccount->save();
                
                $updatetransaction = SalesModel::find($salestransaction->id);
                $updatetransaction->delete();

                $salesfinaltransaction = SalesFinalModel::find($salestransaction->Payment_id);
                $salesfinaltransaction->delete();
            }
            $accountbal = PaymentMethodModel::find($this->paymentmethod);
            $accountbal->Balance = $accountbal->Balance -($this->quantity * $this->unitprice);
            $accountbal->save();

            session()->flash('returncreate', 'Return Made Successfully');
            return redirect()->route('Sales-Return');
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
    public function updatedpurchaseid($value)
    {
        $this->productnames = SalesModel::where('Payment_id', $value)->get();
        $salesfinaldetails = SalesFinalModel::where('id', $value)->first();
        if ($salesfinaldetails) {
            $this->paymentmethod = $salesfinaldetails->PaymentMethod;
        }
    }
    public function updatedproductname($value)
    {
        $productdetails = ProductModel::where('id', $this->productname)->first();
        if ($productdetails) {
            $this->origin = $productdetails->Origin;
            $this->weight = $productdetails->Weight;
        }

        $salesdetails = SalesModel::where('ProductRefer', $value)->first();
        if ($salesdetails) {
            $this->quantity = $salesdetails->Quantity;
            $this->unitprice = $salesdetails->Price;
            $this->unitcost = $salesdetails->Cost;
            $this->defaultcost = $salesdetails->Cost;
            $this->defaultprice = $salesdetails->Price;
            $this->salesaccount = $salesdetails->Account_id;
        }

       
    }
    public function mount()
    {
        $this->productnames = collect();
        if (Auth::user()->utype == 'General Manager' || Auth::user()->utype == 'Administrator') {
            $this->purchaseids = SalesFinalModel::orderByDesc('id')->get();
        } else {
            $this->purchaseids = SalesFinalModel::Where('Branch', Auth::user()->Branch)->orderBy('id', 'DESC')->get();
        }
    }
    public function render()
    {
        if (Auth::user()->utype == 'General Manager' || Auth::user()->utype == 'Administrator') {
            $registeredreturns = SalesreturnModel::orderBy('id', 'DESC')->get();
        } else {
            $registeredreturns = SalesreturnModel::Where('Branch', Auth::user()->Branch)->orderBy('id', 'DESC')->get();
        }
        return view('livewire.salesreturn', ['registeredreturns' => $registeredreturns])->layout('layouts.base');
    }
}
