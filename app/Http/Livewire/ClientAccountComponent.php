<?php

namespace App\Http\Livewire;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ClientAccountModel;
use Livewire\Component;

class ClientAccountComponent extends Component
{
    public $AccountName;
    public $AccountName2;
    public $ContactNo;
    public $ContactNo2;
    public $Location;
    public $Village;
    public $District;
    public $Gender;
    public $NIN_Number;
    public $slug;
    public function updated(){
        $this->validate([
           'NIN_Number' => [
                'required',
                Rule::unique('client_accounts', 'TINnumber')->ignore($this->slug), 
            ],
        ]);
    }
    public function AddClientAccount()
    {
        $this->validate([
            'AccountName' => 'required',
            'AccountName2' => 'required',
            'ContactNo' => 'required',
            'Location' => 'required',
            'District' => 'required',
            'Village' => 'required',
            'Gender' => 'required',
            'NIN_Number' => [
                'required',
                Rule::unique('client_accounts', 'TINnumber')->ignore($this->slug), 
            ],
        ]);

        try {
            $registerclientaccount = ClientAccountModel::findOrNew($this->slug);
            $registerclientaccount->AccountName = $this->AccountName;
            $registerclientaccount->AccountName2 = $this->AccountName2;
            $registerclientaccount->ContactNo = $this->ContactNo;
            $registerclientaccount->ContactNo2 = $this->ContactNo2;
            $registerclientaccount->Village = $this->Village;
            $registerclientaccount->District = $this->District;
            $registerclientaccount->Location = $this->Location;
            $registerclientaccount->Description  = "N/A";
            $registerclientaccount->Branch = Auth::user()->Branch;
            $registerclientaccount->TINnumber =  $this->NIN_Number;
            $registerclientaccount->Gender =  $this->Gender;
            $registerclientaccount->save();
            session()->flash('clientaccountregister', 'Client Account saved successfully');
            return redirect()->route('Client-Account');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
    public function deleteClientAccount($id)
    {
        try {
            $clientaccountinfo = ClientAccountModel::find($id);
            $clientaccountinfo->delete();
            session()->flash('clientaccountdelete', 'Client Account has been deleted successfully');
            return redirect()->route('Client-Account');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function mount(Request $request)
    {
        try {
            $this->slug = $request->query('slug');
            $clientaccountlist = ClientAccountModel::find($this->slug);
            if ($clientaccountlist) {
                $this->AccountName = $clientaccountlist->AccountName;
                $this->AccountName2 = $clientaccountlist->AccountName2;
                $this->ContactNo = $clientaccountlist->ContactNo;
                $this->ContactNo2 = $clientaccountlist->ContactNo2;
                $this->Location = $clientaccountlist->Location;
                $this->Village = $clientaccountlist->Village;
                $this->District = $clientaccountlist->District;
                $this->Gender = $clientaccountlist->Gender;
                $this->NIN_Number = $clientaccountlist->TINnumber;
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function render()
    {
        try {
            if (Auth::user()->utype == 'General Manager' || Auth::user()->utype == 'Administrator') {
                $registeredClient = ClientAccountModel::all();
            } else {
                $registeredClient = ClientAccountModel::Where('Branch', Auth::user()->Branch)->orderBy('id', 'DESC')->get();
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
        return view('livewire.client-account-component', ['registeredClient' => $registeredClient])->layout('layouts.base');
    }
}
