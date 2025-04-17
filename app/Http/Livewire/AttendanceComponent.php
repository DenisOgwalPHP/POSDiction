<?php

namespace App\Http\Livewire;
use Illuminate\Support\Facades\Auth;
use App\Models\AttendanceModel;
use App\Models\BranchModel;
use App\Models\StaffModel;
use Livewire\Component;

class AttendanceComponent extends Component
{
    public $branch;
    public $branches;
    public $slug;
    public $registeredstaff;
    public $selectedStaff = [];
    public function submitstafflist()
    {
        return redirect()->route('Staff-Attendance', ['slug' => $this->branch]);
    }
    public function saveAttendance()
    {
        //dd($this->selectedStudents);
        foreach ($this->selectedStaff as $key => $value) {
            $registeredstaf = StaffModel::find($key);
            $registerattendance = new AttendanceModel();
            $registerattendance->StaffId = $key;
            $registerattendance->Branch = $this->branch;
            $registerattendance->AttendanceDate = now();
            $registerattendance->Presence = $value;
            $registerattendance->save();
        }
        session()->flash('attendancecreate', 'Attendance Saved Successfully');
        return redirect()->route('Staff-Attendance');
    }
    public function mount()
    {
        try {
            $this->branch = request()->query('slug');
            if (Auth::user()->utype == 'General Manager' || Auth::user()->utype == 'Administrator') {
            $this->branches=BranchModel::all(); 
            }else{
                $this->branches=BranchModel::where('id', Auth::user()->Branch)->get();
            }      
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function updatedbranch($value)
    {
        try {
            if($this->branch==""){
                $this->registeredstaff = collect();
            } else {   
            $this->registeredstaff = StaffModel::where('Branch', $this->branch)->orderBy('StaffName', 'ASC')->get();
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
    public function render()
    {
        try {
            if($this->branch==""){
                $this->registeredstaff = collect();
            } else {   
            $this->registeredstaff = StaffModel::where('Branch', $this->branch)->orderBy('StaffName', 'ASC')->get();
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
        return view('livewire.attendance-component', ['registeredstaff' => $this->registeredstaff])->layout('layouts.base');
    }
}
