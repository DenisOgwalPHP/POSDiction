<?php

namespace App\Http\Livewire;
use Illuminate\Http\Request;
use App\Models\PricePercentageModel;
use Livewire\Component;

class PriceSettingPercentage extends Component
{
    public $slug;
    public $Percentage;
    public function AddPercentage()
    {
        $this->validate([
            'Percentage' => 'required',
        ]);

        try {
            $registerpercentage = PricePercentageModel::findOrNew($this->slug);
            $registerpercentage->Percentage= $this->Percentage;
            $registerpercentage ->save();
            session()->flash('percentageregister', 'Price Percentage saved successfully');
            return redirect()->route('Price-Percentage');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
    public function deletePercentage($id)
    {
        try {
            $percentageinfo = PricePercentageModel::find($id);
            $percentageinfo->delete();
            session()->flash('percentagedelete', 'Price Percentage has been deleted successfully');
            return redirect()->route('Price-Percentage');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
     public function mount(Request $request)
    {
        try {
            $this->slug = $request->query('slug');
            $percentagelist = PricePercentageModel::find($this->slug);
            if ($percentagelist) {
                $this->Percentage = $percentagelist->Percentage;
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function render()
    {
        try {
            $registeredpercentage = PricePercentageModel::All();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
        return view('livewire.price-setting-percentage', ['registeredpercentage' => $registeredpercentage])->layout('layouts.base');
    }
}
