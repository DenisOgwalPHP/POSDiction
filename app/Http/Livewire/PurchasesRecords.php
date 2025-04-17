<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\PurchaseModel;
use Livewire\Component;

class PurchasesRecords extends Component
{
    public $datefrom;
    public $dateto;
    public function updateddateto()
    {
        $this->validate([
            'datefrom' => 'required',
        ]);
        if ($this->dateto != null) {
            return redirect()->route('Purchases-Records', ['slug' => $this->datefrom, 'slug2' => $this->dateto]);
        }
    }
    public function mount(Request $request)
    {
        $this->datefrom = $request->slug;
        $this->dateto = $request->slug2;
    }
    public function render()
    {
        try {
            if ($this->dateto == null) {
                if (Auth::user()->utype == 'General Manager' || Auth::user()->utype == 'Administrator') {
                    $registeredpurchases = PurchaseModel::all();
                } else {
                    $registeredpurchases = PurchaseModel::Where('Branch', Auth::user()->Branch)->get();
                }
            } else {
                if (Auth::user()->utype == 'General Manager' || Auth::user()->utype == 'Administrator') {
                    $registeredpurchases = PurchaseModel::whereDate('PurchaseDate', '>=', $this->datefrom)->WhereDate('PurchaseDate', '<=', $this->dateto)->get();
                } else {
                    $registeredpurchases = PurchaseModel::whereDate('PurchaseDate', '>=', $this->datefrom)->WhereDate('PurchaseDate', '<=', $this->dateto)->Where('Branch', Auth::user()->Branch)->get();
                }
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
        return view('livewire.purchases-records', ['registeredpurchases' => $registeredpurchases])->layout('layouts.base');
    }
}
