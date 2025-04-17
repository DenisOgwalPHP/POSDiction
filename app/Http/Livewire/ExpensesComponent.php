<?php

namespace App\Http\Livewire;

use App\Models\BranchModel;
use App\Models\ExpensesCategory;
use App\Models\PaymentMethodModel;
use Illuminate\Http\Request;
use App\Models\ExpensesModel;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ExpensesComponent extends Component
{
    public $ExpenseName;
    public $ExpenseCategory;
    public $ExpenseDate;
    public $ExpenseCost;
    public $ExpensePaid;
    public $PaymentMethod;
    public $description;
    public $expensecategorys;
    public $branch;
    public $branches;
    public $sellpaymentmethods;
    public $slug;
    public function AddExpense()
    {
        // Validation rules for the input data
        $this->validate([
            'ExpenseName' => 'required',
            'ExpenseCategory' => 'required',
            'ExpenseDate' => 'required',
            'ExpenseCost' => 'required|numeric',
            'ExpensePaid' => 'required|numeric',
            'PaymentMethod' => 'required',
            'description' => 'required',
            'branch' => 'required',
        ]);

        try {
            $registerexpense = ExpensesModel::findOrNew($this->slug);
            $registerexpense->Expense = $this->ExpenseName;
            $registerexpense->ExpenseCategory = $this->ExpenseCategory;
            $registerexpense->ExpenseDate = $this->ExpenseDate;
            $registerexpense->ExpenseCost = $this->ExpenseCost;
            $registerexpense->ExpensePaid = $this->ExpensePaid;
            $registerexpense->PaymentMethod = $this->PaymentMethod;
            $registerexpense->InputUser  = Auth::user()->id;
            $registerexpense->Branch = $this->branch;
            $registerexpense->Description = $this->description;
            $registerexpense->save();
            $accountbal = PaymentMethodModel::find($this->PaymentMethod);
            $accountbal->Balance = $accountbal->Balance - $this->ExpensePaid;
            $accountbal->save();
            session()->flash('expenseregister', 'Expense Payment saved successfully');
            return redirect()->route('Expense-Entry');
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
    public function deleteExpense($id)
    {
        try {
            $expenseinfo = ExpensesModel::find($id);
            $accountbal = PaymentMethodModel::find($expenseinfo->PaymentMethod);
            $accountbal->Balance = $accountbal->Balance - $expenseinfo->ExpensePaid;
            $accountbal->save();
            $expenseinfo->delete();
            session()->flash('expensedelete', 'Expense has been deleted successfully');
            return redirect()->route('Expense-Entry');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function mount(Request $request)
    {
        try {
            $this->sellpaymentmethods = PaymentMethodModel::where('Branch', Auth::user()->Branch)->orderBy('id', 'ASC')->get();
            $this->expensecategorys = ExpensesCategory::all();
            if (Auth::user()->utype == 'General Manager' || Auth::user()->utype == 'Administrator') {
                $this->branches = BranchModel::all();
            } else {
                $this->branches = BranchModel::Where('id', Auth::user()->Branch)->orderBy('id', 'DESC')->get();
            }
            $this->slug = $request->query('slug');
            $expenselist = ExpensesModel::find($this->slug);
            if ($expenselist) {
                $this->ExpenseName = $expenselist->Expense;
                $this->ExpenseCategory = $expenselist->ExpenseCategory;
                $this->ExpenseDate = $expenselist->ExpenseDate;
                $this->ExpenseCost = $expenselist->ExpenseCost;
                $this->ExpensePaid = $expenselist->ExpensePaid;
                $this->description = $expenselist->Description;
                $this->PaymentMethod = $expenselist->PaymentMethod;
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
    public function render()
    {
        try {
            if (Auth::user()->utype == 'General Manager' || Auth::user()->utype == 'Administrator') {
                $registeredexpenses = ExpensesModel::All();
            } else {
                $registeredexpenses = ExpensesModel::Where('Branch', Auth::user()->Branch)->orderBy('id', 'DESC')->get();
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
        return view('livewire.expenses-component', ['registeredexpenses' => $registeredexpenses])->layout('layouts.base');
    }
}
