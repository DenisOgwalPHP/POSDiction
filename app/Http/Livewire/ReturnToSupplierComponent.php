<?php

namespace App\Http\Livewire;

use App\Models\BranchBalanceModel;
use App\Models\BranchModel;
use App\Models\DistributionModel;
use App\Models\ProductModel;
use App\Models\PurchaseModel;
use App\Models\UnitsModel;
use App\Models\StoreBalanceModel;
use App\Models\SupplierAccountModel;
use App\Models\SupplierReturnsModel;
use App\Models\SupplierTransactionsModel;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ReturnToSupplierComponent extends Component
{
    public $branch;
    public $branchto;
    public $branchfrom;
    public $branches;
    public $purchaseids;
    public $purchaseid;
    public $productnames;
    public $productname;
    public $units;
    public $manufacturer;
    public $quantity;
    public $unitname;
    public $unitcost;
    public $origin;
    public $weight;
    public $sellingprice;
    public $defaultcost;
    public $distributiondate;
    public $supplier;
    public $suppliers;
    public $description;

    public function CreateProductReturn()
    {
        $this->validate([
            'branch' => 'required',
            'purchaseid' => 'required',
            'productname' => 'required',
            'quantity' => 'required',
            'unitcost' => 'required',
            'origin' => 'required',
            'weight' => 'required',
            'description' => 'required',
            'supplier' => 'required',
        ]);
        try {
            $producttosupplier = new SupplierReturnsModel();
            $producttosupplier->ProductID = $this->productname;
            $producttosupplier->PurchaseID = $this->purchaseid;
            $producttosupplier->Quantity  = $this->quantity;
            $producttosupplier->SupplierID   = $this->supplier;
            $producttosupplier->Reason  = $this->description;
            $producttosupplier->User_id = Auth::user()->id;
            $producttosupplier->Branch = $this->branch;
            $producttosupplier->save();

            if ($this->branchfrom == "100") {
                $productinstore = StoreBalanceModel::where('ProductRefer', $this->productname)->first();
                if ($productinstore) {
                    $ProductfromStore = StoreBalanceModel::find($productinstore->id);
                    $ProductfromStore->ProductRefer = $this->productname;
                    $ProductfromStore->Origin = $this->origin;
                    $ProductfromStore->Weight  = $this->weight;
                    $ProductfromStore->ItemBalance  = ($productinstore->ItemBalance - $this->quantity);
                    $ProductfromStore->User_id = Auth::user()->id;
                    $ProductfromStore->save();
                }
            } else {
                $productinbranch = BranchBalanceModel::where('ProductRefer', $this->productname)->where('Branch', $this->branch)->first();
                if ($productinbranch) {
                    $ProductfromBranch = BranchBalanceModel::find($productinbranch->id);
                    $ProductfromBranch->ProductRefer = $this->productname;
                    $ProductfromBranch->Origin = $this->origin;
                    $ProductfromBranch->Weight  = $this->weight;
                    $ProductfromBranch->ItemBalance  = ($productinbranch->ItemBalance - $this->quantity);
                    $ProductfromBranch->User_id = Auth::user()->id;
                    $ProductfromBranch->Branch = $this->branch;
                    $ProductfromBranch->save();
                }
            }
            $supplytransaction = SupplierTransactionsModel::where('PurchaseID', $this->purchaseid)->first();
            if ($supplytransaction) {
                $updatetransaction = SupplierTransactionsModel::find($supplytransaction->id);
                $updatetransaction->Amount = ($supplytransaction->Amount - $this->unitcost);
                $updatetransaction->Save();
            }
            session()->flash('returncreate', 'Return Made Successfully');
            return redirect()->route('Return-To-Supplier');
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
    public function updatedpurchaseid($value)
    {
        $purchasedetails = PurchaseModel::where('id', $value)->first();
        if ($purchasedetails) {
            $this->supplier = $purchasedetails->Supplier;
        }
    }
    public function updatedproductname($value)
    {
        $productdetails = ProductModel::where('id', $value)->first();
        if ($productdetails) {
            $this->origin = $productdetails->Origin;
            $this->weight = $productdetails->Weight;
            $this->unitcost = $productdetails->PurchaseCost;
            $this->defaultcost = $productdetails->PurchaseCost;
        }
        if (Auth::user()->utype == 'General Manager' || Auth::user()->utype == 'Administrator') {
            $this->purchaseids = PurchaseModel::all();
        } else {
            $this->purchaseids = PurchaseModel::where('Branch', Auth::user()->Branch)->get();
        }
    }
    public function updatedquantity()
    {
        if ($this->quantity != "") {
            $this->unitcost = $this->defaultcost * $this->quantity;
        } else {
            $this->unitcost = $this->defaultcost;
        }
    }
    public function mount()
    {
        if (Auth::user()->utype == 'General Manager' || Auth::user()->utype == 'Administrator') {
            $this->branches = BranchModel::all();
            $this->purchaseids = PurchaseModel::all();
        } else {
            $this->branches = BranchModel::where('id', Auth::user()->Branch)->get();
            $this->purchaseids = PurchaseModel::where('Branch', Auth::user()->Branch)->get();
        }
        $this->suppliers = SupplierAccountModel::all();
        $this->productnames = ProductModel::all();
    }
    public function render()
    {
        if (Auth::user()->utype == 'General Manager' || Auth::user()->utype == 'Administrator') {
            $registeredreturns = SupplierReturnsModel::orderBy('id', 'DESC')->get();
        } else {
            $registeredreturns = SupplierReturnsModel::Where('Branch', Auth::user()->Branch)->orderBy('id', 'DESC')->get();
        }
        return view('livewire.return-to-supplier-component', ['registeredreturns' => $registeredreturns])->layout('layouts.base');
    }
}
