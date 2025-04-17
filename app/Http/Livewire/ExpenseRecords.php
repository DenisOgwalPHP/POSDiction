<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use App\Models\ExpensesModel;
use Livewire\Component;
use Illuminate\Http\Request;

class ExpenseRecords extends Component
{
    public $datefrom;
    public $dateto;
    public function updateddateto()
    {
        $this->validate([
            'datefrom' => 'required',
        ]);
        if ($this->dateto != null) {
            return redirect()->route('Expense-Records', ['slug' => $this->datefrom, 'slug2' => $this->dateto]);
        }
    }
    public function mount(Request $request)
    {
        $this->datefrom = $request->slug;
        $this->dateto = $request->slug2;
    }
    public function render()
    {
        try {
            if ($this->dateto == null) {
                if (Auth::user()->utype == 'General Manager' || Auth::user()->utype == 'Administrator') {
                    $registeredexpenses = ExpensesModel::with('hasusers')->get();
                } else {
                    $registeredexpenses = ExpensesModel::Where('Branch', Auth::user()->Branch)->with('hasusers')->get();
                }
            } else {
                if (Auth::user()->utype == 'General Manager' || Auth::user()->utype == 'Administrator') {
                    $registeredexpenses = ExpensesModel::whereDate('ExpenseDate', '>=', $this->datefrom)->WhereDate('ExpenseDate', '<=', $this->dateto)->with('hasusers')->get();
                } else {
                    $registeredexpenses = ExpensesModel::whereDate('ExpenseDate', '>=', $this->datefrom)->WhereDate('ExpenseDate', '<=', $this->dateto)->Where('Branch', Auth::user()->Branch)->with('hasusers')->get();
                }
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
        return view('livewire.expense-records', ['registeredexpenses' => $registeredexpenses])->layout('layouts.base');
    }
}
