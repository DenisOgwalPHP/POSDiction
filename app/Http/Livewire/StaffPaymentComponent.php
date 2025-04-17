<?php

namespace App\Http\Livewire;

use App\Models\PaymentMethodModel;
use Illuminate\Support\Facades\Auth;
use App\Models\StaffModel;
use App\Models\StaffPaymentModel;
use Illuminate\Http\Request;
use Livewire\Component;

class StaffPaymentComponent extends Component
{
    public $StaffID;
    public $StaffName;
    public $StaffReference;
    public $PaymentDate;
    public $PaymentMonths;
    public $PaymentYear;
    public $BasicSalary;
    public $SalaryPaid;
    public $PaymentMethod;
    public $description;
    public $staffids;
    public $staffbranch;
    public $sellpaymentmethods;
    public $slug;
    public function AddStaffPayment()
    {
        // Validation rules for the input data
        $this->validate([
            'StaffID' => 'required',
            'PaymentDate' => 'required',
            'PaymentMonths' => 'required',
            'PaymentYear' => 'required',
            'BasicSalary' => 'required|numeric',
            'SalaryPaid' => 'required|numeric',
            'PaymentMethod' => 'required',
            'description' => 'required',
        ]);

        try {
            $registerstaffpayment = StaffPaymentModel::findOrNew($this->slug);
            $isNewTransaction = !$registerstaffpayment->exists;
            $registerstaffpayment->StaffID = $this->StaffReference;
            $registerstaffpayment->PaymentDate = $this->PaymentDate;
            $registerstaffpayment->StaffReference = $this->StaffID;
            $registerstaffpayment->PaymentMonths = $this->PaymentMonths;
            $registerstaffpayment->PaymentYear = $this->PaymentYear;
            $registerstaffpayment->BasicSalary = $this->BasicSalary;
            $registerstaffpayment->SalaryPaid = $this->SalaryPaid;
            $registerstaffpayment->PaymentMethod = $this->PaymentMethod;
            $registerstaffpayment->PaymentNotes = $this->description;
            $registerstaffpayment->Branch = Auth::user()->Branch;
            $registerstaffpayment->save();
            if ($isNewTransaction) {
            $accountbal = PaymentMethodModel::find($this->PaymentMethod);
            $accountbal->Balance = $accountbal->Balance - $this->SalaryPaid;
            $accountbal->save();
            }
            session()->flash('staffpaymentregister', 'Staff Payment saved successfully');
            return redirect()->route('Staff-Payment');
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
    public function deleteStaffPayment($id)
    {
        try {

            $staffpaymentinfo = StaffPaymentModel::find($id);
            $accountbal = PaymentMethodModel::find($staffpaymentinfo->PaymentMethod);
            $accountbal->Balance = $accountbal->Balance + $staffpaymentinfo->SalaryPaid;
            $accountbal->save();
            $staffpaymentinfo->delete();
            session()->flash('staffpaymentdelete', 'Staff has been deleted successfully');
            return redirect()->route('Staff-Payment');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
    public function mount(Request $request)
    {
        try {
            if (Auth::user()->utype == 'General Manager' || Auth::user()->utype == 'Administrator') {
                $this->staffids = StaffModel::all();
            } else {
                $this->staffids = StaffModel::where('Branch', Auth::user()->Branch)->get();
            }
            $this->sellpaymentmethods = PaymentMethodModel::where('Branch', Auth::user()->Branch)->orderBy('id', 'ASC')->get();
            $this->slug = $request->query('slug');
            $staffpaymentlist = StaffPaymentModel::find($this->slug);
            if ($staffpaymentlist) {
                $this->StaffID = $staffpaymentlist->StaffReference;
                $this->PaymentDate = $staffpaymentlist->PaymentDate;
                $this->StaffReference = $staffpaymentlist->StaffID;
                $this->PaymentMonths = $staffpaymentlist->PaymentMonths;
                $this->PaymentYear = $staffpaymentlist->PaymentYear;
                $this->BasicSalary = $staffpaymentlist->BasicSalary;
                $this->SalaryPaid = $staffpaymentlist->SalaryPaid;
                $this->PaymentMethod = $staffpaymentlist->PaymentMethod;
                $this->description = $staffpaymentlist->PaymentNotes;
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
    public function updatedStaffID($value)
    {
        try {
            $staffCollection = StaffModel::where('id', $value)->first();
            if ($staffCollection) {
                $this->StaffReference = $staffCollection->StaffID;
                $this->BasicSalary = $staffCollection->BasicSalary;
                $this->StaffName = $staffCollection->StaffName;
                $this->staffbranch = $staffCollection->Branch;
            } else {
                // If no streams are found, set $streams to an empty collection
                $this->StaffReference = $value;
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
    public function updatedSalaryPaid()
    {
        $this->validate([
            'StaffID' => 'required',
            'PaymentMonths' => 'required',
            'PaymentYear' => 'required',
        ]);

        try {
            $summedValues = StaffPaymentComponent::where('PaymentMonths', $this->PaymentMonths)
                ->where('PaymentYear', $this->PaymentYear)
                ->where('StaffReference', $this->StaffID)
                ->groupBy('StaffReference')
                ->selectRaw('StaffReference, SUM(SalaryPaid) as total')
                ->get();

            if (!$summedValues->isEmpty()) {
                // The result is not empty, you can proceed with the rest of your code
                foreach ($summedValues as $result) {
                    $total = $result->total;
                    $Alltotals = $total + $this->SalaryPaid;
                    if ($Alltotals >= $this->BasicSalary || $this->SalaryPaid >= $this->BasicSalary) {
                        //Session()->flash('message', 'Payment more than or equal to basic Salary');
                        return;
                    }
                }
            } else {
                if ($this->SalaryPaid >= $this->BasicSalary) {
                    //Session()->flash('message', 'Payment more than or equal to basic Salary');
                    return;
                }
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
    public function render()
    {
        try {
            if (Auth::user()->utype == 'General Manager' || Auth::user()->utype == 'Administrator') {
                $registeredstaffpayment = StaffPaymentModel::All();
            } else {
                $registeredstaffpayment = StaffPaymentModel::where('Branch', Auth::user()->Branch)->get();
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
        return view('livewire.staff-payment-component', ['registeredstaffpayment' => $registeredstaffpayment])->layout('layouts.base');
    }
}
