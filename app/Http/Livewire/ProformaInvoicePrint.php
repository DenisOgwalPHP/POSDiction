<?php

namespace App\Http\Livewire;
use Cart;
use App\Models\MarksModel;
use App\Models\NextTermModel;
use App\Models\ProformaInvoiceModel;
use App\Models\StreamsModel;
use App\Models\StudentModel;
use App\Models\ThirdTermMarks;
use Livewire\Component;

class ProformaInvoicePrint extends Component
{
    public $slug;
    public $registeredproforma;
    public function mount()
    {
        try {
            $this->slug = request()->query('invoiceId');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
 

    public function render()
    {
        try {
            $this->registeredproforma = ProformaInvoiceModel::where('id', $this->slug)->first();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
        return view('livewire.proforma-invoice-print', ['registeredproforma' => $this->registeredproforma])->layout('layouts.bases');
    }
}
