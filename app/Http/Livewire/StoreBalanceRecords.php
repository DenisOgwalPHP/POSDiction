<?php

namespace App\Http\Livewire;

use App\Models\StoreBalanceModel;
use Livewire\Component;

class StoreBalanceRecords extends Component
{
    public function render()
    {
        try {
            $registeredstorebalance = StoreBalanceModel:: orderByDesc('id')->get();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
        return view('livewire.store-balance-records', ['registeredstorebalance' => $registeredstorebalance])->layout('layouts.base');
    }
}
