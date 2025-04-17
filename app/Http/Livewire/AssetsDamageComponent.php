<?php

namespace App\Http\Livewire;

use App\Models\AssetNameModel;
use Illuminate\Http\Request;
use App\Models\AssetsBalanceModel;
use App\Models\AssetsDamageModel;
use App\Models\AssetsRegisterModel;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AssetsDamageComponent extends Component
{
    public $products;
    public $staffs;
    public $units;
    public $purchaseyear;
    public $ProductName;
    public $Quantity;
    public $PurchaseUnit;
    public $UnitCost;
    public $slug;
    public $Description;
    public function AddAssetUsed()
    {
        $this->validate([
            'UnitCost' => 'required',
            'Description' => 'required',
            'PurchaseUnit' => 'required',
            'Quantity' => 'required',
            'ProductName' => 'required',
            'purchaseyear' => 'required',
        ]);
        try {
            $registerAssetDamage = AssetsDamageModel::findOrNew($this->slug);
            $registerAssetDamage->Year = $this->purchaseyear;
            $registerAssetDamage->ProductName = $this->ProductName;
            $registerAssetDamage->Quantity = $this->Quantity;
            $registerAssetDamage->Units = $this->PurchaseUnit;
            $registerAssetDamage->UnitCost = $this->UnitCost;
            $registerAssetDamage->RemovedBy = Auth::user()->id;
            $registerAssetDamage->Branch = Auth::user()->Branch;
            $registerAssetDamage->Reason = $this->Description;
            $registerAssetDamage->save();

            $selectedasset = AssetsBalanceModel::where('ProductName', $this->ProductName)->Where('Branch', Auth::user()->Branch)->first();
            if ($selectedasset) {
                $AssetBalance = AssetsBalanceModel::find($selectedasset->id);
                $balan = $selectedasset->Balance - $this->Quantity;
                $AssetBalance->Balance = $balan;
                $AssetBalance->UnitCost = $this->UnitCost;
                $AssetBalance->save();
            }
            session()->flash('assetdamage', 'Asset Damage removalsaved successfully');
            return redirect()->route('Damaged-Assets-Register');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
    public function deleteAssetDamage($id)
    {
        try {
            $assetdamage = AssetsDamageModel::where('id', $id)->first();
            $usagequantity = $assetdamage->Quantity;
            $usageproductname = $assetdamage->ProductName;
            $assetbal = AssetsBalanceModel::where('ProductName', $usageproductname)->first();
            if ($assetbal) {
                $ItemBalance = AssetsBalanceModel::find($assetbal->id);
                $balan = $assetbal->Balance + $usagequantity;
                $ItemBalance->Balance = $balan;
                $ItemBalance->save();
            }

            session()->flash('assetdamagedelete', 'Damaged Asset has been deleted successfully');
            return redirect()->route('Damaged-Assets-Register');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
    public function mount(Request $request)
    {
        try {
            $this->products = AssetsRegisterModel::distinct()->pluck('ProductName');
            $this->units = collect();
            $this->slug = $request->query('slug');
            $assetlist = AssetsDamageModel::find($this->slug);
            if ($assetlist) {
                $this->purchaseyear = $assetlist->Year;
                $this->ProductName = $assetlist->ProductName;
                $this->Quantity = $assetlist->Quantity;
                $this->PurchaseUnit = $assetlist->Units;
                $this->UnitCost = $assetlist->UnitCost;
                $this->Description = $assetlist->Reason;
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
    public function updatedProductName()
    {
        $this->units = AssetNameModel::where('ProductName', $this->ProductName)->get();
        $selectprice = AssetsRegisterModel::where('ProductName', $this->ProductName)->orderBy('id', 'DESC')->first();
        $this->UnitCost = $selectprice->UnitCost;
    }
    public function render()
    {
        try {
            if (Auth::user()->utype == 'General Manager' || Auth::user()->utype == 'Administrator') {
                $registeredItems = AssetsDamageModel::orderby('id', 'Desc')->get();
            } else {
                $registeredItems = AssetsDamageModel::Where('Branch', Auth::user()->Branch)->orderby('id', 'Desc')->get();
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
        return view('livewire.assets-damage-component', ['registeredItems' => $registeredItems])->layout('layouts.base');
    }
}
