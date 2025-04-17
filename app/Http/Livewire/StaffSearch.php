<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use App\Models\ExpensesModel;
use App\Models\StaffModel;
use App\Models\StaffPaymentModel;
use Livewire\Component;

class StaffSearch extends Component
{
    public $search;
    public $slug;
    public $staffnam;
    public $stafflog;
    public $registeredstaffs;
    public $registeredstaffpayment;
    public $registeredbookrequests;
    public $registeredexpenses;

    public function mount()
    {
        try {
            $this->search = request()->query('slug');
            if ($this->search != '') {
                if (Auth::user()->utype == 'General Manager' || Auth::user()->utype == 'Administrator') {
                    $staffid = StaffModel::where('StaffID', 'like', '%' . $this->search . '%')->orWhere('StaffName', 'like', '%' . $this->search . '%')->orWhere('Initials', 'like', '%' . $this->search . '%')->orWhere('OfficeNo', 'like', '%' . $this->search . '%')->orWhere('Designation', 'like', '%' . $this->search . '%')->first();
                    if ($staffid) {
                        $this->staffnam = $staffid->id;
                        $this->stafflog = $staffid->UserAccount;
                        $this->registeredstaffs = StaffModel::where('id', $this->staffnam)->orderby('id', 'DESC')->get();
                        $this->registeredstaffpayment = StaffPaymentModel::where('StaffReference', $this->staffnam)->orderby('id', 'DESC')->with('hasstaff')->get();
                        $this->registeredexpenses = ExpensesModel::where('InputUser', $this->stafflog)->orderby('id', 'DESC')->with('hasusers')->get();
                    } else {
                        $this->staffnam = 0;
                    }
                } else {
                    $staffid = StaffModel::Where('Branch', Auth::user()->Branch)->where('StaffID', 'like', '%' . $this->search . '%')->orWhere('StaffName', 'like', '%' . $this->search . '%')->orWhere('Initials', 'like', '%' . $this->search . '%')->orWhere('OfficeNo', 'like', '%' . $this->search . '%')->orWhere('Designation', 'like', '%' . $this->search . '%')->first();
                    if ($staffid) {
                        $this->staffnam = $staffid->id;
                        $this->stafflog = $staffid->UserAccount;
                        $this->registeredstaffs = StaffModel::Where('Branch', Auth::user()->Branch)->where('id', $this->staffnam)->orderby('id', 'DESC')->get();
                        $this->registeredstaffpayment = StaffPaymentModel::Where('Branch', Auth::user()->Branch)->where('StaffReference', $this->staffnam)->orderby('id', 'DESC')->with('hasstaff')->get();
                        $this->registeredexpenses = ExpensesModel::Where('Branch', Auth::user()->Branch)->where('InputUser', $this->stafflog)->orderby('id', 'DESC')->with('hasusers')->get();
                    } else {
                        $this->staffnam = 0;
                    }
                }
            } else {
            }
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
    public function MakeSearch()
    {
        try {
            session()->flash('searchstaff', 'Student Information Displayed successfully');
            return redirect()->route('Staff-Search', ['slug' => $this->search]);
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
    public function render()
    {
        return view('livewire.staff-search')->layout('layouts.base');
    }
}
