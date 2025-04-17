<?php

namespace App\Http\Livewire;
use Illuminate\Http\Request;
use App\Models\ExpensesCategory;
use Livewire\Component;

class ExpenseCategoryComponent extends Component
{
    public $CategoryName;
    public $slug;
    public function AddExpenseCategory()
    {
        $this->validate([
            'CategoryName' => 'required',
        ]);

        try {
            $registerexpensecategory = ExpensesCategory::findOrNew($this->slug);
            $registerexpensecategory ->CategoryName= $this->CategoryName;
            $registerexpensecategory ->save();
            session()->flash('expensecategoryregister', 'Category saved successfully');
            return redirect()->route('Expense-Category');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
    public function deleteCategory($id)
    {
        try {
            $categoryinfo = ExpensesCategory::find($id);
            $categoryinfo->delete();
            session()->flash('expensecategorydelete', 'Expense has been deleted successfully');
            return redirect()->route('Expense-Category');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
     public function mount(Request $request)
    {
        try {
            $this->slug = $request->query('slug');
            $categorylist = ExpensesCategory::find($this->slug);
            if ($categorylist) {
                $this->CategoryName = $categorylist->CategoryName;
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
    public function render()
    {
         try {
            $registeredcategorys = ExpensesCategory::All();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
        return view('livewire.expense-category-component', ['registeredcategorys' => $registeredcategorys])->layout('layouts.base');
    }
}
