<?php

namespace App\Http\Livewire;
use App\Models\Faqs;
use Livewire\Component;

class FAQCreateComponent extends Component
{
    public $description;
    public $isInitialized = false;
    public function mount()
    {
        try {
            $faq = Faqs::find(1);
            if ($faq) {
                $this->description = $faq->Description;
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function saveFaqs()
    {
        try {
            $faqs = Faqs::find(1);
            if (!$faqs) {
                $faqs = new Faqs();
            }
            $faqs->Description = $this->description;
            $faqs->save();
            session()->flash('createfaq', 'FAQs saved successfully');
            return redirect()->route('saveFaqs');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
    public function render()
    {
        return view('livewire.f-a-q-create-component')->layout('layouts.base');
    }
}