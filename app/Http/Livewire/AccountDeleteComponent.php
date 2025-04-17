<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AccountDeleteComponent extends Component
{

     public function deleteAccount($id)
     {
          try {
               $user = User::find($id);
               $user->delete();
               session()->flash('accountdelete', 'Account has been deleted successfully');
               return redirect()->route('Account-Delete');
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
          return view('livewire.account-delete-component', ['registeredAccounts' => $registeredAccounts])->layout('layouts.base');
     }
}
