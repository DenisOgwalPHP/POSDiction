<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\BranchModel;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class AccountCreateComponent extends Component
{
    public $name;
    public $email;
    public $password;
    public $password_confirmation;
    public $usertype;
    public $branch;
    public $branches;
    public function rules()
    {
        return [
            'password' => 'required|min:8|confirmed',
        ];
    }
    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required|min:5',
            'password_confirmation' => 'required|min:5',
            'usertype' => 'required',
            'branch' => 'required',
        ]);
    }
    public function CreateAccount()
    {
        $this->validate([
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required|min:5|confirmed',
            'password_confirmation' => 'required|min:5',
            'usertype' => 'required',
            'branch' => 'required',
        ]);
        try {
            $user = new User();
            $user->name = $this->name;
            $user->email = $this->email;
            $user->password = Hash::make($this->password);
            $user->utype = $this->usertype;
            $user->Branch = $this->branch;
            $user->save();
            session()->flash('accountcreate', 'Account has been created Successfully');
            return redirect()->route('Account-Creation');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
    public function mount()
    {
        $this->branches = BranchModel::all();
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
        return view('livewire.account-create-component', ['registeredAccounts' => $registeredAccounts])->layout('layouts.base');
    }
}
