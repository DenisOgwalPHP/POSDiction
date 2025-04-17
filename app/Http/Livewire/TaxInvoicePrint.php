<?php

namespace App\Http\Livewire;

use App\Models\SalesModel;
use Livewire\Component;

class TaxInvoicePrint extends Component
{
    public $slug;
    public $registeredsale;
    public function mount()
    {
        try {
            $this->slug = request()->query('salesid');
            
            $this->registeredsale = SalesModel::where('Payment_id',$this->slug)->get();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
    public function render()
    {
        return view('livewire.tax-invoice-print')->layout('layouts.bases');
    }
}
