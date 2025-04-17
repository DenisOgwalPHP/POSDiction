<?php

namespace App\Http\Livewire;

use App\Models\AssetNameModel;
use App\Models\AssetsBalanceModel;
use App\Models\AssetsRegisterModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\SupplierAccountModel;
use App\Models\SupplierTransactionsModel;
use Livewire\Component;

class AssetsRegisterComponent extends Component
{
    public $suppliers;
    public $products;
    public $units;
    public $purchaseyear;
    public $purchaseterm;
    public $ProductName;
    public $Quantity;
    public $PurchaseUnit;
    public $Description;
    public $UnitCost;
    public $Supplier;
    public $slug;
    public function AddAssetPurchased()
    {
        $this->validate([
            'Supplier' => 'required',
            'UnitCost' => 'required',
            'Description' => 'required',
            'PurchaseUnit' => 'required',
            'Quantity' => 'required',
            'ProductName' => 'required',
            'purchaseyear' => 'required',
        ]);
        try {
            $registeritem = AssetsRegisterModel::findOrNew($this->slug);
            $registeritem->Year = $this->purchaseyear;
            $registeritem->ProductName = $this->ProductName;
            $registeritem->Quantity = $this->Quantity;
            $registeritem->Units = $this->PurchaseUnit;
            $registeritem->Description = $this->Description;
            $registeritem->UnitCost = $this->UnitCost;
            $registeritem->Supplier = $this->Supplier;
            $registeritem->Branch = Auth::user()->Branch;
            $registeritem->save();
            $returnedregister=$registeritem->id;

            $selecteditem = AssetsBalanceModel::where('ProductName', $this->ProductName)->where('Branch', Auth::user()->Branch)->first();
            if ($selecteditem) {
                $ItemBalance = AssetsBalanceModel::find($selecteditem->id);
                $balan = $selecteditem->Balance + $this->Quantity;
                $ItemBalance->Balance = $balan;
                $ItemBalance->UnitCost = $this->UnitCost;
                $ItemBalance->save();
            } else {
                $ItemBalance = new AssetsBalanceModel();
                $ItemBalance->ProductName = $this->ProductName;
                $ItemBalance->Units = $this->PurchaseUnit;
                $ItemBalance->Balance = $this->Quantity;
                $ItemBalance->UnitCost = $this->UnitCost;
                $ItemBalance->Branch = Auth::user()->Branch;
                $ItemBalance->save();
            }
            $suppliertransaction = new SupplierTransactionsModel();
            $suppliertransaction->AccountID  = $this->Supplier;
            $suppliertransaction->ProductID  =$this->ProductName;
            $suppliertransaction->PurchaseID  = $returnedregister;
            $suppliertransaction->Amount  =  $this->UnitCost * $this->Quantity;
            $suppliertransaction->User_id = Auth::user()->id;
            $suppliertransaction->Branch =  Auth::user()->Branch;
            $suppliertransaction->save();
            session()->flash('assetpurchase', 'Asset Purchase saved successfully');
            return redirect()->route('Assets-Register');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
    public function deleteItemPurchase($id)
    {
        try {
            $itemusage = AssetsRegisterModel::where('id', $id)->first();
            $usagequantity = $itemusage->Quantity;
            $usageproductname = $itemusage->ProductName;
            $itembal = AssetsBalanceModel::where('ProductName', $usageproductname)->where('Branch', Auth::user()->Branch)->first();
            if ($itembal) {
                $ItemBalance = AssetsBalanceModel::find($itembal->id);
                $balan = $itembal->Balance - $usagequantity;
                $ItemBalance->Balance = $balan;
                $ItemBalance->save();
            }
            $purchaseinfo = AssetsRegisterModel::find($id);
            $purchaseinfo->delete();

            $supplierdelete=SupplierTransactionsModel::where('PurchaseID','$id')->first();
            $suppliertransaction=SupplierTransactionsModel::find($supplierdelete->id);
            $suppliertransaction->delete();
            session()->flash('purchaseassetdelete', 'Asset Purchase has been deleted successfully');
            return redirect()->route('Assets-Register');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
    public function mount(Request $request)
    {
        try {
            $this->suppliers = SupplierAccountModel::all();
            $this->products = AssetNameModel::where('ItemType', 'Asset')->get();
            $this->units = collect();
            $this->slug = $request->query('slug');
            $itemlist = AssetsRegisterModel::find($this->slug);
            if ($itemlist) {
                $this->purchaseyear = $itemlist->Year;
                $this->ProductName = $itemlist->ProductName;
                $this->Quantity = $itemlist->Quantity;
                $this->PurchaseUnit = $itemlist->Units;
                $this->Description = $itemlist->Description;
                $this->UnitCost = $itemlist->UnitCost;
                $this->Supplier = $itemlist->Supplier;
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
    public function updatedProductName()
    {
        $this->units = AssetNameModel::where('id', $this->ProductName)->get();
    }
    public function render()
    {
        try {
            if (Auth::user()->utype == 'General Manager' || Auth::user()->utype == 'Administrator') {
                $registeredItems = AssetsRegisterModel::with('hassupplier')->orderby('id', 'Desc')->get();
            } else {
                $registeredItems = AssetsRegisterModel::Where('Branch', Auth::user()->Branch)->with('hassupplier')->orderby('id', 'Desc')->get();
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
        return view('livewire.assets-register-component', ['registeredItems' => $registeredItems])->layout('layouts.base');
    }
}
