<?php

namespace App\Http\Livewire;
use App\Models\ClearClientAccountModel;
use App\Models\ClientAccountModel;
use App\Models\PaymentMethodModel;
use App\Models\SalesFinalModel;
use App\Models\SalesModel;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ClearClientAccounts extends Component
{
    public $clientids;
    public $clientid;
    public $transactionid;
    public $transactionids;
    public $transactionamount;
    public $transactiontype;
    public $pendingpayments;
    public $accountbalance;
    public $description;
    public $sellpaymentmethod;
    public $sellpaymentmethods;
    public $sellpaymentmethodselected;
    public $accoulbal;
    public function ClearClient()
    {
        $this->validate([
            'transactiontype' => 'required',
            'clientid' => 'required',
            'transactionamount' => 'required',
            'pendingpayments' => 'required',
            'accountbalance' => 'required',
            'sellpaymentmethod' => 'required',
            'description' => 'required',
        ]);
        try {
            $transactionclearance = new ClearClientAccountModel();
            $transactionclearance->ClientAccount = $this->clientid;
            $transactionclearance->TransationType = $this->transactiontype;
            if ($this->transactiontype == "Deposit" || $this->transactiontype == "Clear All") {
                $transactionclearance->ClearedTransaction  = 0;
            } else {
                $transactionclearance->ClearedTransaction  = $this->transactionid;
            }
            $transactionclearance->Amount   = $this->transactionamount;
            $transactionclearance->AccountBalance  = $this->accountbalance;
            $transactionclearance->Description  = $this->description;
            $transactionclearance->PaymentMethod  = $this->sellpaymentmethod;
            $transactionclearance->User_id = Auth::user()->id;
            $transactionclearance->Branch = Auth::user()->Branch;
            $transactionclearance->save();

            if ($this->transactiontype == "Clear Transaction") {
                $salestransaction = SalesModel::where('Payment_id', $this->transactionid)->get();
                foreach ($salestransaction as $salestrans) {
                    $updatetransaction = SalesModel::find($salestrans->id);
                    $updatetransaction->Cleared = 'Cleared';
                    $updatetransaction->Save();
                }
            } else if ($this->transactiontype == "Deposit" || $this->transactiontype == "Clear All") {
                $salestransaction = SalesModel::where('Account_id', $this->clientid)->get();
                foreach ($salestransaction as $salestrans) {
                    $updatetransaction = SalesModel::find($salestrans->id);
                    $updatetransaction->Cleared = 'Cleared';
                    $updatetransaction->Save();
                }
            }
            if ($this->transactiontype == "Deposit") {
                $accountbal = PaymentMethodModel::find($this->sellpaymentmethod);
                $accountbal->Balance = $accountbal->Balance + $this->transactionamount;
                $accountbal->save();
            }
            session()->flash('clearclient', 'Client Account Transaction Successfully');
            return redirect()->route('Clear-Client-Accounts');
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
    public function updatedclientid($value)
    {
        if ($this->transactiontype == "Deposit" || $this->transactiontype == "Clear All") {
            $this->transactionids = collect();
        } else {
            $this->transactionids = SalesModel::where('Account_id', $value)->where('Cleared', 'Not Cleared')->distinct()->pluck('Payment_id');
        }
        $this->pendingpayments = SalesModel::where('Account_id', $value)->where('Cleared', 'Not Cleared')->sum('Price');
        $account = ClearClientAccountModel::where('ClientAccount', $value)->orderByDesc('id')->first();
        $accountba = $account ? $account->AccountBalance : 0;
        $this->accountbalance = $accountba - $this->pendingpayments;
        $this->accoulbal = $accountba;
    }

    public function updatedtransactionid($value)
    {
        if ($this->transactiontype == "Clear Transaction") {
            $transactionamountss = SalesFinalModel::find($value);;
            if ($transactionamountss) {
                $this->transactionamount = $transactionamountss->DiscountedTotal;
                $this->pendingpayments = $transactionamountss->DiscountedTotal;
                $this->accountbalance = $this->accoulbal - $this->pendingpayments;
            }
        }
    }

    public function updatedtransactionamount()
    {
        if ($this->transactiontype == "Deposit" && $this->transactionamount != '') {
            $this->accountbalance = ($this->accoulbal + $this->transactionamount) - $this->pendingpayments;
        }
    }
    public function mount()
    {
        $this->transactionids = collect();
        if (Auth::user()->utype == 'General Manager' || Auth::user()->utype == 'Administrator') {
            $this->clientids = ClientAccountModel::orderBy('id', 'ASC')->get();
        } else {
            $this->clientids = ClientAccountModel::Where('Branch', Auth::user()->Branch)->orderBy('id', 'DESC')->get();
        }
        $this->sellpaymentmethods = PaymentMethodModel::whereNot('PaymentMethod', 'Client Account')->where('Branch', Auth::user()->Branch)->orderBy('id', 'ASC')->get();
    }
    public function render()
    {
        if (Auth::user()->utype == 'General Manager' || Auth::user()->utype == 'Administrator') {
            $registeredclearance = ClearClientAccountModel::orderBy('id', 'DESC')->get();
        } else {
            $registeredclearance = ClearClientAccountModel::Where('Branch', Auth::user()->Branch)->orderBy('id', 'DESC')->get();
        }
        return view('livewire.clear-client-accounts', ['registeredclearance' => $registeredclearance])->layout('layouts.base');
    }
}
