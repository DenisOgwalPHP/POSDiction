<?php

namespace App\Http\Livewire;
use Cart;
use Illuminate\Support\Facades\Auth;
use App\Models\BranchBalanceModel;
use App\Models\ProformaInvoiceModel;
use Livewire\Component;

class ProformaInvoice extends Component
{
    public $clientcompany;
    public $clientname;
    public $telephoneno;
    public $location;
    public $clientemail;
    protected $listeners = ['refreshComponent' => '$refresh'];
    public function destroyitem($rowId)
    {
        try {
            Cart::instance('pcart')->remove($rowId);
            $this->emitTo('Proforma-Invoice', 'refreshComponent');
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function destroyitems()
    {
        try {
            Cart::instance('pcart')->destroy();
            $this->emitTo('Proforma-Invoice', 'refreshComponent');
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
    public function handleButtonClicks($product_id, $product_name, $product_price, $product_cost, $stock_id, $stock_weight, $stock_origin)
    {
        try {
            Cart::instance('pcart')->add([
                'id' => $product_id,
                'name' => $product_name,
                'qty' => 1,
                'price' => $product_price,
                'options' => [
                    'cost' => $product_cost,
                    'stockid' => $stock_id,
                    'weight' => $stock_weight,
                    'origin' => $stock_origin,
                ]
            ])->associate('App\Models\BranchBalanceModel');
            $this->emitTo('Proforma-Invoice', 'refreshComponent');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
    public function AddProforma()
    {
        $this->validate([
            'clientcompany' => 'required',
            'clientname' => 'required',
            'telephoneno' => 'required',
            'location' => 'required',
            'clientemail' => 'required',
        ]);
        try {
            if (Cart::instance('pcart')->count() > 0) {
                $proformainvoice = new ProformaInvoiceModel();
                $proformainvoice->ClientCompany = $this->clientcompany;
                $proformainvoice->ClientName = $this->clientname;
                $proformainvoice->Telephone  = $this->telephoneno;
                $proformainvoice->Location  = $this->location;
                $proformainvoice->Email  = $this->clientemail;
                $proformainvoice->User_id  = Auth::user()->id;
                $proformainvoice->Branch = Auth::user()->Branch;
                $proformainvoice->save();
                $this->emit('invoiceGenerated', [
                    'invoiceId' => $proformainvoice->id
                ]);
            }
            session()->flash('proformageneration', 'Invoice generated Successfully');
            return redirect()->route('Proforma-Invoice');
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
    public function render()
    {
        try {
            $stocksforsale = BranchBalanceModel::where('Branch', Auth::user()->Branch)->get();
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
        return view('livewire.proforma-invoice', ['stocksforsale' => $stocksforsale])->layout('layouts.base');
    }
}
