<?php

namespace App\Http\Livewire;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;
use App\Models\ExpensesModel;
use App\Models\OtherIncomesModel;
use App\Models\SalesFinalModel;
use Illuminate\Support\Facades\Auth;
use App\Models\BranchModel;
use App\Models\SalesModel;
use App\Models\StaffPaymentModel;
use Livewire\Component;

class IncomeStatement extends Component
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
            return redirect()->route('Income-Statement', ['slug' => $this->datefrom, 'slug2' => $this->dateto]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
    public function updatedbranchto()
    {
        try {
            return redirect()->route('Income-Statement', ['slug' => $this->datefrom, 'slug2' => $this->dateto, 'slug3' => $this->branchto]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
    public function generateIncomeStatement()
    {
        if ($this->branchto == null) {
            if (Auth::user()->utype == 'General Manager' || Auth::user()->utype == 'Administrator') {
                $this->registeredsales = SalesFinalModel::whereDate('created_at', '>=', $this->datefrom)->WhereDate('created_at', '<=', $this->dateto)->sum('TotalAmount');
                $this->registeredotherincomes = OtherIncomesModel::whereDate('created_at', '>=', $this->datefrom)->WhereDate('created_at', '<=', $this->dateto)->sum('IncomePaid');
                $this->registeredsalary = StaffPaymentModel::whereDate('PaymentDate', '>=', $this->datefrom)->WhereDate('PaymentDate', '<=', $this->dateto)->sum('BasicSalary');
                $this->registeredpurchases = SalesModel::whereDate('created_at', '>=', $this->datefrom)->WhereDate('created_at', '<=', $this->dateto)->sum('Cost');
                $this->registereddiscounts = SalesFinalModel::whereDate('created_at', '>=', $this->datefrom)->WhereDate('created_at', '<=', $this->dateto)->sum('Discount');
                $this->registeredexpenses = ExpensesModel::whereDate('ExpenseDate', '>=', $this->datefrom)->WhereDate('ExpenseDate', '<=', $this->dateto)->sum('ExpenseCost');
            }
        } else {
            $this->registeredsales = SalesFinalModel::Where('Branch', $this->branchto)->whereDate('created_at', '>=', $this->datefrom)->WhereDate('created_at', '<=', $this->dateto)->sum('TotalAmount');
            $this->registeredotherincomes = OtherIncomesModel::Where('Branch', $this->branchto)->whereDate('created_at', '>=', $this->datefrom)->WhereDate('created_at', '<=', $this->dateto)->sum('IncomePaid');
            $this->registeredsalary = StaffPaymentModel::Where('Branch', $this->branchto)->whereDate('PaymentDate', '>=', $this->datefrom)->WhereDate('PaymentDate', '<=', $this->dateto)->sum('BasicSalary');
            $this->registeredpurchases = SalesModel::Where('Branch', $this->branchto)->whereDate('created_at', '>=', $this->datefrom)->WhereDate('created_at', '<=', $this->dateto)->sum('Cost');
            $this->registereddiscounts = SalesFinalModel::Where('Branch', $this->branchto)->whereDate('created_at', '>=', $this->datefrom)->WhereDate('created_at', '<=', $this->dateto)->sum('Discount');
            $this->registeredexpenses = ExpensesModel::Where('Branch', $this->branchto)->whereDate('ExpenseDate', '>=', $this->datefrom)->WhereDate('ExpenseDate', '<=', $this->dateto)->sum('ExpenseCost');
        }
        $data = [
            'registeredsales' =>  $this->registeredsales,
            'registeredotherincomes' => $this->registeredotherincomes,
            'registeredsalary' =>  $this->registeredsalary,
            'registeredpurchases' => $this->registeredpurchases,
            'registereddiscounts' => $this->registereddiscounts,
            'registeredexpenses' => $this->registeredexpenses,
            'datefrom' => $this->slug,
            'dateto' => $this->slug2,
            'branchlabel' => $this->branchlabel,
        ];

        $pdf = Pdf::loadView('income-statement', $data);
        $pdf->setPaper('A4', 'potrait');
        $pdfName = 'income-statement'. $this->slug2 . $this->slug . $this->slug3 . '.pdf';
        $filePath = 'documents/incomestatement/' . $pdfName;
        Storage::disk('local')->put($filePath, $pdf->output());
        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->output();
        }, $pdfName);
    }
    public function render()
    {
        try {
            if ($this->dateto == null) {
            } else {
                if ($this->branchto == null) {
                    if (Auth::user()->utype == 'General Manager' || Auth::user()->utype == 'Administrator') {
                        $this->registeredsales = SalesFinalModel::whereDate('created_at', '>=', $this->datefrom)->WhereDate('created_at', '<=', $this->dateto)->sum('TotalAmount');
                        $this->registeredotherincomes = OtherIncomesModel::whereDate('created_at', '>=', $this->datefrom)->WhereDate('created_at', '<=', $this->dateto)->sum('IncomePaid');
                        $this->registeredsalary = StaffPaymentModel::whereDate('PaymentDate', '>=', $this->datefrom)->WhereDate('PaymentDate', '<=', $this->dateto)->sum('BasicSalary');
                        // Retrieve the records within the specified date range
                        $sales = SalesModel::whereDate('created_at', '>=', $this->datefrom)->whereDate('created_at', '<=', $this->dateto)->get();
                        // Initialize total
                        $total = 0;
                        // Calculate the total by multiplying Cost and Quantity for each record
                        foreach ($sales as $sale) {
                            $total += $sale->Cost * $sale->Quantity;
                        }
                        // Assign the total to the variable
                        $this->registeredpurchases = $total;
                        $this->registereddiscounts = SalesFinalModel::whereDate('created_at', '>=', $this->datefrom)->WhereDate('created_at', '<=', $this->dateto)->sum('Discount');
                        $this->registeredexpenses = ExpensesModel::whereDate('ExpenseDate', '>=', $this->datefrom)->WhereDate('ExpenseDate', '<=', $this->dateto)->sum('ExpenseCost');
                    }
                } else {
                    $this->registeredsales = SalesFinalModel::Where('Branch', $this->branchto)->whereDate('created_at', '>=', $this->datefrom)->WhereDate('created_at', '<=', $this->dateto)->sum('TotalAmount');
                    $this->registeredotherincomes = OtherIncomesModel::Where('Branch', $this->branchto)->whereDate('created_at', '>=', $this->datefrom)->WhereDate('created_at', '<=', $this->dateto)->sum('IncomePaid');
                    $this->registeredsalary = StaffPaymentModel::Where('Branch', $this->branchto)->whereDate('PaymentDate', '>=', $this->datefrom)->WhereDate('PaymentDate', '<=', $this->dateto)->sum('BasicSalary');
                    // Retrieve the records within the specified date range
                    $sales = SalesModel::Where('Branch', $this->branchto)->whereDate('created_at', '>=', $this->datefrom)->whereDate('created_at', '<=', $this->dateto)->get();
                    // Initialize total
                    $total = 0;
                    // Calculate the total by multiplying Cost and Quantity for each record
                    foreach ($sales as $sale) {
                        $total += $sale->Cost * $sale->Quantity;
                    }
                    // Assign the total to the variable
                    $this->registeredpurchases = $total;
                    $this->registereddiscounts = SalesFinalModel::Where('Branch', $this->branchto)->whereDate('created_at', '>=', $this->datefrom)->WhereDate('created_at', '<=', $this->dateto)->sum('Discount');
                    $this->registeredexpenses = ExpensesModel::Where('Branch', $this->branchto)->whereDate('ExpenseDate', '>=', $this->datefrom)->WhereDate('ExpenseDate', '<=', $this->dateto)->sum('ExpenseCost');
                }
            }
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
        return view('livewire.income-statement', ['registeredexpenses' => $this->registeredexpenses, 'registeredpurchases' => $this->registeredpurchases, 'registeredsalary' => $this->registeredsalary, 'registeredotherincomes' => $this->registeredotherincomes, 'registeredfeescollection' => $this->registeredsales])->layout('layouts.base');
    }
}
