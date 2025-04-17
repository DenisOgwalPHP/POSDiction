<?php

namespace App\Http\Livewire;

use App\Models\BranchBalanceModel;
use App\Models\BranchModel;
use App\Models\DistributionModel;
use App\Models\ProductModel;
use App\Models\UnitsModel;
use App\Models\StoreBalanceModel;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class DistributeComponent extends Component
{
    public $branch;
    public $branchto;
    public $branchfrom;
    public $branches;
    public $productnames;
    public $productname;

    public $manufacturer;
    public $quantity;
    public $unitname;
    public $unitcost;
    public $origin;
    public $weight;
    public $sellingprice;
    public $defaultcost;
    public $distributiondate;

    public function CreateDistribution()
    {
        $this->validate([
            'branchto' => 'required',
            'branchfrom' => 'required',
            'productname' => 'required',
            'manufacturer' => 'required',
            'distributiondate' => 'required',
            'quantity' => 'required',
            'unitcost' => 'required',
            'origin' => 'required',
            'weight' => 'required',
            'sellingprice' => 'required',
        ]);
        try {
            if ($this->branchfrom == "100") {
                $productinstore = StoreBalanceModel::where('ProductRefer', $this->productname)->first();
                if ($productinstore) {
                    $productbalance = $productinstore->ItemBalance - $this->quantity;
                    if ($productbalance < 0) {
                        session()->flash('distributefailuremessage', 'Store Can Not Distribute More Than what they Have');
                        return;
                    }
                }
            } else {
                $productinbranch = BranchBalanceModel::where('ProductRefer', $this->productname)->where('Branch', $this->branchfrom)->first();
                if ($productinbranch) {
                    $productbalance = $productinbranch->ItemBalance - $this->quantity;
                    if ($productbalance < 0) {
                        session()->flash('distributefailuremessage', 'Branch Can Not Distribute More Than what they Have');
                        return;
                    }
                }
            }
            $productdistributed = new DistributionModel();
            $productdistributed->ProductRefer = $this->productname;
            $productdistributed->DistributionDate = $this->distributiondate;
            $productdistributed->Quantity  = $this->quantity;
            $productdistributed->Units   ="Piece";
            $productdistributed->Flow  = 'Distribute';
            $productdistributed->Reason  = 'Branch Stock Refill';
            $productdistributed->ProductValue  = $this->sellingprice;
            $productdistributed->StockRate = $this->unitcost / $this->quantity;
            $productdistributed->User_id  = Auth::user()->id;
            $productdistributed->BranchFrom = $this->branchfrom;
            $productdistributed->Branch = $this->branchto;
            $productdistributed->save();

            if ($this->branchfrom == "100") {
                $productinstore = StoreBalanceModel::where('ProductRefer', $this->productname)->first();
                if ($productinstore) {
                    $ProductfromStore = StoreBalanceModel::find($productinstore->id);
                    $ProductfromStore->ProductRefer = $this->productname;
                    $ProductfromStore->BalanceDate = $this->distributiondate;
                    $ProductfromStore->Origin = $this->origin;
                    $ProductfromStore->Weight  = $this->weight;
                    $ProductfromStore->ItemBalance  = ($productinstore->ItemBalance - $this->quantity);
                    $ProductfromStore->Units  = "Piece";
                    $ProductfromStore->ProductValue  = $this->sellingprice;
                    $ProductfromStore->StockRate  = $this->unitcost / $this->quantity;
                    $ProductfromStore->User_id = Auth::user()->id;
                    $ProductfromStore->save();
                }
            } else {
                $productinbranch = BranchBalanceModel::where('ProductRefer', $this->productname)->where('Branch', $this->branchfrom)->first();
                if ($productinbranch) {
                    $ProductfromBranch = BranchBalanceModel::find($productinbranch->id);
                    $ProductfromBranch->ProductRefer = $this->productname;
                    $ProductfromBranch->BalanceDate = $this->distributiondate;
                    $ProductfromBranch->Origin = $this->origin;
                    $ProductfromBranch->Weight  = $this->weight;
                    $ProductfromBranch->ItemBalance  = ($productinbranch->ItemBalance - $this->quantity);
                    $ProductfromBranch->Units  = "Piece";
                    $ProductfromBranch->ProductValue  = $this->sellingprice;
                    $ProductfromBranch->StockRate  = $this->unitcost / $this->quantity;
                    $ProductfromBranch->User_id = Auth::user()->id;
                    $ProductfromBranch->Branch = $this->branchfrom;
                    $ProductfromBranch->save();
                }
            }

            if ($this->branchto == "100") {
                $productinstore = StoreBalanceModel::where('ProductRefer', $this->productname)->first();
                if ($productinstore) {
                    $ProductfromStore = StoreBalanceModel::find($productinstore->id);
                    $ProductfromStore->ProductRefer = $this->productname;
                    $ProductfromStore->BalanceDate = $this->distributiondate;
                    $ProductfromStore->Origin = $this->origin;
                    $ProductfromStore->Weight  = $this->weight;
                    $ProductfromStore->ItemBalance  = ($productinstore->ItemBalance + $this->quantity);
                    $ProductfromStore->Units  = "Piece";
                    $ProductfromStore->ProductValue  = $this->sellingprice;
                    $ProductfromStore->StockRate  = $this->unitcost / $this->quantity;
                    $ProductfromStore->User_id = Auth::user()->id;
                    $ProductfromStore->save();
                }
            } else {
                $productinbranch = BranchBalanceModel::where('ProductRefer', $this->productname)->where('Branch', $this->branchto)->first();
                if ($productinbranch) {
                    $ProductfromBranch = BranchBalanceModel::find($productinbranch->id);
                    $ProductfromBranch->ProductRefer = $this->productname;
                    $ProductfromBranch->BalanceDate = $this->distributiondate;
                    $ProductfromBranch->Origin = $this->origin;
                    $ProductfromBranch->Weight  = $this->weight;
                    $ProductfromBranch->ItemBalance  = ($productinbranch->ItemBalance + $this->quantity);
                    $ProductfromBranch->Units  = "Piece";
                    $ProductfromBranch->ProductValue  = $this->sellingprice;
                    $ProductfromBranch->StockRate  = $this->unitcost / $this->quantity;
                    $ProductfromBranch->User_id = Auth::user()->id;
                    $ProductfromBranch->Branch = $this->branchto;
                    $ProductfromBranch->save();
                }
            }

            session()->flash('distributioncreate', 'Distribution Made Successfully');
            return redirect()->route('Distribute');
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
    public function updatedproductname($value)
    {
        $productdetails = ProductModel::where('id', $value)->first();
        if ($productdetails) {
            $this->manufacturer = $productdetails->Manufacturer;
            $this->origin = $productdetails->Origin;
            $this->weight = $productdetails->Weight;
            $this->unitcost = $productdetails->PurchaseCost;
            $this->defaultcost = $productdetails->PurchaseCost;
            $this->sellingprice = $productdetails->SellingPrice;
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
        } else {
            $this->branches = BranchModel::where('id', Auth::user()->Branch)->get();
        }
        $this->productnames = ProductModel::all();
    }
    public function render()
    {
        if (Auth::user()->utype == 'General Manager' || Auth::user()->utype == 'Administrator') {
            $registereddistributions = DistributionModel::orderBy('id', 'DESC')->get();
        } else {
            $registereddistributions = DistributionModel::where('Branch', Auth::user()->Branch)->orWhere('BranchFrom', Auth::user()->Branch)->orderBy('id', 'DESC')->get();
        }
        return view('livewire.distribute-component', ['registereddistributions' => $registereddistributions])->layout('layouts.base');
    }
}
