<?php

namespace App\Http\Livewire;
use App\Models\TermsAndConditions;
use Livewire\Component;

class TermsAndConditionsComponent extends Component
{
    public $description;
    public function mount()
    {
        try {
            $termsandconditions = TermsAndConditions::find(1);
            if ($termsandconditions) {
                $this->description = $termsandconditions->Description;
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function saveTermsAndConditions()
    {
        try {
            $termsandconditions = TermsAndConditions::find(1);
            if (!$termsandconditions) {
                $termsandconditions = new TermsAndConditions();
            }
            $termsandconditions->Description = $this->description;
            $termsandconditions->save();
            session()->flash('createtandcs', 'Terms and Conditions saved successfully');
            return redirect()->route('Terms-and-Conditions');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
    public function render()
    {
        return view('livewire.terms-and-conditions-component')->layout('layouts.base');
    }
}