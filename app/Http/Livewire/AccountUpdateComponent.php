<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\BranchModel;
use Livewire\Component;

class AccountUpdateComponent extends Component
{
    public $name;
    public $email;
    public $emails;
    public $selectedAccount = [];
    public $usertype;
    public $user_id;
    public $branch;
    public $branches;
    public function mount()
    {
        try {
            $this->emails = User::all();
            $this->branches = BranchModel::all();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
    public function updatedemail($value)
    {
        try {
            $selectedAccount = User::find($value);
            if ($selectedAccount) {
                $this->name = $selectedAccount->name;
                $this->usertype = $selectedAccount->utype;
                $this->user_id = $selectedAccount->id;
                $this->branch = $selectedAccount->Branch;
            } else {
                $this->name = '';
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
    public function UpdateAccount()
    {
        $this->validate([
            'name' => 'required',
            'email' => 'required|unique:users',
            'usertype' => 'required',
            'branch' => 'required',
        ]);
        try {
            $user = User::find($this->user_id);
            $user->name = $this->name;
            $user->utype = $this->usertype;
            $user->Branch = $this->branch;
            $user->save();
            session()->flash('accountupdate', 'Account has been Updated Successfully');
            return redirect()->route('Account-Update');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function render()
    {
        try {
            if (Auth::user()->utype == 'General Manager' || Auth::user()->utype == 'Administrator') {
                $registeredAccounts = User::orderby('id', 'DESC')->get();
            } else {
                $registeredAccounts = User::where('Branch', Auth::user()->Branch)->orderby('id', 'DESC')->get();
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
        return view('livewire.account-update-component', ['registeredAccounts' => $registeredAccounts])->layout('layouts.base');
    }
}
