<?php

namespace App\Http\Livewire;
use Illuminate\Http\Request;
use App\Models\SupplierAccountModel;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class SupplierAccountComponent extends Component
{
    public $AccountName;
    public $ContactNo;
    public $Location;
    public $Description;
    public $slug;
    public function AddSupplierAccount(){
        $this->validate([
            'AccountName' => 'required',
            'ContactNo' => 'required',
            'Location' => 'required',
            'Description' => 'required',
        ]);

        try {
            $registersupplieraccount = SupplierAccountModel::findOrNew($this->slug);
            $registersupplieraccount->AccountName = $this->AccountName;
            $registersupplieraccount->ContactNo = $this->ContactNo;
            $registersupplieraccount->Location = $this->Location;
            $registersupplieraccount->Description  = $this->Description;
            $registersupplieraccount->Branch = Auth::user()->Branch;
            $registersupplieraccount->save();
            session()->flash('supplieraccountregister', 'Supplier Account saved successfully');
            return redirect()->route('Supplier-Account');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
    public function deleteSupplierAccount($id)
    {
        try {
            $supplieraccountinfo = SupplierAccountModel::find($id);
            $supplieraccountinfo->delete();
            session()->flash('supplieraccountdelete', 'Supplier Account has been deleted successfully');
            return redirect()->route('Supplier-Account');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function mount(Request $request)
    {
        try {
            $this->slug = $request->query('slug');
            $supplieraccountlist = SupplierAccountModel::find($this->slug);
            if ($supplieraccountlist) {
                $this->AccountName = $supplieraccountlist->AccountName;
                $this->ContactNo = $supplieraccountlist->ContactNo;
                $this->Location = $supplieraccountlist->Location;
                $this->Description = $supplieraccountlist->Description;
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
    public function render()
    {
        try {
            $registeredSupplier = SupplierAccountModel::all();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
        return view('livewire.supplier-account-component', ['registeredSupplier' => $registeredSupplier])->layout('layouts.base');
    }
}
