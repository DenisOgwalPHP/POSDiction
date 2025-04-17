<?php

namespace App\Http\Livewire;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;
use Livewire\Component;

class UpdateUserProfile extends Component
{
   use WithFileUploads;
   public $email;
   public $name;
   public $newImage;
   public function mount()
   {
      try {
         $this->name = Auth::user()->name;
         $this->email = Auth::user()->email;
      } catch (\Exception $e) {
         dd($e->getMessage());
         return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
      }
   }
   public function updatednewImage()
   {
      try {
         $user = User::find(Auth::user()->id);
         $user->profile_photo_path = Auth::user()->id . '.' . $this->newImage->extension();
         $profilepic = Auth::user()->id . '.' . $this->newImage->extension();
         $this->newImage->storeAs('ProfilePics', $profilepic);
         $user->save();
         session()->flash('accountupdate', 'Account has been Updated Successfully');
         return redirect()->route('Profile-Update');
      } catch (\Exception $e) {
         dd($e->getMessage());
         return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
      }
   }
   public function UpdateAccount()
   {
      try {
         $user = User::find(Auth::user()->id);
         $user->name = $this->name;
         $user->email = $this->email;
         $user->save();
         session()->flash('accountupdate', 'Account has been Updated Successfully');
         return redirect()->route('Profile-Update');
      } catch (\Exception $e) {
         dd($e->getMessage());
         return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
      }
   }
   public function render()
   {
      try {
         $registeredAccounts = User::whereNotIn('utype', ['Patient'])->orderby('id', 'DESC')->get();
      } catch (\Exception $e) {
         dd($e->getMessage());
         return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
      }
      return view('livewire.update-user-profile', ['registeredAccounts' => $registeredAccounts])->layout('layouts.base');
   }
}
