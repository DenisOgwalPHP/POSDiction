<?php

namespace App\Http\Livewire;
use App\Models\ClientAccountModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Livewire\Component;

class ClientRecords extends Component
{
    public $datefrom;
    public $dateto;

    public function mount(Request $request)
    {
        $this->datefrom = $request->slug;
        $this->dateto = $request->slug2;
    }
    public function updateddateto()
    {
        $this->validate([
            'datefrom' => 'required',
        ]);
        if ($this->dateto != null) {
            return redirect()->route('Client-Records', ['slug' => $this->datefrom, 'slug2' => $this->dateto]);
        }
    }
    public function render()
    {
        try {
            if ($this->dateto == null) {
                if (Auth::user()->utype == 'General Manager' || Auth::user()->utype == 'Administrator') {
                    $registeredClients = ClientAccountModel::all();
                } else {
                    $registeredClients = ClientAccountModel::Where('Branch', Auth::user()->Branch)->get();
                }
            } else {
                if (Auth::user()->utype == 'General Manager' || Auth::user()->utype == 'Administrator') {
                    $registeredClients = ClientAccountModel::whereDate('created_at', '>=', $this->datefrom)->WhereDate('created_at', '<=', $this->dateto)->get();
                } else {
                    $registeredClients= ClientAccountModel::whereDate('created_at', '>=', $this->datefrom)->WhereDate('created_at', '<=', $this->dateto)->Where('Branch', Auth::user()->Branch)->get();
                }
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
        return view('livewire.client-records', ['registeredClients' => $registeredClients])->layout('layouts.base');
    }
}
