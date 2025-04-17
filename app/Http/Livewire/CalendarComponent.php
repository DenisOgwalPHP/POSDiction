<?php

namespace App\Http\Livewire;
use App\Models\Events;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
class CalendarComponent extends Component
{
    public $EventTitle;
    public $description;
    public $eventcolor;
    public $eventdate;
    public $eventlength;
    public function CreateEvent()
    {
        $this->validate([
            'EventTitle' => 'required',
            'description' => 'required',
            'eventcolor' => 'required',
            'eventdate' => 'required',
            'eventlength' => 'required',
        ]);
        try {
            $event = new Events();
            $event->EventName = $this->EventTitle;
            $event->EventColor = $this->eventcolor;
            $event->EventDate = $this->eventdate;
            $event->EventLength = $this->eventlength;
            $event->Description = $this->description;
            $event->User_id = Auth::user()->id;
            $event->Branch =  Auth::user()->Branch;
            $event->save();
            session()->flash('eventcreate', 'Event has been posted Successfully');
            return redirect()->route('Calendar-Component');
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function render()
    {
        try {
            $events = Events::where('Branch',Auth::user()->Branch)->get();
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
        return view('livewire.calendar-component', ['events' => $events])->layout('layouts.base');
    }
}
