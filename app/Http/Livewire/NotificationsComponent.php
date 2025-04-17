<?php

namespace App\Http\Livewire;

use App\Models\NotificationRead;
use App\Models\Notifications;
use Illuminate\Http\Request;
use App\Models\BranchModel;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class NotificationsComponent extends Component
{
    public $PostedFor;
    public $description;
    public $slug;
    public $branch;
    public $branches;
    public function AddNotification()
    {
        $this->validate([
            'PostedFor' => 'required',
            'branch' => 'required',
            'description' => 'required',
        ]);
        try {
            $noti = Notifications::find($this->slug);
            if (!$noti) {
                $noti = new Notifications();
            }
            $noti->PostedBy = Auth::user()->name;
            $noti->PostedUser = Auth::user()->id;
            $noti->PostedFor = $this->PostedFor;
            $noti->Branch=$this->branch;
            $noti->Description = $this->description;
            $noti->save();
            session()->flash('addnotification', 'Notification saved successfully');
            return redirect()->route('Notification');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
    public function deleteNotification($id)
    {
        try {
            $notificationinfo = Notifications::find($id);
            $notificationinfo->delete();
            session()->flash('notificationdelete', 'Notification has been deleted successfully');
            return redirect()->route('Notification');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
    public function mount(Request $request)
    {
        try {
            $this->slug = $request->query('slug');
            $notification = Notifications::find($this->slug);
            $this->branches=BranchModel::all();       
            if ($notification) {
                $this->PostedFor = $notification->PostedFor;
                $this->branch = $notification->Branch;
                $this->description = $notification->Description;
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
    public function render()
    {
        try {
                if (auth()->check()) {
                $registerednotifications = Notifications::whereNotIn('id', function ($query) {
                    $query->select('NotificationID')->from('notificationread');
                })->where(function ($query) {
                    $query->where('PostedUser', Auth::user()->id)->orWhere('PostedFor', 'Staff')->orWhere('PostedFor', 'All');
                })
                    ->orderby('id', 'DESC')->get();
                if ($registerednotifications->count() > 0) {
                    session()->put('notification', 'Thanks, Your message has been sent successfully ');
                }
                foreach ($registerednotifications as $regnot) {
                    $notid = $regnot->id;
                    $readnot = new notificationread();
                    $readnot->PatientID = Auth::user()->id;
                    $readnot->NotificationID = $notid;
                    $readnot->save();
                }
            } else {
                $registerednotifications = Notifications::whereNotIn('id', function ($query) {
                    $query->select('NotificationID')->from('notificationread');
                })->where(function ($query) {
                    $query->Where('PostedFor', 'Staff')->orWhere('PostedFor', 'All');
                })
                    ->orderby('id', 'DESC')->get();
                if ($registerednotifications->count() > 0) {
                    session()->put('notification', 'Thanks, Your message has been sent successfully ');
                }
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
        return view('livewire.notifications-component', ['registerednotifications' => $registerednotifications])->layout('layouts.base');
    }
}
