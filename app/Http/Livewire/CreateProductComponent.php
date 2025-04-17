<?php

namespace App\Http\Livewire;

use Illuminate\Http\Request;
use App\Models\BranchBalanceModel;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\BranchModel;
use App\Models\PricePercentageModel;
use App\Models\ProductModel;
use App\Models\StoreBalanceModel;
use Carbon\Carbon;
use App\Models\UnitsModel;

class CreateProductComponent extends Component
{
    public $productname;
    public $manufacturer;

    public $unitname;
    public $unitcost;
    public $origin;
    public $weight;
    public $barcode;
    public $sellingprice;
    public $sellunitname;
    public $slug;
    public $pricepercentage;
    public function CreateProduct()
    {
        $this->validate([
            'productname' => 'required',
            'manufacturer' => 'required',
            'unitcost' => 'required',
            'origin' => 'required',
            'weight' => 'required',
            'barcode' => 'required',
            'sellingprice' => 'required',
        ]);
        try {
            $product = ProductModel::findOrNew($this->slug);
            $product->ProductName = $this->productname;
            $product->Manufacturer = $this->manufacturer;
            $product->Units  = "Piece";
            $product->SellingUnits  = "Piece";
            $product->PurchaseCost = $this->unitcost;
            $product->SellingPrice = $this->sellingprice;
            $product->Origin  = $this->origin;
            $product->Weight  = $this->weight;
            $product->Barcode  = $this->barcode;
            $product->User_id  = Auth::user()->id;
            $product->save();
            $currentId = $product->id;
            $currentDate = Carbon::now();
            $allbranches = BranchModel::all();
            $selectedproduct = StoreBalanceModel::where('ProductRefer', $currentId)->first();
            if ($selectedproduct) {
                $ProductToStore = StoreBalanceModel::find($selectedproduct->id);
                $ProductToStore->ProductRefer = $currentId;
                $ProductToStore->BalanceDate = $currentDate->toDateString();
                $ProductToStore->Origin = $this->origin;
                $ProductToStore->Weight  = $this->weight;
                $ProductToStore->ItemBalance  = 0;
                $ProductToStore->Units  =  "Piece";
                $ProductToStore->ProductValue  = $this->sellingprice;
                $ProductToStore->StockRate  = $this->unitcost;
                $ProductToStore->User_id = Auth::user()->id;
                $ProductToStore->save();

                foreach ($allbranches as $branch) {
                    $selectedproducts = BranchBalanceModel::where('ProductRefer', $currentId)->where('Branch', $branch->id)->first();
                    $ProductToBranch = BranchBalanceModel::find($selectedproducts->id);
                    $ProductToBranch->ProductRefer = $currentId;
                    $ProductToBranch->BalanceDate = $currentDate->toDateString();
                    $ProductToBranch->Origin = $this->origin;
                    $ProductToBranch->Weight  = $this->weight;
                    $ProductToBranch->ItemBalance  = 0;
                    $ProductToBranch->Units  =  "Piece";
                    $ProductToBranch->ProductValue  = $this->sellingprice;
                    $ProductToBranch->StockRate  = $this->unitcost;
                    $ProductToBranch->User_id = Auth::user()->id;
                    $ProductToBranch->Branch = $branch->id;
                    $ProductToBranch->save();
                }
            } else {
                $ProductToStore = new StoreBalanceModel();
                $ProductToStore->ProductRefer = $currentId;
                $ProductToStore->BalanceDate = $currentDate->toDateString();
                $ProductToStore->Origin = $this->origin;
                $ProductToStore->Weight  = $this->weight;
                $ProductToStore->ItemBalance  = 0;
                $ProductToStore->Units  = "Piece";
                $ProductToStore->ProductValue  = $this->sellingprice;
                $ProductToStore->StockRate  = $this->unitcost;
                $ProductToStore->User_id = Auth::user()->id;
                $ProductToStore->save();


                foreach ($allbranches as $branch) {
                    $ProductToBranch = new BranchBalanceModel();
                    $ProductToBranch->ProductRefer = $currentId;
                    $ProductToBranch->BalanceDate = $currentDate->toDateString();
                    $ProductToBranch->Origin = $this->origin;
                    $ProductToBranch->Weight  = $this->weight;
                    $ProductToBranch->ItemBalance  = 0;
                    $ProductToBranch->Units  =  "Piece";
                    $ProductToBranch->ProductValue  = $this->sellingprice;
                    $ProductToBranch->StockRate  = $this->unitcost;
                    $ProductToBranch->User_id = Auth::user()->id;
                    $ProductToBranch->Branch = $branch->id;
                    $ProductToBranch->save();
                }
            }
            session()->flash('productcreate', 'Product has been Added Successfully');
            return redirect()->route('Create-Product');
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
    public function updatedunitcost()
    {
        try {
            if (!empty($this->unitcost)) {
                $this->sellingprice =$this->unitcost+(($this->pricepercentage/100) * $this->unitcost);
            }
        } catch (\Exception $e) {
            dd($this->pricepercentage);
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
    public function mount(Request $request)
    {
        $this->slug = $request->query('slug');
        $this->pricepercentage = PricePercentageModel::orderByDesc('id')->value('Percentage');
        $productlist = ProductModel::find($this->slug);
        if ($productlist) {
            $this->productname = $productlist->ProductName;
            $this->manufacturer = $productlist->Manufacturer;
            $this->unitcost = $productlist->PurchaseCost;
            $this->sellingprice = $productlist->SellingPrice;
            $this->origin = $productlist->Origin;
            $this->weight = $productlist->Weight;
            $this->barcode = $productlist->Barcode;
        }
    }
    public function deleteProduct($id)
    {
        try {
            $productinfo = ProductModel::find($id);
            $productinfo->delete();
            session()->flash('productdelete', 'Product has been deleted successfully');
            return redirect()->route('Create-Product');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function render()
    {
        $registeredproducts = ProductModel::all();
        return view('livewire.create-product-component', ['registeredproducts' => $registeredproducts])->layout('layouts.base');
    }
}
