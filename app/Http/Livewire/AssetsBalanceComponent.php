<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use App\Models\AssetsBalanceModel;
use Livewire\Component;

class AssetsBalanceComponent extends Component
{
    public function render()
    {
        try {
            if (Auth::user()->utype == 'General Manager' || Auth::user()->utype == 'Administrator') {
                $registeredAssetbalance = AssetsBalanceModel::All();
            } else {
                $registeredAssetbalance = AssetsBalanceModel::Where('Branch', Auth::user()->Branch)->get();
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
        return view('livewire.assets-balance-component', ['registeredAssetbalance' => $registeredAssetbalance])->layout('layouts.base');
    }
}
