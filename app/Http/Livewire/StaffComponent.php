<?php

namespace App\Http\Livewire;
use App\Models\BranchModel;
use App\Models\StaffModel;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Livewire\Component;
use Livewire\WithFileUploads;

class StaffComponent extends Component
{
    use WithFileUploads;
    public $newImage;
    public $StaffID;
    public $StaffName;
    public $StaffInitial;
    public $UserID;
    public $DOB;
    public $Department;
    public $Qualifications;
    public $Designation;
    public $BasicSalary;
    public $AccountNo;
    public $BankName;
    public $OfficeNo;
    public $Residence;
    public $Contact;
    public $EmailAddress;
    public $Gender;
    public $emails;
    public $slug;
    public $StaffType;
    public $StaffProfilePic;
    public $branch;
    public $branches;

    public function AddStaff()
    {
        // Validation rules for the input data
        $this->validate([
            'StaffID' => 'required',
            'StaffName' => 'required',
            'StaffInitial' => 'required',
            'DOB' => 'required',
            'Department' => 'required',
            'Qualifications' => 'required',
            'Designation' => 'required',
            'BasicSalary' => 'required|numeric',
            'AccountNo' => 'required',
            'BankName' => 'required',
            'OfficeNo' => 'required',
            'Residence' => 'required',
            'Contact' => 'required',
            'EmailAddress' => 'required',
            'Gender' => 'required',
            'UserID' => 'required',
            'StaffType' => 'required',
            'branch' => 'required',
        ]);

        try {
            $registerstaff = StaffModel::findOrNew($this->slug);
            $registerstaff->StaffID = $this->StaffID;
            $registerstaff->StaffName = $this->StaffName;
            $registerstaff->Initials = $this->StaffInitial;
            $registerstaff->Gender = $this->Gender;
            $registerstaff->Address = $this->Residence;
            $registerstaff->PhoneNumber = $this->Contact;
            $registerstaff->DOB = $this->DOB;
            $registerstaff->Department = $this->Department;
            $registerstaff->Qualifications = $this->Qualifications;
            $registerstaff->Designation = $this->Designation;
            $registerstaff->Email = $this->EmailAddress;
            $registerstaff->BasicSalary = $this->BasicSalary;
            $registerstaff->AccountNo = $this->AccountNo;
            $registerstaff->BankName = $this->BankName;
            $registerstaff->OfficeNo = $this->OfficeNo;
            $registerstaff->StaffType = $this->StaffType;
            $registerstaff->UserAccount = $this->UserID;
            $registerstaff->Branch = $this->branch;
            if ($this->newImage) {
                $registerstaff->StaffProfilePic = $this->StaffID . '.' . $this->newImage->extension();
                $profilepic = $this->StaffID . '.' . $this->newImage->extension();
                $this->newImage->storeAs('StaffProfilePics', $profilepic);
            }
            $registerstaff->save();
            session()->flash('staffregister', 'Staff saved successfully');
            return redirect()->route('Create-Staff');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
    public function updatednewImage()
    {
        $registeredstaff = StaffModel::find($this->slug);
        if ($registeredstaff) {
            $registeredstaff->StaffProfilePic = $this->StaffID . '.' . $this->newImage->extension();
            $profilepic = $this->StaffID . '.' . $this->newImage->extension();
            $this->newImage->storeAs('StaffProfilePics', $profilepic);
            $registeredstaff->save();
            $this->StaffProfilePic = $this->StaffID . '.' . $this->newImage->extension();
        }
    }
    public function deleteStaff($id)
    {
        try {
            $staffinfo = StaffModel::find($id);
            $staffinfo->delete();
            session()->flash('staffdelete', 'Staff has been deleted successfully');
            return redirect()->route('Create-Staff');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
    public function mount(Request $request)
    {
        try {
            $this->branches = BranchModel::all();
            $this->emails = User::all();
            $this->slug = $request->query('slug');
            $stafflist = StaffModel::find($this->slug);
            if ($stafflist) {
                $this->StaffID = $stafflist->StaffID;
                $this->StaffName = $stafflist->StaffName;
                $this->StaffInitial = $stafflist->Initials;
                $this->Gender = $stafflist->Gender;
                $this->Residence = $stafflist->Address;
                $this->Contact = $stafflist->PhoneNumber;
                $this->DOB = $stafflist->DOB;
                $this->Department = $stafflist->Department;
                $this->Qualifications = $stafflist->Qualifications;
                $this->Designation = $stafflist->Designation;
                $this->EmailAddress = $stafflist->Email;
                $this->BasicSalary = $stafflist->BasicSalary;
                $this->AccountNo = $stafflist->AccountNo;
                $this->BankName = $stafflist->BankName;
                $this->OfficeNo = $stafflist->OfficeNo;
                $this->StaffType = $stafflist->StaffType;
                $this->UserID = $stafflist->UserAccount;
                $this->StaffProfilePic = $stafflist->StaffProfilePic;
                $this->branch = $stafflist->Branch;
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
    public function render()
    {
        try {
            if (Auth::user()->utype == 'General Manager' || Auth::user()->utype == 'Administrator') {
                $registeredstaffs = StaffModel::All();
            } else {
                $registeredstaffs = StaffModel::where('Branch', Auth::user()->Branch)->get();
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
        return view('livewire.staff-component', ['registeredstaffs' => $registeredstaffs])->layout('layouts.base');
    }
}
