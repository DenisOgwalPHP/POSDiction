<?php

namespace App\Http\Livewire;

use App\Models\ClearClientAccountModel;
use App\Models\ClientAccountModel;
use App\Models\PaymentMethodModel;
use App\Models\PurchaseModel;
use App\Models\SalesFinalModel;
use App\Models\SalesModel;
use App\Models\SupplierAccountBalanceModel;
use App\Models\SupplierAccountModel;
use App\Models\SupplierTransactionsModel;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ClearSuppliersAccounts extends Component
{
    public $clientids;
    public $supplierid;
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

    public function ClearSupplier()
    {
        $this->validate([
            'transactiontype' => 'required',
            'supplierid' => 'required',
            'transactionamount' => 'required',
            'pendingpayments' => 'required',
            'accountbalance' => 'required',
            'sellpaymentmethod' => 'required',
            'description' => 'required',
        ]);
        try {
            $transactionclearance = new SupplierAccountBalanceModel();
            $transactionclearance->AccountID = $this->supplierid;
            $transactionclearance->TransactionType = $this->transactiontype;
            $transactionclearance->Amount   = $this->transactionamount;
            $transactionclearance->AccountBalance  = $this->accountbalance;
            $transactionclearance->Description  = $this->description;
            $transactionclearance->PaymentMode  = $this->sellpaymentmethod;
            $transactionclearance->User_id = Auth::user()->id;
            $transactionclearance->Branch = Auth::user()->Branch;
            $transactionclearance->save();

            if ($this->transactiontype == "Clear Transaction") {
                $salestransaction = SupplierTransactionsModel::where('PurchaseID', $this->transactionid)->get();
                foreach ($salestransaction as $salestrans) {
                    $updatetransaction = SupplierTransactionsModel::find($salestrans->id);
                    $updatetransaction->Clearance = 'Cleared';
                    $updatetransaction->ClearanceID =  $transactionclearance->id;
                    $updatetransaction->Save();
                }
            } else if ($this->transactiontype == "Deposit" || $this->transactiontype == "Clear All") {
                $salestransaction = SupplierTransactionsModel::where('AccountID', $this->supplierid)->get();
                foreach ($salestransaction as $salestrans) {
                    $updatetransaction = SupplierTransactionsModel::find($salestrans->id);
                    $updatetransaction->Clearance = 'Cleared';
                    $updatetransaction->ClearanceID =  $transactionclearance->id;
                    $updatetransaction->Save();
                }
            }
            if ($this->transactiontype == "Deposit") {
                $accountbal = PaymentMethodModel::find($this->sellpaymentmethod);
                $accountbal->Balance = $accountbal->Balance - $this->transactionamount;
                $accountbal->save();
            }
            session()->flash('clearsupplier', 'Supplier Account Transaction Successfully');
            return redirect()->route('Clear-Supplier-Account');
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
    public function updatedsupplierid($value)
    {
        if ($this->transactiontype == "Deposit" || $this->transactiontype == "Clear All") {
            $this->transactionids = collect();
        } else {
            $this->transactionids = SupplierTransactionsModel::where('AccountID', $value)->where('Clearance', 'Not Cleared')->distinct()->pluck('PurchaseID');
        }
        $this->pendingpayments = SupplierTransactionsModel::where('AccountID', $value)->where('Clearance', 'Not Cleared')->sum('Amount');
        $account = SupplierAccountBalanceModel::where('AccountID', $value)->orderByDesc('id')->first();
        $accountba = $account ? $account->AccountBalance : 0;
        $this->accountbalance = $accountba - $this->pendingpayments;
        $this->accoulbal = $accountba;
    }

    public function updatedtransactionid($value)
    {
        if ($this->transactiontype == "Clear Transaction") {
            $transactionamountss = PurchaseModel::find($value);;
            if ($transactionamountss) {
                $this->transactionamount = $transactionamountss->UnitCost;
                $this->pendingpayments = $transactionamountss->UnitCost;
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
        $this->clientids = SupplierAccountModel::orderBy('id', 'ASC')->get();
        $this->sellpaymentmethods = PaymentMethodModel::whereNot('PaymentMethod', 'Client Account')->where('Branch', Auth::user()->Branch)->orderBy('id', 'ASC')->get();
    }

    public function render()
    {
        if (Auth::user()->utype == 'General Manager' || Auth::user()->utype == 'Administrator') {
            $registeredclearance = SupplierAccountBalanceModel::orderBy('id', 'DESC')->get();
        } else {
            $registeredclearance = SupplierAccountBalanceModel::Where('Branch', Auth::user()->Branch)->orderBy('id', 'DESC')->get();
        }
        return view('livewire.clear-suppliers-accounts', ['registeredclearance' => $registeredclearance])->layout('layouts.base');
    }
}
