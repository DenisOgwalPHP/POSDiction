<?php

namespace App\Http\Livewire;

use App\Models\Documentation;
use Livewire\Component;

class DashboardDocumentationComponent extends Component
{
    public function render()
    {
        try {
            $dashboarddocumentation = Documentation::all();
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
        return view('livewire.dashboard-documentation-component', ['dashboarddocumentation' => $dashboarddocumentation])->layout('layouts.base');
    }
}
