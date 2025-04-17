<?php

namespace App\Http\Livewire;
use App\Models\Setting;
use App\Models\BranchModel;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ContactSettingCreateComponent extends Component
{
    public $email;
    public $phone;
    public $phone2;
    public $address;
    public $twitter;
    public $instagram;
    public $facebook;
    public $linkedIn;
    public $youtube;
    public $branch;
    public $branches;
     public function mount(){
        $this->branches=BranchModel::all();
        $setting = Setting::where('Branch',Auth::User()->Branch)->first();
        if($setting){
            $this->email = $setting->email;
            $this->phone = $setting->phone;
            $this->phone2 = $setting->phone2;
            $this->address = $setting->address;
            $this->twitter = $setting->twitter;
            $this->instagram = $setting->instagram;
            $this->facebook = $setting->facebook;
            $this->linkedIn = $setting->linkedIn;
            $this->youtube = $setting->youtube;
            $this->branch = $setting->Branch;
        }
    }
     public function updated($fields){
        $this->validateOnly($fields,[
            'email' => 'required',
            'phone' => 'required',
            'address' => 'required'
        ]);
    }

    public function saveSettings(){
        $this->validate([
            'email' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'branch' => 'required'
        ]);
       
        $setting = new Setting();
        $setting->email = $this->email;
        $setting->phone = $this->phone;
        $setting->phone2 = $this->phone2;
        $setting->address = $this->address;
        $setting->twitter = $this->twitter;
        $setting->instagram = $this->instagram;
        $setting->facebook = $this->facebook;
        $setting->linkedIn = $this->linkedIn;
        $setting->youtube = $this->youtube;
        $setting->youtube = $this->youtube;
        $setting->Branch = $this->branch;
        $setting->save();
        session()->flash('createcontact', 'Settings saved successfully');
        return redirect()->route('Contact-Settings');


    }
    public function render()
    {
        return view('livewire.contact-setting-create-component')->layout('layouts.base');
    }
}