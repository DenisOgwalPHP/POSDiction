<?php

namespace App\Http\Livewire;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\DevidendsModel;
use App\Models\PaymentMethodModel;
use App\Models\User;
use Livewire\Component;

class DevidendsComponent extends Component
{
    public $paymentmethods;
    public $slug;
    public $accountto;
    public $paymentmethod;
    public $paymentaccounts;
    public $amountwithdrawn;
    public $description;
    public function AddDevidends()
    {
        // Validation rules for the input data
        $this->validate([
            'amountwithdrawn' => 'required',
            'accountto' => 'required',
            'paymentmethod' => 'required',
            'description' => 'required',
        ]);

        try {
            $registerdevidends = DevidendsModel::findOrNew($this->slug);
            $registerdevidends->Amount = $this->amountwithdrawn;
            $registerdevidends->Withdrew_By  = $this->accountto;
            $registerdevidends->Reason  = $this->description;
            $registerdevidends->PaymentMethod  = $this->paymentmethod;
            $registerdevidends->User_id  = Auth::user()->id;
            $registerdevidends->Branch = Auth::user()->Branch;
            $registerdevidends->save();

            $accountbal = PaymentMethodModel::find($this->paymentmethod);
            $accountbal->Balance = $accountbal->Balance - $this->amountwithdrawn;
            $accountbal->save();
            session()->flash('devidendssave', 'Devidends saved successfully');
            return redirect()->route('Devidends');
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
    public function deleteDevidend($id)
    {
        try {
            $devidendinfo = DevidendsModel::find($id);
            $devidendinfo->delete();
            session()->flash('devidendsdelete', 'Devidends Have been deleted successfully');
            return redirect()->route('Devidends');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
    public function mount(Request $request)
    {
        try {
            $this->paymentmethods = PaymentMethodModel::where('Branch', Auth::user()->Branch)->orderBy('id', 'ASC')->get();
            $this->paymentaccounts = User::all();
            $this->slug = $request->query('slug');
            $devidendlist = DevidendsModel::find($this->slug);
            if ($devidendlist) {
                $this->amountwithdrawn = $devidendlist->Amount;
                $this->accountto = $devidendlist->Withdrew_By;
                $this->paymentmethod= $devidendlist->PaymentMethod;
                $this->description = $devidendlist->Reason;
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
    public function render()
    {
        try {
            if (Auth::user()->utype == 'General Manager' || Auth::user()->utype == 'Administrator') {
                $registereddevidends = DevidendsModel::All();
            } else {
                $registereddevidends = DevidendsModel::Where('Branch', Auth::user()->Branch)->orderBy('id', 'DESC')->get();
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
        return view('livewire.devidends-component', ['registereddevidends' =>  $registereddevidends])->layout('layouts.base');
    }
}
