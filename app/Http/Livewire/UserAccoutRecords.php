<?php

namespace App\Http\Livewire;
use App\Models\User;
use Livewire\Component;

class UserAccoutRecords extends Component
{
  public function UpdateAccout($id){
        try{
        $usr = User::find($id);
        $usr->email_verified_at = now();
        $usr->save();
        session()->flash('patusrupdate', 'User Account has been updated successfully');
         return redirect()->route('User-Account-Records');
          } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
    public function render()
    {
        try{
        $registeredAccounts = User::orderby('id','DESC')->get();
         } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
        return view('livewire.user-accout-records',['registeredAccounts' =>  $registeredAccounts])->layout('layouts.base');
    }
}
