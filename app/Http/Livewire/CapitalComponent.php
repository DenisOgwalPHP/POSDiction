<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\CapitalModel;
use App\Models\PaymentMethodModel;
use Livewire\Component;

class CapitalComponent extends Component
{
    public $capital;
    public $paymentmethod;
    public $sellpaymentmethods;
    public $slug;

    public function Addcapital()
    {
        $this->validate([
            'capital' => 'required',
            'paymentmethod' => 'required',
        ]);

        try {
            $registercapital = CapitalModel::findOrNew($this->slug);
            $isNewTransaction = !$registercapital->exists;
            $registercapital->capital = $this->capital;
            $registercapital->User_id = Auth::user()->id;
            $registercapital->Branch = Auth::user()->Branch;
            $registercapital->PaymentMethod = $this->paymentmethod;
            $registercapital->save();
            if ($isNewTransaction) {
            $accountbal = PaymentMethodModel::find($this->paymentmethod);
            $accountbal->Balance = $accountbal->Balance + $this->capital;
            $accountbal->save();
            }
            session()->flash('capitalsave', 'Capital saved successfully');
            return redirect()->route('Capital');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
    public function deleteCapital($id)
    {
        try {
            $capitalinfo = CapitalModel::find($id);
            $accountbal = PaymentMethodModel::find($capitalinfo->PaymentMethod);
            $accountbal->Balance = $accountbal->Balance - $capitalinfo->Capital;
            $accountbal->save();
            $capitalinfo->delete();
            session()->flash('capitaldelete', 'Capital has been deleted successfully');
            return redirect()->route('Capital');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
    public function mount(Request $request)
    {
        try {
            $this->slug = $request->query('slug');
            $this->sellpaymentmethods = PaymentMethodModel::where('Branch', Auth::user()->Branch)->orderBy('id', 'ASC')->get();
            $capitallist = CapitalModel::find($this->slug);
            if ($capitallist) {
                $this->capital = $capitallist->Capital;
                $this->paymentmethod = $capitallist->PaymentMethod;
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function render()
    {
        try {
            if (Auth::user()->utype == 'General Manager' || Auth::user()->utype == 'Administrator') {
                $registeredcapital = CapitalModel::All();
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
        return view('livewire.capital-component', ['registeredcapital' => $registeredcapital])->layout('layouts.base');
    }
}
