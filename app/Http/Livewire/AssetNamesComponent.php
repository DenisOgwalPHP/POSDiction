<?php

namespace App\Http\Livewire;

use App\Models\AssetNameModel;
use Illuminate\Http\Request;
use Livewire\Component;

class AssetNamesComponent extends Component
{
    public $ProductName;
    public $Units;
    public $ItemType;
    public $slug;
    public function AddProduct()
    {
        // Validation rules for the input data
        $this->validate([
            'ProductName' => 'required',
            'Units' => 'required',
            'ItemType' => 'required',
        ]);

        try {
            $registerproduct = AssetNameModel::findOrNew($this->slug);
            $registerproduct->ProductName = $this->ProductName;
            $registerproduct->Units = $this->Units;
            $registerproduct->ItemType = $this->ItemType;
            $registerproduct->save();
            session()->flash('productregister', 'Item saved successfully');
            return redirect()->route('Usable-Items-Component');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
    public function deleteProduct($id)
    {
        try {
            $productinfo = AssetNameModel::find($id);
            $productinfo->delete();
            session()->flash('productdelete', 'Item has been deleted successfully');
            return redirect()->route('Usable-Items-Component');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
  
    public function mount(Request $request)
    {
        try {
            $this->slug = $request->query('slug');
            $productlist =AssetNameModel::find($this->slug);
            if ($productlist) {
                $this->ProductName = $productlist->ProductName;
                $this->Units = $productlist->Units;
                $this->ItemType=$productlist->ItemType;
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function render()
    {
        try {
            $registeredproducts = AssetNameModel::All();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
        return view('livewire.asset-names-component', ['registeredproducts' => $registeredproducts])->layout('layouts.base');
    }
}
