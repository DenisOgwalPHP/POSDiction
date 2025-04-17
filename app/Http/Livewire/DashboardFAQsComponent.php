<?php

namespace App\Http\Livewire;
use App\Models\Faqs;
use Livewire\Component;

class DashboardFAQsComponent extends Component
{
    public function render()
    {
        try {
            $faqs = Faqs::all();
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
        return view('livewire.dashboard-f-a-qs-component', ['faqs' => $faqs])->layout('layouts.base');
    }
}
