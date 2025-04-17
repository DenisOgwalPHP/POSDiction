<?php

namespace App\Http\Livewire;

use App\Models\AssetsBalanceModel;
use App\Models\BranchBalanceModel;
use App\Models\SupplierTransactionsModel;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;
use App\Models\ExpensesModel;
use App\Models\OtherIncomesModel;
use App\Models\SalesFinalModel;
use Illuminate\Support\Facades\Auth;
use App\Models\BranchModel;
use App\Models\CapitalModel;
use App\Models\ClearClientAccountModel;
use App\Models\DevidendsModel;
use App\Models\PaymentMethodModel;
use App\Models\SalesModel;
use App\Models\StaffPaymentModel;
use App\Models\StoreBalanceModel;
use Illuminate\Support\Facades\DB;
use App\Models\SupplierAccountBalanceModel;
use Livewire\Component;

class TrialBalance extends Component
{
    public $datefrom;
    public $dateto;
    public $branchto;
    public $branches;
    public $branchlabel;
    public $slug;
    public $slug2;
    public $slug3;

    public $registeredexpenses;
    public $registeredpurchases;
    public $registeredsalary;
    public $registeredotherincomes;
    public $registeredsales;
    public $registereddiscounts;
    public $registeredequipment;
    public $registeredcapital;
    public $registeredclientaccounts;
    public $registeredaccountspayable;
    public $registeredaccountsreceivable;
    public $paymentmethods;
    public $registereddevidends;
    public $registeredsupplieraccounts;
    public $carriedforwards;
    public function mount()
    {
        try {
            $this->slug = request()->query('slug');
            $this->slug2 = request()->query('slug2');
            $this->slug3 = request()->query('slug3');
            $this->datefrom = $this->slug;
            $this->dateto = $this->slug2;
            if ($this->slug3) {
                $this->branchto = $this->slug3;
                $branchesss = BranchModel::where('id', $this->slug3)->first();
                $this->branchlabel = $branchesss->BranchName;
            } else {
                $this->branchlabel = null;
            }
            if (Auth::user()->utype == 'General Manager' || Auth::user()->utype == 'Administrator') {
                $this->branches = BranchModel::all();
            } else {
                $this->branches = BranchModel::where('id', Auth::user()->Branch)->get();
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
    public function updateddateto()
    {
        try {
            return redirect()->route('Trial-balance', ['slug' => $this->datefrom, 'slug2' => $this->dateto]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
    public function updatedbranchto()
    {
        try {
            return redirect()->route('Trial-balance', ['slug' => $this->datefrom, 'slug2' => $this->dateto, 'slug3' => $this->branchto]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
    public function generatetrialBalance()
    {
        $this->carriedforwardamounts();
        if ($this->dateto == null) {
        } else {
            if ($this->branchto == null) {
                if (Auth::user()->utype == 'General Manager' || Auth::user()->utype == 'Administrator') {
                    $this->registeredcapital = CapitalModel::sum('Capital');
                    //Cash at Accouts
                    $this->paymentmethods = PaymentMethodModel::select('PaymentMethod', DB::raw('SUM(Balance) as total_balance'))->where('PaymentMethod', '!=', 'Client Account')->groupBy('PaymentMethod')->get();
                    //sales
                    $sales = SalesModel::whereDate('created_at', '>=', $this->datefrom)->whereDate('created_at', '<=', $this->dateto)->get();
                    $total = 0;
                    foreach ($sales as $sale) {
                        $total += $sale->Cost * $sale->Quantity;
                    }
                    $this->registeredsales = (SalesFinalModel::whereDate('created_at', '>=', $this->datefrom)->WhereDate('created_at', '<=', $this->dateto)->sum('TotalAmount')) - $total;
                    $this->registereddiscounts = SalesFinalModel::whereDate('created_at', '>=', $this->datefrom)->WhereDate('created_at', '<=', $this->dateto)->sum('Discount');
                    $this->registeredotherincomes = OtherIncomesModel::whereDate('created_at', '>=', $this->datefrom)->WhereDate('created_at', '<=', $this->dateto)->sum('IncomePaid');
                    //clientaccount
                    $clientdeposits = ClearClientAccountModel::where('TransationType', 'Deposit')->sum('Amount');
                    $clienttransactiocleared = SalesModel::whereColumn('created_at', '<', 'updated_at')->get();
                    $clienttransactioclear = 0;
                    foreach ($clienttransactiocleared as $clienttransactiocleare) {
                        $clienttransactioclear += $clienttransactiocleare->Price * $clienttransactiocleare->Quantity;
                    }
                    $this->registeredclientaccounts = $clientdeposits - $clienttransactioclear;

                    //supplieraccount
                    $supplierdeposits = SupplierAccountBalanceModel::where('TransactionType', 'Deposit')->sum('Amount');
                    $suppliertransactioclear = SupplierTransactionsModel::where('Clearance', '=', 'Cleared')->sum('Amount');
                    $this->registeredsupplieraccounts = $supplierdeposits - $suppliertransactioclear;
                    //equipment
                    $equipments = AssetsBalanceModel::all();
                    $equipmenttotal = 0;
                    foreach ($equipments as $equipment) {
                        $equipmenttotal += $equipment->UnitCost * $equipment->Balance;
                    }
                    $this->registeredequipment =  $equipmenttotal;
                    //Invetory
                    $Storeinvetorys = StoreBalanceModel::all();
                    $storetotal = 0;
                    foreach ($Storeinvetorys as $Storeinvetory) {
                        $storetotal += $Storeinvetory->ItemBalance * $Storeinvetory->StockRate;
                    }
                    $branchinvetorys = BranchBalanceModel::all();
                    $branchtotal = 0;
                    foreach ($branchinvetorys as $branchinvetory) {
                        $branchtotal += $branchinvetory->ItemBalance * $branchinvetory->StockRate;
                    }
                    $this->registeredpurchases = $storetotal + $branchtotal;
                    //Salary
                    $this->registeredsalary = StaffPaymentModel::whereDate('PaymentDate', '>=', $this->datefrom)->WhereDate('PaymentDate', '<=', $this->dateto)->sum('BasicSalary');
                    $this->registeredexpenses = ExpensesModel::whereDate('ExpenseDate', '>=', $this->datefrom)->WhereDate('ExpenseDate', '<=', $this->dateto)->sum('ExpenseCost');
                    //Accounts Payable
                    //accruedexpenses
                    $accruedexpenses = ExpensesModel::whereDate('ExpenseDate', '>=', $this->datefrom)->WhereDate('ExpenseDate', '<=', $this->dateto)->get();
                    $accruedexpensetotal = 0;
                    foreach ($accruedexpenses as $accruedexpense) {
                        $accruedexpensetotal +=  ($accruedexpense->ExpenseCost -  $accruedexpense->ExpensePaid);
                    }
                    $accruedexpensess = $accruedexpensetotal;
                    //accruedsalary
                    $accruedsalarys = StaffPaymentModel::whereDate('PaymentDate', '>=', $this->datefrom)->WhereDate('PaymentDate', '<=', $this->dateto)->get();
                    $accruedsalarytotal = 0;
                    foreach ($accruedsalarys as $accruedsalary) {
                        $accruedsalarytotal +=  ($accruedsalary->BasicSalary -  $accruedsalary->SalaryPaid);
                    }
                    $accruedsalaryss = $accruedsalarytotal;
                    //accruedpurchases
                    $accruedpurchase = SupplierTransactionsModel::where('Clearance', 'Not Cleared')->whereDate('created_at', '>=', $this->datefrom)->WhereDate('created_at', '<=', $this->dateto)->sum('Amount');
                    $this->registeredaccountspayable = $accruedpurchase + $accruedsalaryss + $accruedexpensess;


                    //Accounts Receivale
                    //Accrued sales
                    $accruedsales = SalesModel::where('Cleared', 'Not Cleared')->whereDate('created_at', '>=', $this->datefrom)->whereDate('created_at', '<=', $this->dateto)->get();
                    $accruedsalestotal = 0;
                    foreach ($accruedsales as $accruedsale) {
                        $accruedsalestotal += ($accruedsale->Price * $accruedsale->Quantity);
                    }
                    $this->registeredaccountsreceivable =  $accruedsalestotal;
                    $this->registereddevidends = DevidendsModel::whereDate('created_at', '>=', $this->datefrom)->whereDate('created_at', '<=', $this->dateto)->sum('Amount');
                }
            } else {
                $this->registeredcapital = CapitalModel::Where('Branch', $this->branchto)->sum('Capital');
                //Cash at Accouts
                $this->paymentmethods = PaymentMethodModel::select('PaymentMethod', DB::raw('SUM(Balance) as total_balance'))->Where('Branch', $this->branchto)->where('PaymentMethod', '!=', 'Client Account')->groupBy('PaymentMethod')->get();
                //sales
                $sales = SalesModel::Where('Branch', $this->branchto)->whereDate('created_at', '>=', $this->datefrom)->whereDate('created_at', '<=', $this->dateto)->get();
                $total = 0;
                foreach ($sales as $sale) {
                    $total += $sale->Cost * $sale->Quantity;
                }
                $this->registeredsales = (SalesFinalModel::Where('Branch', $this->branchto)->whereDate('created_at', '>=', $this->datefrom)->WhereDate('created_at', '<=', $this->dateto)->sum('TotalAmount')) - $total;
                $this->registereddiscounts = SalesFinalModel::Where('Branch', $this->branchto)->whereDate('created_at', '>=', $this->datefrom)->WhereDate('created_at', '<=', $this->dateto)->sum('Discount');
                $this->registeredotherincomes = OtherIncomesModel::Where('Branch', $this->branchto)->whereDate('created_at', '>=', $this->datefrom)->WhereDate('created_at', '<=', $this->dateto)->sum('IncomePaid');
                //clientaccount
                $clientdeposits = ClearClientAccountModel::Where('Branch', $this->branchto)->where('TransationType', 'Deposit')->sum('Amount');
                $clienttransactiocleared = SalesModel::Where('Branch', $this->branchto)->whereColumn('created_at', '<', 'updated_at')->get();
                $clienttransactioclear = 0;
                foreach ($clienttransactiocleared as $clienttransactiocleare) {
                    $clienttransactioclear += $clienttransactiocleare->Price * $clienttransactiocleare->Quantity;
                }
                $this->registeredclientaccounts = $clientdeposits - $clienttransactioclear;

                //supplieraccount
                $supplierdeposits = SupplierAccountBalanceModel::Where('Branch', $this->branchto)->where('TransactionType', 'Deposit')->sum('Amount');
                $suppliertransactioclear = SupplierTransactionsModel::Where('Branch', $this->branchto)->where('Clearance', '=', 'Cleared')->sum('Amount');
                $this->registeredsupplieraccounts = $supplierdeposits - $suppliertransactioclear;
                //equipment
                $equipments = AssetsBalanceModel::all();
                $equipmenttotal = 0;
                foreach ($equipments as $equipment) {
                    $equipmenttotal += $equipment->UnitCost * $equipment->Balance;
                }
                $this->registeredequipment =  $equipmenttotal;
                //Invetory
                $Storeinvetorys = StoreBalanceModel::all();
                $storetotal = 0;
                foreach ($Storeinvetorys as $Storeinvetory) {
                    $storetotal += $Storeinvetory->ItemBalance * $Storeinvetory->StockRate;
                }
                $branchinvetorys = BranchBalanceModel::all();
                $branchtotal = 0;
                foreach ($branchinvetorys as $branchinvetory) {
                    $branchtotal += $branchinvetory->ItemBalance * $branchinvetory->StockRate;
                }
                $this->registeredpurchases = $storetotal + $branchtotal;
                //Salary
                $this->registeredsalary = StaffPaymentModel::Where('Branch', $this->branchto)->whereDate('PaymentDate', '>=', $this->datefrom)->WhereDate('PaymentDate', '<=', $this->dateto)->sum('BasicSalary');
                $this->registeredexpenses = ExpensesModel::Where('Branch', $this->branchto)->whereDate('ExpenseDate', '>=', $this->datefrom)->WhereDate('ExpenseDate', '<=', $this->dateto)->sum('ExpenseCost');
                //Accounts Payable
                //accruedexpenses
                $accruedexpenses = ExpensesModel::Where('Branch', $this->branchto)->whereDate('ExpenseDate', '>=', $this->datefrom)->WhereDate('ExpenseDate', '<=', $this->dateto)->get();
                $accruedexpensetotal = 0;
                foreach ($accruedexpenses as $accruedexpense) {
                    $accruedexpensetotal +=  ($accruedexpense->ExpenseCost -  $accruedexpense->ExpensePaid);
                }
                $accruedexpensess = $accruedexpensetotal;
                //accruedsalary
                $accruedsalarys = StaffPaymentModel::Where('Branch', $this->branchto)->whereDate('PaymentDate', '>=', $this->datefrom)->WhereDate('PaymentDate', '<=', $this->dateto)->get();
                $accruedsalarytotal = 0;
                foreach ($accruedsalarys as $accruedsalary) {
                    $accruedsalarytotal +=  ($accruedsalary->BasicSalary -  $accruedsalary->SalaryPaid);
                }
                $accruedsalaryss = $accruedsalarytotal;
                //accruedpurchases
                $accruedpurchase = SupplierTransactionsModel::Where('Branch', $this->branchto)->where('Clearance', 'Not Cleared')->whereDate('created_at', '>=', $this->datefrom)->WhereDate('created_at', '<=', $this->dateto)->sum('Amount');
                $this->registeredaccountspayable = $accruedpurchase + $accruedsalaryss + $accruedexpensess;


                //Accounts Receivale
                //Accrued sales
                $accruedsales = SalesModel::Where('Branch', $this->branchto)->where('Cleared', 'Not Cleared')->whereDate('created_at', '>=', $this->datefrom)->whereDate('created_at', '<=', $this->dateto)->get();
                $accruedsalestotal = 0;
                foreach ($accruedsales as $accruedsale) {
                    $accruedsalestotal += ($accruedsale->Price * $accruedsale->Quantity);
                }
                $this->registeredaccountsreceivable =  $accruedsalestotal;
                $this->registereddevidends = DevidendsModel::Where('Branch', $this->branchto)->whereDate('created_at', '>=', $this->datefrom)->whereDate('created_at', '<=', $this->dateto)->sum('Amount');
            }
        }
        $data = [
            'carriedforwards' =>  $this->carriedforwards,
            'registereddevidends' => $this->registereddevidends,
            'accountsreceivable' =>  $this->registeredaccountsreceivable,
            'registeredaccountspayable' => $this->registeredaccountspayable,
            'invetory' => $this->registeredpurchases,
            'registeredequipment' => $this->registeredequipment,
            'registeredsupplieraccounts' => $this->registeredsupplieraccounts,
            'registeredclientaccounts' => $this->registeredclientaccounts,
            'registereddiscounts' => $this->registereddiscounts,
            'registeredcapital' => $this->registeredcapital,
            'paymentmethods' => $this->paymentmethods,
            'registeredexpenses' => $this->registeredexpenses,
            'registeredpurchases' => $this->registeredpurchases,
            'registeredsalary' => $this->registeredsalary,
            'registeredotherincomes' => $this->registeredotherincomes,
            'registeredfeescollection' => $this->registeredsales,
            'datefrom' => $this->slug,
            'dateto' => $this->slug2,
            'branchlabel' => $this->branchlabel,
        ];

        $pdf = Pdf::loadView('Trial-Balance', $data);
        $pdf->setPaper('A4', 'potrait');
        $pdfName =  'Trial-Balance'.$this->slug2 . $this->slug . $this->slug3 . '.pdf';
        $filePath = 'documents/trialbalance/' . $pdfName;
        Storage::disk('local')->put($filePath, $pdf->output());
        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->output();
        }, $pdfName);
    }
    public function carriedforwardamounts()
    {
        try {
            if ($this->dateto == null) {
            } else {
                if ($this->branchto == null) {
                    if (Auth::user()->utype == 'General Manager' || Auth::user()->utype == 'Administrator') {

                        $salesss = SalesModel::whereDate('created_at', '<', $this->datefrom)->orWhereDate('created_at', '>', $this->dateto)->get();
                        $totalss = 0;
                        foreach ($salesss as $sale) {
                            $totalss += $sale->Cost * $sale->Quantity;
                        }
                        $registeredsalesss = (SalesFinalModel::whereDate('created_at', '<', $this->datefrom)->orWhereDate('created_at', '>', $this->dateto)->sum('TotalAmount')) - $totalss;
                        $registereddiscountsss = SalesFinalModel::whereDate('created_at', '<', $this->datefrom)->orWhereDate('created_at', '>', $this->dateto)->sum('Discount');
                        $registeredotherincomesss = OtherIncomesModel::whereDate('created_at', '<', $this->datefrom)->WhereDate('created_at', '>', $this->dateto)->sum('IncomePaid');

                        //Salary
                        $registeredsalaryss = StaffPaymentModel::whereDate('PaymentDate', '<', $this->datefrom)->orWhereDate('PaymentDate', '>', $this->dateto)->sum('BasicSalary');
                        $registeredexpensesss = ExpensesModel::whereDate('ExpenseDate', '<', $this->datefrom)->orWhereDate('ExpenseDate', '>', $this->dateto)->sum('ExpenseCost');
                        $registereddevidendsss = DevidendsModel::whereDate('created_at', '<', $this->datefrom)->orWhereDate('created_at', '>', $this->dateto)->sum('Amount');
                        $this->carriedforwards = ($registeredsalesss + $registeredotherincomesss) - ($registereddiscountsss + $registeredsalaryss + $registeredexpensesss + $registereddevidendsss);
                    }
                } else {

                    $sales = SalesModel::Where('Branch', $this->branchto)->whereDate('created_at', '<', $this->datefrom)->orWhereDate('created_at', '>', $this->dateto)->get();
                    $total = 0;
                    foreach ($sales as $sale) {
                        $total += $sale->Cost * $sale->Quantity;
                    }
                    $this->registeredsales = (SalesFinalModel::Where('Branch', $this->branchto)->whereDate('created_at', '<', $this->datefrom)->orWhereDate('created_at', '>', $this->dateto)->sum('TotalAmount')) - $total;
                    $this->registereddiscounts = SalesFinalModel::Where('Branch', $this->branchto)->whereDate('created_at', '<', $this->datefrom)->orWhereDate('created_at', '>', $this->dateto)->sum('Discount');
                    $this->registeredotherincomes = OtherIncomesModel::Where('Branch', $this->branchto)->whereDate('created_at', '<', $this->datefrom)->orWhereDate('created_at', '>', $this->dateto)->sum('IncomePaid');

                    //Salary
                    $this->registeredsalary = StaffPaymentModel::Where('Branch', $this->branchto)->whereDate('PaymentDate', '<', $this->datefrom)->orWhereDate('PaymentDate', '>', $this->dateto)->sum('BasicSalary');
                    $this->registeredexpenses = ExpensesModel::Where('Branch', $this->branchto)->whereDate('ExpenseDate', '<', $this->datefrom)->orWhereDate('ExpenseDate', '>', $this->dateto)->sum('ExpenseCost');
                    $this->registereddevidends = DevidendsModel::Where('Branch', $this->branchto)->whereDate('created_at', '<', $this->datefrom)->orWhereDate('created_at', '>', $this->dateto)->sum('Amount');
                    $this->carriedforwards = ($this->registeredsales + $this->registeredotherincomes) - ($this->registereddiscounts + $this->registeredsalary + $this->registeredexpenses + $this->registereddevidends);
                }
            }
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
    public function render()
    {
        try {
            $this->carriedforwardamounts();
            if ($this->dateto == null) {
            } else {
                if ($this->branchto == null) {
                    if (Auth::user()->utype == 'General Manager' || Auth::user()->utype == 'Administrator') {
                        $this->registeredcapital = CapitalModel::sum('Capital');
                        //Cash at Accouts
                        $this->paymentmethods = PaymentMethodModel::select('PaymentMethod', DB::raw('SUM(Balance) as total_balance'))->where('PaymentMethod', '!=', 'Client Account')->groupBy('PaymentMethod')->get();
                        //sales
                        $sales = SalesModel::whereDate('created_at', '>=', $this->datefrom)->whereDate('created_at', '<=', $this->dateto)->get();
                        $total = 0;
                        foreach ($sales as $sale) {
                            $total += $sale->Cost * $sale->Quantity;
                        }
                        $this->registeredsales = (SalesFinalModel::whereDate('created_at', '>=', $this->datefrom)->WhereDate('created_at', '<=', $this->dateto)->sum('TotalAmount')) - $total;
                        $this->registereddiscounts = SalesFinalModel::whereDate('created_at', '>=', $this->datefrom)->WhereDate('created_at', '<=', $this->dateto)->sum('Discount');
                        $this->registeredotherincomes = OtherIncomesModel::whereDate('created_at', '>=', $this->datefrom)->WhereDate('created_at', '<=', $this->dateto)->sum('IncomePaid');
                        //clientaccount
                        $clientdeposits = ClearClientAccountModel::where('TransationType', 'Deposit')->sum('Amount');
                        $clienttransactiocleared = SalesModel::whereColumn('created_at', '<', 'updated_at')->get();
                        $clienttransactioclear = 0;
                        foreach ($clienttransactiocleared as $clienttransactiocleare) {
                            $clienttransactioclear += $clienttransactiocleare->Price * $clienttransactiocleare->Quantity;
                        }
                        $this->registeredclientaccounts = $clientdeposits - $clienttransactioclear;

                        //supplieraccount
                        $supplierdeposits = SupplierAccountBalanceModel::where('TransactionType', 'Deposit')->sum('Amount');
                        $suppliertransactioclear = SupplierTransactionsModel::where('Clearance', '=', 'Cleared')->sum('Amount');
                        $this->registeredsupplieraccounts = $supplierdeposits - $suppliertransactioclear;
                        //equipment
                        $equipments = AssetsBalanceModel::all();
                        $equipmenttotal = 0;
                        foreach ($equipments as $equipment) {
                            $equipmenttotal += $equipment->UnitCost * $equipment->Balance;
                        }
                        $this->registeredequipment =  $equipmenttotal;
                        //Invetory
                        $Storeinvetorys = StoreBalanceModel::all();
                        $storetotal = 0;
                        foreach ($Storeinvetorys as $Storeinvetory) {
                            $storetotal += $Storeinvetory->ItemBalance * $Storeinvetory->StockRate;
                        }
                        $branchinvetorys = BranchBalanceModel::all();
                        $branchtotal = 0;
                        foreach ($branchinvetorys as $branchinvetory) {
                            $branchtotal += $branchinvetory->ItemBalance * $branchinvetory->StockRate;
                        }
                        $this->registeredpurchases = $storetotal + $branchtotal;
                        //Salary
                        $this->registeredsalary = StaffPaymentModel::whereDate('PaymentDate', '>=', $this->datefrom)->WhereDate('PaymentDate', '<=', $this->dateto)->sum('BasicSalary');
                        $this->registeredexpenses = ExpensesModel::whereDate('ExpenseDate', '>=', $this->datefrom)->WhereDate('ExpenseDate', '<=', $this->dateto)->sum('ExpenseCost');
                        //Accounts Payable
                        //accruedexpenses
                        $accruedexpenses = ExpensesModel::whereDate('ExpenseDate', '>=', $this->datefrom)->WhereDate('ExpenseDate', '<=', $this->dateto)->get();
                        $accruedexpensetotal = 0;
                        foreach ($accruedexpenses as $accruedexpense) {
                            $accruedexpensetotal +=  ($accruedexpense->ExpenseCost -  $accruedexpense->ExpensePaid);
                        }
                        $accruedexpensess = $accruedexpensetotal;
                        //accruedsalary
                        $accruedsalarys = StaffPaymentModel::whereDate('PaymentDate', '>=', $this->datefrom)->WhereDate('PaymentDate', '<=', $this->dateto)->get();
                        $accruedsalarytotal = 0;
                        foreach ($accruedsalarys as $accruedsalary) {
                            $accruedsalarytotal +=  ($accruedsalary->BasicSalary -  $accruedsalary->SalaryPaid);
                        }
                        $accruedsalaryss = $accruedsalarytotal;
                        //accruedpurchases
                        $accruedpurchase = SupplierTransactionsModel::where('Clearance', 'Not Cleared')->whereDate('created_at', '>=', $this->datefrom)->WhereDate('created_at', '<=', $this->dateto)->sum('Amount');
                        $this->registeredaccountspayable = $accruedpurchase + $accruedsalaryss + $accruedexpensess;


                        //Accounts Receivale
                        //Accrued sales
                        $accruedsales = SalesModel::where('Cleared', 'Not Cleared')->whereDate('created_at', '>=', $this->datefrom)->whereDate('created_at', '<=', $this->dateto)->get();
                        $accruedsalestotal = 0;
                        foreach ($accruedsales as $accruedsale) {
                            $accruedsalestotal += ($accruedsale->Price * $accruedsale->Quantity);
                        }
                        $this->registeredaccountsreceivable =  $accruedsalestotal;
                        $this->registereddevidends = DevidendsModel::whereDate('created_at', '>=', $this->datefrom)->whereDate('created_at', '<=', $this->dateto)->sum('Amount');
                    }
                } else {
                    $this->registeredcapital = CapitalModel::Where('Branch', $this->branchto)->sum('Capital');
                    //Cash at Accouts
                    $this->paymentmethods = PaymentMethodModel::select('PaymentMethod', DB::raw('SUM(Balance) as total_balance'))->Where('Branch', $this->branchto)->where('PaymentMethod', '!=', 'Client Account')->groupBy('PaymentMethod')->get();
                    //sales
                    $sales = SalesModel::Where('Branch', $this->branchto)->whereDate('created_at', '>=', $this->datefrom)->whereDate('created_at', '<=', $this->dateto)->get();
                    $total = 0;
                    foreach ($sales as $sale) {
                        $total += $sale->Cost * $sale->Quantity;
                    }
                    $this->registeredsales = (SalesFinalModel::Where('Branch', $this->branchto)->whereDate('created_at', '>=', $this->datefrom)->WhereDate('created_at', '<=', $this->dateto)->sum('TotalAmount')) - $total;
                    $this->registereddiscounts = SalesFinalModel::Where('Branch', $this->branchto)->whereDate('created_at', '>=', $this->datefrom)->WhereDate('created_at', '<=', $this->dateto)->sum('Discount');
                    $this->registeredotherincomes = OtherIncomesModel::Where('Branch', $this->branchto)->whereDate('created_at', '>=', $this->datefrom)->WhereDate('created_at', '<=', $this->dateto)->sum('IncomePaid');
                    //clientaccount
                    $clientdeposits = ClearClientAccountModel::Where('Branch', $this->branchto)->where('TransationType', 'Deposit')->sum('Amount');
                    $clienttransactiocleared = SalesModel::Where('Branch', $this->branchto)->whereColumn('created_at', '<', 'updated_at')->get();
                    $clienttransactioclear = 0;
                    foreach ($clienttransactiocleared as $clienttransactiocleare) {
                        $clienttransactioclear += $clienttransactiocleare->Price * $clienttransactiocleare->Quantity;
                    }
                    $this->registeredclientaccounts = $clientdeposits - $clienttransactioclear;

                    //supplieraccount
                    $supplierdeposits = SupplierAccountBalanceModel::Where('Branch', $this->branchto)->where('TransactionType', 'Deposit')->sum('Amount');
                    $suppliertransactioclear = SupplierTransactionsModel::Where('Branch', $this->branchto)->where('Clearance', '=', 'Cleared')->sum('Amount');
                    $this->registeredsupplieraccounts = $supplierdeposits - $suppliertransactioclear;
                    //equipment
                    $equipments = AssetsBalanceModel::all();
                    $equipmenttotal = 0;
                    foreach ($equipments as $equipment) {
                        $equipmenttotal += $equipment->UnitCost * $equipment->Balance;
                    }
                    $this->registeredequipment =  $equipmenttotal;
                    //Invetory
                    $Storeinvetorys = StoreBalanceModel::all();
                    $storetotal = 0;
                    foreach ($Storeinvetorys as $Storeinvetory) {
                        $storetotal += $Storeinvetory->ItemBalance * $Storeinvetory->StockRate;
                    }
                    $branchinvetorys = BranchBalanceModel::all();
                    $branchtotal = 0;
                    foreach ($branchinvetorys as $branchinvetory) {
                        $branchtotal += $branchinvetory->ItemBalance * $branchinvetory->StockRate;
                    }
                    $this->registeredpurchases = $storetotal + $branchtotal;
                    //Salary
                    $this->registeredsalary = StaffPaymentModel::Where('Branch', $this->branchto)->whereDate('PaymentDate', '>=', $this->datefrom)->WhereDate('PaymentDate', '<=', $this->dateto)->sum('BasicSalary');
                    $this->registeredexpenses = ExpensesModel::Where('Branch', $this->branchto)->whereDate('ExpenseDate', '>=', $this->datefrom)->WhereDate('ExpenseDate', '<=', $this->dateto)->sum('ExpenseCost');
                    //Accounts Payable
                    //accruedexpenses
                    $accruedexpenses = ExpensesModel::Where('Branch', $this->branchto)->whereDate('ExpenseDate', '>=', $this->datefrom)->WhereDate('ExpenseDate', '<=', $this->dateto)->get();
                    $accruedexpensetotal = 0;
                    foreach ($accruedexpenses as $accruedexpense) {
                        $accruedexpensetotal +=  ($accruedexpense->ExpenseCost -  $accruedexpense->ExpensePaid);
                    }
                    $accruedexpensess = $accruedexpensetotal;
                    //accruedsalary
                    $accruedsalarys = StaffPaymentModel::Where('Branch', $this->branchto)->whereDate('PaymentDate', '>=', $this->datefrom)->WhereDate('PaymentDate', '<=', $this->dateto)->get();
                    $accruedsalarytotal = 0;
                    foreach ($accruedsalarys as $accruedsalary) {
                        $accruedsalarytotal +=  ($accruedsalary->BasicSalary -  $accruedsalary->SalaryPaid);
                    }
                    $accruedsalaryss = $accruedsalarytotal;
                    //accruedpurchases
                    $accruedpurchase = SupplierTransactionsModel::Where('Branch', $this->branchto)->where('Clearance', 'Not Cleared')->whereDate('created_at', '>=', $this->datefrom)->WhereDate('created_at', '<=', $this->dateto)->sum('Amount');
                    $this->registeredaccountspayable = $accruedpurchase + $accruedsalaryss + $accruedexpensess;


                    //Accounts Receivale
                    //Accrued sales
                    $accruedsales = SalesModel::Where('Branch', $this->branchto)->where('Cleared', 'Not Cleared')->whereDate('created_at', '>=', $this->datefrom)->whereDate('created_at', '<=', $this->dateto)->get();
                    $accruedsalestotal = 0;
                    foreach ($accruedsales as $accruedsale) {
                        $accruedsalestotal += ($accruedsale->Price * $accruedsale->Quantity);
                    }
                    $this->registeredaccountsreceivable =  $accruedsalestotal;
                    $this->registereddevidends = DevidendsModel::Where('Branch', $this->branchto)->whereDate('created_at', '>=', $this->datefrom)->whereDate('created_at', '<=', $this->dateto)->sum('Amount');
                }
            }
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
        return view('livewire.trial-balance', ['carriedforwards' => $this->carriedforwards, 'registereddevidends' => $this->registereddevidends, 'accountsreceivable' => $this->registeredaccountsreceivable, 'registeredaccountspayable' => $this->registeredaccountspayable, 'invetory' => $this->registeredpurchases, 'registeredequipment' => $this->registeredequipment, 'registeredsupplieraccounts' => $this->registeredsupplieraccounts, 'registeredclientaccounts' => $this->registeredclientaccounts, 'registereddiscounts' => $this->registereddiscounts, 'registeredcapital' => $this->registeredcapital, 'paymentmethods' => $this->paymentmethods, 'registeredexpenses' => $this->registeredexpenses, 'registeredpurchases' => $this->registeredpurchases, 'registeredsalary' => $this->registeredsalary, 'registeredotherincomes' => $this->registeredotherincomes, 'registeredfeescollection' => $this->registeredsales])->layout('layouts.base');
    }
}
