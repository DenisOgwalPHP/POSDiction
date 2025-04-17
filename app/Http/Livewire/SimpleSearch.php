<?php
namespace App\Http\Livewire;
use Illuminate\Support\Facades\Auth;
use App\Models\BranchBalanceModel;
use App\Models\ProductModel;
use App\Models\PurchaseModel;
use App\Models\SalesModel;
use App\Models\StoreBalanceModel;
use App\Models\SupplierTransactionsModel;
use Livewire\Component;

class SimpleSearch extends Component
{
    public $search;
    public $studentnam;
    public $registeredproduct;
    public $registeredsales;
    public $registeredpurchases;
    public $registeredsupplies;
    public $registeredbranch;
    public $registeredstore;
    public $registeredmarks;
    public $registeredAttendance;
    public $registeredAttendances;
    public $slug;
    public function mount()
    {
        try {
            $this->search = request()->query('slug');
            if ($this->search != '') {
                if (Auth::user()->utype == 'General Manager' || Auth::user()->utype == 'Administrator') {
                $productid = ProductModel::where('ProductName', 'like', '%' . $this->search . '%')->orWhere('Weight', 'like', '%' . $this->search . '%')->orWhere('Origin', 'like', '%' . $this->search . '%')->first();
                if ($productid) {
                    $this->studentnam = $productid->id;
                    $this->registeredproduct = ProductModel::where('id', $this->studentnam)->orderby('id', 'DESC')->get();
                    $this->registeredsales = SalesModel::where('ProductRefer', $this->studentnam)->orderby('id', 'DESC')->get();
                    $this->registeredpurchases = PurchaseModel::where('ProductName', $this->studentnam)->orderby('id', 'DESC')->get();
                    $this->registeredsupplies = SupplierTransactionsModel::where('ProductID', $this->studentnam)->orderby('id', 'DESC')->get();
                    $this->registeredbranch = BranchBalanceModel::where('ProductRefer', $this->studentnam)->get();
                    $this->registeredstore = StoreBalanceModel::where('ProductRefer', $this->studentnam)->orderby('id', 'DESC')->get();
                   
                } else {
                    $this->studentnam = 0;
                }
            }else{
                $productid = ProductModel::where('ProductName', 'like', '%' . $this->search . '%')->orWhere('Weight', 'like', '%' . $this->search . '%')->orWhere('Origin', 'like', '%' . $this->search . '%')->first();
                if ($productid) {
                    $this->studentnam = $productid->id;
                    $this->registeredproduct = ProductModel::where('id', $this->studentnam)->orderby('id', 'DESC')->get();
                    $this->registeredsales = SalesModel::Where('Branch', Auth::user()->Branch)->where('ProductRefer', $this->studentnam)->orderby('id', 'DESC')->get();
                    $this->registeredpurchases = PurchaseModel::Where('Branch', Auth::user()->Branch)->where('ProductName', $this->studentnam)->orderby('id', 'DESC')->get();
                    $this->registeredsupplies = SupplierTransactionsModel::Where('Branch', Auth::user()->Branch)->where('ProductID', $this->studentnam)->orderby('id', 'DESC')->get();
                    $this->registeredbranch = BranchBalanceModel::Where('Branch', Auth::user()->Branch)->where('ProductRefer', $this->studentnam)->get();
                    $this->registeredstore = collect();
                   
                } else {
                    $this->studentnam = 0;
                }

            }
            } else {

            }
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
    public function MakeSearch()
    {
        try {
            session()->flash('searchcase', 'Product Information Displayed successfully');
            return redirect()->route('Simple-Search', ['slug' => $this->search]);
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
    public function render()
    {
        return view('livewire.simple-search')->layout('layouts.base');
    }
}
