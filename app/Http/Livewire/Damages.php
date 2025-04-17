<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use App\Models\BranchBalanceModel;
use App\Models\DamagesModel;
use App\Models\ProductModel;
use App\Models\PurchaseModel;
use Livewire\Component;

class Damages extends Component
{
    public $purchaseids;
    public $purchaseid;
    public $productnames;
    public $productname;
    public $quantity;
    public $unitcost;
    public $origin;
    public $weight;
    public $defaultcost;
    public $defaultprice;
    public $description;
    public $unitprice;
    public $supplier;
    public $suppliers;
    public function AddDamages()
    {
        $this->validate([
            'productname' => 'required',
            'quantity' => 'required',
            'unitcost' => 'required',
            'origin' => 'required',
            'weight' => 'required',
            'supplier' => 'required',
            'purchaseid' => 'required',
            'description' => 'required',
            'unitprice' => 'required',
        ]);
        try {
            $productdamage = new DamagesModel();
            $productdamage->PurchaseRefer = $this->purchaseid;
            $productdamage->ProductRefer = $this->productname;
            $productdamage->Quantity  = $this->quantity;
            $productdamage->PriceRate   = $this->unitprice;
            $productdamage->CostRate  = $this->unitcost;
            $productdamage->SupplierAccount   = $this->supplier;
            $productdamage->Reason  = $this->description;
            $productdamage->User_id = Auth::user()->id;
            $productdamage->Branch = Auth::user()->Branch;
            $productdamage->save();

            $productinbranch = BranchBalanceModel::where('ProductRefer', $this->productname)->where('Branch', Auth::user()->Branch)->first();
            if ($productinbranch) {
                $ProductfromBranch = BranchBalanceModel::find($productinbranch->id);
                $ProductfromBranch->ItemBalance  = ($productinbranch->ItemBalance - $this->quantity);
                $ProductfromBranch->save();
            }
            session()->flash('damageremoved', 'Damage Removed Successfully');
            return redirect()->route('Damages');
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
    public function updatedproductname($value)
    {
        $productdetails = ProductModel::where('id', $value)->first();
        if ($productdetails) {
            $this->origin = $productdetails->Origin;
            $this->weight = $productdetails->Weight;
            $this->unitprice = $productdetails->SellingPrice;
            $this->unitcost = $productdetails->PurchaseCost;
        }
        if (Auth::user()->utype == 'General Manager' || Auth::user()->utype == 'Administrator') {
            $this->purchaseids = PurchaseModel::where('ProductName', $value)->get();
        } else {
            $this->purchaseids = PurchaseModel::where('ProductName', $value)->Where('Branch', Auth::user()->Branch)->orderBy('id', 'DESC')->get();
        }
    }
    public function updatedpurchaseid()
    {
        if (Auth::user()->utype == 'General Manager' || Auth::user()->utype == 'Administrator') {
            $this->suppliers = PurchaseModel::where('id', $this->purchaseid)->get();
        } else {
            $this->suppliers = PurchaseModel::where('id', $this->purchaseid)->Where('Branch', Auth::user()->Branch)->orderBy('id', 'DESC')->get();
        }
    }
    public function mount()
    {
        $this->productnames = ProductModel::all();
        $this->suppliers = collect();
        $this->purchaseids = collect();
    }
    public function render()
    {
        if (Auth::user()->utype == 'General Manager' || Auth::user()->utype == 'Administrator') {
            $registereddamages = DamagesModel::orderBy('id', 'DESC')->get();
        } else {
            $registereddamages = DamagesModel::Where('Branch', Auth::user()->Branch)->orderBy('id', 'DESC')->get();
        }
        return view('livewire.damages', ['registereddamages' => $registereddamages])->layout('layouts.base');
    }
}
