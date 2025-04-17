<?php

namespace App\Http\Livewire;
use Illuminate\Http\Request;
use App\Models\UnitsModel;
use Livewire\Component;

class CreateUnitsComponent extends Component
{
    public $UnitName;
    public $slug;

    public function AddUnit()
    {
        $this->validate([
            'UnitName' => 'required',
        ]);

        try {
            $registerunit = UnitsModel::findOrNew($this->slug);
            $registerunit ->UnitName= $this->UnitName;
            $registerunit ->save();
            session()->flash('unitregister', 'Unit saved successfully');
            return redirect()->route('Units');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
    public function deleteUnit($id)
    {
        try {
            $unitinfo = UnitsModel::find($id);
            $unitinfo->delete();
            session()->flash('unitdelete', 'Unit has been deleted successfully');
            return redirect()->route('Units');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
     public function mount(Request $request)
    {
        try {
            $this->slug = $request->query('slug');
            $unitlist = UnitsModel::find($this->slug);
            if ($unitlist) {
                $this->UnitName = $unitlist->UnitName;
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function render()
    {
        try {
            $registeredunits = UnitsModel::All();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
        return view('livewire.create-units-component', ['registeredunits' => $registeredunits])->layout('layouts.base');
    }
}
