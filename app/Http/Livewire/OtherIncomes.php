<?php

namespace App\Http\Livewire;

use App\Models\PaymentMethodModel;
use Illuminate\Support\Facades\Auth;
use App\Models\BranchModel;
use App\Models\OtherIncomesModel;
use Illuminate\Http\Request;
use Livewire\Component;

class OtherIncomes extends Component
{
    public $paidfor;
    public $IncomePaid;
    public $PaymentMethod;
    public $branch;
    public $description;
    public $branches;
    public $sellpaymentmethods;
    public $slug;
    public function AddOtherIncome()
    {
        // Validation rules for the input data
        $this->validate([
            'paidfor' => 'required',
            'IncomePaid' => 'required',
            'PaymentMethod' => 'required',
            'branch' => 'required|numeric',
            'description' => 'required',
        ]);

        try {
            $registerotherincomes = OtherIncomesModel::findOrNew($this->slug);
            $registerotherincomes->PaidFor = $this->paidfor;
            $registerotherincomes->IncomePaid = $this->IncomePaid;
            $registerotherincomes->PaymentMethod = $this->PaymentMethod;
            $registerotherincomes->User_id  = Auth::user()->id;
            $registerotherincomes->Branch = $this->branch;
            $registerotherincomes->Description = $this->description;
            $registerotherincomes->save();
            $accountbal = PaymentMethodModel::find($this->PaymentMethod);
            $accountbal->Balance = $accountbal->Balance + $this->IncomePaid;
            $accountbal->save();
            session()->flash('incomeregister', 'Other Income Payment saved successfully');
            return redirect()->route('Other-Incomes');
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function mount(Request $request)
    {
        try {
            $this->sellpaymentmethods = PaymentMethodModel::where('Branch', Auth::user()->Branch)->orderBy('id', 'ASC')->get();
            if (Auth::user()->utype == 'General Manager' || Auth::user()->utype == 'Administrator') {
                $this->branches = BranchModel::all();
            } else {
                $this->branches = BranchModel::Where('id', Auth::user()->Branch)->orderBy('id', 'DESC')->get();
            }
            $this->slug = $request->query('slug');
            $incomeslist = OtherIncomesModel::find($this->slug);
            if ($incomeslist) {
                $this->paidfor = $incomeslist->PaidFor;
                $this->IncomePaid = $incomeslist->IncomePaid;
                $this->PaymentMethod = $incomeslist->PaymentMethod;
                $this->description = $incomeslist->Description;
                $this->branch = $incomeslist->Branch;
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
    public function deleteIncome($id)
    {
        try {
            $otherincomeinfo = OtherIncomesModel::find($id);
            $accountbal = PaymentMethodModel::find($otherincomeinfo->PaymentMethod);
            $accountbal->Balance = $accountbal->Balance - $otherincomeinfo->IncomePaid;
            $accountbal->save();
            $otherincomeinfo->delete();
            session()->flash('incomedelete', 'Other Income has been deleted successfully');
            return redirect()->route('Other-Incomes');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
    public function render()
    {
        try {
            if (Auth::user()->utype == 'General Manager' || Auth::user()->utype == 'Administrator') {
                $registeredotherincomes = OtherIncomesModel::All();
            } else {
                $registeredotherincomes = OtherIncomesModel::Where('Branch', Auth::user()->Branch)->orderBy('id', 'DESC')->get();
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
        return view('livewire.other-incomes', ['registeredotherincomes' => $registeredotherincomes])->layout('layouts.base');
    }
}
