<?php

namespace App\Http\Livewire;

use App\Models\BranchBalanceModel;
use App\Models\SupplierTransactionsModel;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\BranchModel;
use App\Models\PricePercentageModel;
use App\Models\ProductModel;
use App\Models\PurchaseModel;
use App\Models\StoreBalanceModel;
use App\Models\SupplierAccountModel;
use App\Models\UnitsModel;

class PurchasesComponent extends Component
{
    public $branch;
    public $branches;
    public $productnames;
    public $productname;
    public $manufacturer;
    public $supplier;
    public $suppliers;
    public $units;
    public $purchasedate;
    public $manufacturedate;
    public $expirydate;
    public $quantity;
    public $unitcost;
    public $invoiceno;
    public $origin;
    public $weight;
    public $barcode;
    public $sellingprice;
    public $defaultcost;
    public $pricepercentage;
    public function updatedbarcode()
    {
        if ($this->barcode == "n/a" || $this->barcode == "N/a" || $this->barcode == "N/A") {
        } else {
            $productdetails = ProductModel::where('Barcode', $this->barcode)->first();
            if ($productdetails) {
                $this->manufacturer = $productdetails->Manufacturer;
                $this->origin = $productdetails->Origin;
                $this->weight = $productdetails->Weight;
                $this->unitcost = $productdetails->PurchaseCost;
                $this->defaultcost = $productdetails->PurchaseCost;
                $this->sellingprice = $productdetails->SellingPrice;
                $this->productname = $productdetails->id;
            }
        }
    }
    public function CreatePurchase()
    {
        $this->validate([
            'branch' => 'required',
            'productname' => 'required',
            'manufacturer' => 'required',
            'supplier' => 'required',
            'purchasedate' => 'required',
            'manufacturedate' => 'required',
            'expirydate' => 'required',
            'quantity' => 'required',
            'unitcost' => 'required',
            'invoiceno' => 'required',
            'origin' => 'required',
            'weight' => 'required',
            'sellingprice' => 'required',
        ]);
        try {
            $product = new PurchaseModel();
            $product->ProductName = $this->productname;
            $product->Supplier = $this->supplier;
            $product->PurchaseDate  = $this->purchasedate;
            $product->ManufactureDate  = $this->manufacturedate;
            $product->ExpiryDate  = $this->expirydate;
            $product->Quantity  = $this->quantity;
            $product->Units  = "Piece";
            $product->UnitCost = $this->unitcost / $this->quantity;
            $product->TotalCost  = $this->unitcost;
            $product->InvoiceNo = $this->invoiceno;
            $product->QuantityLeft  = $this->quantity;
            $product->User_id  = Auth::user()->id;
            $product->Branch = $this->branch;
            $product->save();
            $savedproductid = $product->id;
            if ($this->branch == "100") {
                $productinstore = StoreBalanceModel::where('ProductRefer', $this->productname)->first();
                if ($productinstore) {
                    $ProductToStore = StoreBalanceModel::find($productinstore->id);
                    $ProductToStore->ProductRefer = $this->productname;
                    $ProductToStore->BalanceDate = $this->purchasedate;
                    $ProductToStore->Origin = $this->origin;
                    $ProductToStore->Weight  = $this->weight;
                    $ProductToStore->ItemBalance  = ($productinstore->ItemBalance + $this->quantity);
                    $ProductToStore->Units  ="Piece";
                    $ProductToStore->ProductValue  = $this->sellingprice;
                    $ProductToStore->StockRate  = $this->unitcost / $this->quantity;
                    $ProductToStore->User_id = Auth::user()->id;
                    $ProductToStore->save();
                }
            } else {
                $productinbranch = BranchBalanceModel::where('ProductRefer', $this->productname)->where('Branch', $this->branch)->first();
                if ($productinbranch) {
                    $ProductToBranch = BranchBalanceModel::find($productinbranch->id);
                    $ProductToBranch->ProductRefer = $this->productname;
                    $ProductToBranch->BalanceDate = $this->purchasedate;
                    $ProductToBranch->Origin = $this->origin;
                    $ProductToBranch->Weight  = $this->weight;
                    $ProductToBranch->ItemBalance  = ($productinbranch->ItemBalance + $this->quantity);
                    $ProductToBranch->Units  = "Piece";
                    $ProductToBranch->ProductValue  = $this->sellingprice;
                    $ProductToBranch->StockRate  = $this->unitcost / $this->quantity;
                    $ProductToBranch->User_id = Auth::user()->id;
                    $ProductToBranch->Branch = $this->branch;
                    $ProductToBranch->save();
                }
            }
            $suppliertransaction = new SupplierTransactionsModel();
            $suppliertransaction->AccountID  = $this->supplier;
            $suppliertransaction->ProductID  = $this->productname;
            $suppliertransaction->PurchaseID  = $savedproductid;
            $suppliertransaction->Amount  = $this->unitcost;
            $suppliertransaction->User_id = Auth::user()->id;
            $suppliertransaction->Branch = $this->branch;
            $suppliertransaction->save();

            session()->flash('purchasecreate', 'Product has been Added Successfully');
            return redirect()->route('Add-Purchases');
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
            $this->barcode = $productdetails->Barcode;
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
    public function updatedunitcost()
    {
        try {
            if (!empty($this->unitcost)) {
                $this->sellingprice = ($this->unitcost / $this->quantity) + (($this->pricepercentage / 100) * ($this->unitcost / $this->quantity));
            }
        } catch (\Exception $e) {
            dd($this->pricepercentage);
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
    public function mount()
    {
        $this->pricepercentage = PricePercentageModel::orderByDesc('id')->value('Percentage');
        if (Auth::user()->utype == 'General Manager' || Auth::user()->utype == 'Administrator') {
            $this->branches = BranchModel::all();
        } else {
            $this->branches = BranchModel::where('id', Auth::user()->Branch)->get();
        }
        $this->suppliers = SupplierAccountModel::all();
       
        $this->productnames = ProductModel::all();
    }
    public function render()
    {
        if (Auth::user()->utype == 'General Manager' || Auth::user()->utype == 'Administrator') {
            $registeredpurchases = PurchaseModel::orderBy('id', 'DESC')->get();
        } else {
            $registeredpurchases = PurchaseModel::where('Branch', Auth::user()->Branch)->orderBy('id', 'DESC')->get();
        }
        return view('livewire.purchases-component', ['registeredpurchases' => $registeredpurchases])->layout('layouts.base');
    }
}
