<?php

namespace App\Http\Livewire;
use App\Models\Setting;
use Livewire\Component;

class ContactPageComponent extends Component
{
    public function render()
    {
        try {
            $contacts = Setting::find(1);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
        return view('livewire.contact-page-component', ['contacts' => $contacts])->layout('layouts.base');
    }
}
