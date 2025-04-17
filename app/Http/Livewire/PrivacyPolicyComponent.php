<?php

namespace App\Http\Livewire;
use App\Models\PrivacyPolicy;
use Livewire\Component;

class PrivacyPolicyComponent extends Component
{
    public $description;
    public function mount()
    {
        try {
            $privacypolicy = PrivacyPolicy::find(1);
            if ($privacypolicy) {
                $this->description = $privacypolicy->Description;
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function savePrivacyPolicy()
    {
        try {
            $privacypolicy = PrivacyPolicy::find(1);
            if (!$privacypolicy) {
                $privacypolicy = new PrivacyPolicy();
            }
            $privacypolicy->Description = $this->description;
            $privacypolicy->save();
            session()->flash('createprivacypolicy', 'Privacy Policy saved successfully');
            return redirect()->route('Privacy-Policy');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
    public function render()
    {
        return view('livewire.privacy-policy-component')->layout('layouts.base');
    }
}