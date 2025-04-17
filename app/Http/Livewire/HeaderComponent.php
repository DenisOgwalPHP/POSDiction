<?php

namespace App\Http\Livewire;
use App\Models\Chat;
use App\Models\Events;
use App\Models\Permissions;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class HeaderComponent extends Component
{
    public $search;
    public $slug;
    public function MakeSearch()
    {
        try {
            session()->flash('searchcase', 'Product Information Displayed successfully');
            return redirect()->route('Simple-Search', ['slug' => $this->search]);
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
    public function render()
    {
        try {
            $accessset = Permissions::where("UserGroup", Auth::user()->utype)->where("Branch", Auth::user()->Branch)->first();
            $eventcount=Events::where('Branch', Auth::user()->Branch)->count();
            if ($accessset) {
                $accesssetting = Permissions::where("UserGroup", Auth::user()->utype)->where("Branch", Auth::user()->Branch)->get();
            } else {
                $accesssetting = collect();
            }
            $newchats = Chat::with('recieveraccount', 'senderaccount')->where('ReceiverID', Auth::user()->id)->where('Status', 'Not Seen')->get();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
        return view('livewire.header-component', ['eventcount'=>$eventcount,'accesssetting' => $accesssetting, 'newchats' => $newchats]);
    }
}
