<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\DistributionModel;
use Livewire\Component;

class DistributionRecords extends Component
{

    public $datefrom;
    public $dateto;
    public function updateddateto()
    {
        $this->validate([
            'datefrom' => 'required',
        ]);
        if ($this->dateto != null) {
            return redirect()->route('Distribution-Records', ['slug' => $this->datefrom, 'slug2' => $this->dateto]);
        }
    }
    public function mount(Request $request)
    {
        $this->datefrom = $request->slug;
        $this->dateto = $request->slug2;
    }

    public function render()
    {
        try {
            if ($this->dateto == null) {
                if (Auth::user()->utype == 'General Manager' || Auth::user()->utype == 'Administrator') {
                    $registereddistribution = DistributionModel::all();
                } else {
                    $registereddistribution = DistributionModel::Where('Branch', Auth::user()->Branch)->get();
                }
            } else {
                if (Auth::user()->utype == 'General Manager' || Auth::user()->utype == 'Administrator') {
                    $registereddistribution = DistributionModel::whereDate('DistributionDate', '>=', $this->datefrom)->WhereDate('DistributionDate', '<=', $this->dateto)->get();
                } else {
                    $registereddistribution = DistributionModel::whereDate('DistributionDate', '>=', $this->datefrom)->WhereDate('DistributionDate', '<=', $this->dateto)->Where('Branch', Auth::user()->Branch)->get();
                }
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
        return view('livewire.distribution-records', ['registereddistribution' => $registereddistribution])->layout('layouts.base');
    }
}
