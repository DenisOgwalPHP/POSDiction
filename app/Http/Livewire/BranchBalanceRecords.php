<?php

namespace App\Http\Livewire;
use Illuminate\Support\Facades\Auth;
use App\Models\BranchModel;
use App\Models\BranchBalanceModel;
use Illuminate\Http\Request;
use Livewire\Component;

class BranchBalanceRecords extends Component
{
    public $branch;
    public $branchto;
    public $branches;
    public $slug;
    public function mount(Request $request)
    {
        if($request->slug){
            $this->branchto=$request->slug;
            $branches=BranchModel::where('id',$request->slug)->first();
            $this->branch=$branches->BranchName;
            
        }else{
            $branches=BranchModel::where('id',Auth::user()->Branch)->first();
            $this->branch=$branches->BranchName;
        }   
        if (Auth::user()->utype == 'General Manager' || Auth::user()->utype == 'Administrator') {
            $this->branches = BranchModel::all();
        } else {
            $this->branches = BranchModel::where('id', Auth::user()->Branch)->get();
        }
    }
    public function updatedbranchto()
    {
        $this->validate([
            'branchto' => 'required',
        ]);
        if ($this->branchto != null) {
            return redirect()->route('Branch-Balance-Records', ['slug' => $this->branchto]);
        }
    }
    public function render()
    {
        try {
            if ($this->branchto == null) {
            $registeredbranchbalance = BranchBalanceModel:: where('Branch', Auth::user()->Branch)->orderByDesc('id')->get();
            }else{
            $registeredbranchbalance = BranchBalanceModel:: where('Branch',  $this->branchto)->orderByDesc('id')->get();  
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
        return view('livewire.branch-balance-records', ['registeredbranchbalance' => $registeredbranchbalance])->layout('layouts.base');
    }
}
