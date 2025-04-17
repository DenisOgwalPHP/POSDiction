<?php

namespace App\Http\Livewire;
use Illuminate\Http\Request;
use App\Models\BranchModel;
use Livewire\Component;

class CreateBranchComponent extends Component
{
    public $BranchName;
    public $slug;
    public function AddBranch()
    {
        $this->validate([
            'BranchName' => 'required',
        ]);

        try {
            $registerbranch = BranchModel::findOrNew($this->slug);
            $registerbranch ->BranchName= $this->BranchName;
            $registerbranch ->save();
            session()->flash('branchregister', 'Branch saved successfully');
            return redirect()->route('Branch');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
    public function deleteBranch($id)
    {
        try {
            $branchinfo = BranchModel::find($id);
            $branchinfo->delete();
            session()->flash('branchdelete', 'Branch has been deleted successfully');
            return redirect()->route('Branch');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
     public function mount(Request $request)
    {
        try {
            $this->slug = $request->query('slug');
            $branchlist = BranchModel::find($this->slug);
            if ($branchlist) {
                $this->BranchName = $branchlist->BranchName;
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
    public function render()
    {
        try {
            $registeredbranches = BranchModel::All();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
        return view('livewire.create-branch-component', ['registeredbranches' => $registeredbranches])->layout('layouts.base');
    }
}
