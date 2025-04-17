<?php

namespace App\Http\Livewire;
use Illuminate\Support\Facades\Auth;
use App\Models\BranchModel;
use App\Models\PaymentMethodModel;
use Illuminate\Http\Request;
use Livewire\Component;

class PaymentMethodComponent extends Component
{
    public $MethodName;
    public $slug;
    public $branches;
    public $branch;
    public function AddMethod()
    {
        $this->validate([
            'MethodName' => 'required',
        ]);

        try {
            $registermethod = PaymentMethodModel::findOrNew($this->slug);
            $registermethod->PaymentMethod= $this->MethodName;
            $registermethod->Branch= $this->branch;
            $registermethod ->save();
            session()->flash('methodregister', 'Payment Method saved successfully');
            return redirect()->route('Payment-Method');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
    public function deleteMethod($id)
    {
        try {
            $paymentmethodinfo = PaymentMethodModel::find($id);
            $paymentmethodinfo->delete();
            session()->flash('methoddelete', 'Payment Method has been deleted successfully');
            return redirect()->route('Payment-Method');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
     public function mount(Request $request)
    {
        try {
            if (Auth::user()->utype == 'General Manager' || Auth::user()->utype == 'Administrator') {
                $this->branches =BranchModel::all();
            } else {
                $this->branches = BranchModel::Where('id', Auth::user()->Branch)->orderBy('id', 'DESC')->get();
            }
            $this->slug = $request->query('slug');
            $methodlist = PaymentMethodModel::find($this->slug);
            if ($methodlist) {
                $this->MethodName = $methodlist->PaymentMethod;
                $this->branch = $methodlist->Branch;
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function render()
    {
        try {
            $registeredmethod = PaymentMethodModel::All();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
        return view('livewire.payment-method-component', ['registeredmethod' => $registeredmethod])->layout('layouts.base');
    }
}
