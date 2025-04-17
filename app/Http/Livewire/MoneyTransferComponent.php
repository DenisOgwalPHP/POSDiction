<?php

namespace App\Http\Livewire;

use App\Models\MoneyTransferModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\PaymentMethodModel;
use Livewire\Component;

class MoneyTransferComponent extends Component
{
    public $paymentmethods;
    public $slug;
    public $accountto;
    public $accountfrom;
    public $amounttransfered;
    public function CreateTransfer()
    {
        // Validation rules for the input data
        $this->validate([
            'accountto' => 'required',
            'accountfrom' => 'required',
            'amounttransfered' => 'required',
        ]);

        try {
            $registertransfer = MoneyTransferModel::findOrNew($this->slug);
            $registertransfer->AmountTransfered = $this->amounttransfered;
            $registertransfer->TransferedFrom  = $this->accountfrom;
            $registertransfer->TransferedTo  = $this->accountto;
            $registertransfer->User_id  = Auth::user()->id;
            $registertransfer->Branch = Auth::user()->Branch;
            $registertransfer->save();

            $accountbal = PaymentMethodModel::find($this->accountfrom);
            $accountbal->Balance = $accountbal->Balance - $this->amounttransfered;
            $accountbal->save();

            $accountbal1 = PaymentMethodModel::find($this->accountto);
            $accountbal1->Balance = $accountbal1->Balance + $this->amounttransfered;
            $accountbal1->save();
            session()->flash('moneytransfersave', 'Money Transfer saved successfully');
            return redirect()->route('Money-Transfer');
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
    public function deleteTransfer($id)
    {
        try {
            $transferinfo = MoneyTransferModel::find($id);
            $accountbal = PaymentMethodModel::find($transferinfo->TransferedFrom);
            $accountbal->Balance = $accountbal->Balance - $transferinfo->AmountTransfered;
            $accountbal->save();
            $accountbal1 = PaymentMethodModel::find($transferinfo->TransferedTo);
            $accountbal1->Balance = $accountbal1->Balance + $transferinfo->AmountTransfered;
            $accountbal1->save();
            $transferinfo->delete();
            session()->flash('moneytransferdelete', 'Money Transfer has been deleted successfully');
            return redirect()->route('Money-Transfer');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
    public function mount(Request $request)
    {
        try {
            $this->paymentmethods = PaymentMethodModel::where('Branch', Auth::user()->Branch)->orderBy('id', 'ASC')->get();
            $this->slug = $request->query('slug');
            $transferlist = MoneyTransferModel::find($this->slug);
            if ($transferlist) {
                $this->amounttransfered = $transferlist->AmountTransfered;
                $this->accountfrom = $transferlist->TransferedFrom;
                $this->accountto = $transferlist->TransferedTo;
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
    public function render()
    {
        try {
            if (Auth::user()->utype == 'General Manager' || Auth::user()->utype == 'Administrator') {
                $registeredtransfer = MoneyTransferModel::All();
            } else {
                $registeredtransfer = MoneyTransferModel::Where('Branch', Auth::user()->Branch)->orderBy('id', 'DESC')->get();
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
        return view('livewire.money-transfer-component', ['registeredtransfer' => $registeredtransfer])->layout('layouts.base');
    }
}
