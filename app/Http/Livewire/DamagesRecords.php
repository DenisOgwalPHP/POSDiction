<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\DamagesModel;
use Livewire\Component;

class DamagesRecords extends Component
{
    public $datefrom;
    public $dateto;
    public function updateddateto()
    {
        $this->validate([
            'datefrom' => 'required',
        ]);
        if ($this->dateto != null) {
            return redirect()->route('Damages-Records', ['slug' => $this->datefrom, 'slug2' => $this->dateto]);
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
                    $registereddamages = DamagesModel::all();
                } else {
                    $registereddamages = DamagesModel::Where('Branch', Auth::user()->Branch)->orderByDesc('id')->get();
                }
            } else {
                if (Auth::user()->utype == 'General Manager' || Auth::user()->utype == 'Administrator') {
                    $registereddamages = DamagesModel::whereDate('created_at', '>=', $this->datefrom)->WhereDate('created_at', '<=', $this->dateto)->get();
                } else {
                    $registereddamages = DamagesModel::whereDate('created_at', '>=', $this->datefrom)->WhereDate('created_at', '<=', $this->dateto)->Where('Branch', Auth::user()->Branch)->orderByDesc('id')->get();
                }
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
        return view('livewire.damages-records', ['registereddamages' => $registereddamages])->layout('layouts.base');
    }
}
