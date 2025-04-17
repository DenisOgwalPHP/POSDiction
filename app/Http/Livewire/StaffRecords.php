<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use App\Models\StaffModel;
use Livewire\Component;

class StaffRecords extends Component
{
    public function render()
    {
        try {
            if (Auth::user()->utype == 'General Manager' || Auth::user()->utype == 'Administrator') {
                $registeredstaffs = StaffModel::All();
            } else {
                $registeredstaffs = StaffModel::Where('Branch', Auth::user()->Branch)->orderBy('id', 'DESC')->get();
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
        return view('livewire.staff-records', ['registeredstaffs' => $registeredstaffs])->layout('layouts.base');
    }
}
