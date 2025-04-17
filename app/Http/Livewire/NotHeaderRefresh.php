<?php

namespace App\Http\Livewire;
use App\Models\Chat;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class NotHeaderRefresh extends Component
{
    public function pollnewchats()
    {
        // Perform the necessary logic to retrieve the updated statement value
       $newchats = Chat::with('recieveraccount','senderaccount')->where('ReceiverID',Auth::user()->id)->where('Status','Not Seen')->get();
    }
    public function render()
    {
         $newchats = Chat::with('recieveraccount','senderaccount')->where('ReceiverID',Auth::user()->id)->where('Status','Not Seen')->get();
        return view('livewire.not-header-refresh', ['newchats' => $newchats]);
    }
}
