<?php

namespace App\Http\Livewire;
use Illuminate\Support\Facades\Auth;
use App\Models\Notifications;
use App\Models\NotificationRead;
use Livewire\Component;

class NoteHeaderRefresh extends Component
{
    public function pollnotifications()
    {
        try {
            if (auth()->check()) {
                $registeredNotifications = Notifications::whereNotIn('id', function ($query) {
                    $query->select('NotificationID')->from('notificationread');
                })->where(function ($query) {
                    $query->where('PostedUser', Auth::user()->id)->orWhere('PostedFor', 'Staff')->orWhere('PostedFor', 'All');
                })
                    ->orderby('id', 'DESC')->get();
                if ($registeredNotifications->count() > 0) {
                    session()->flash('notification', 'Thanks, Your message has been sent successfully ');
                }
            } else {
                $registeredNotifications = Notifications::whereNotIn('id', function ($query) {
                    $query->select('NotificationID')->from('notificationread');
                })->where(function ($query) {
                    $query->Where('PostedFor', 'Staff')->orWhere('PostedFor', 'All'); })
                    ->orderby('id', 'DESC')->get();
                if ($registeredNotifications->count() > 0) {
                    session()->flash('notification', 'Thanks, Your message has been sent successfully ');
                }
            }
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
    public function render()
    {
        try {
            if (auth()->check()) {
                $registeredNotifications = Notifications::whereNotIn('id', function ($query) {
                    $query->select('NotificationID')->from('notificationread');
                })->where(function ($query) {
                    $query->where('PostedUser', Auth::user()->id)->orWhere('PostedFor', 'Staff')->orWhere('PostedFor', 'All');
                })
                    ->orderby('id', 'DESC')->get();
                if ($registeredNotifications->count() > 0) {
                    session()->flash('notification', 'Thanks, Your message has been sent successfully ');
                }
            } else {
                $registeredNotifications = Notifications::whereNotIn('id', function ($query) {
                    $query->select('NotificationID')->from('notificationread');
                })->where(function ($query) {
                    $query->Where('PostedFor', 'Staff')->orWhere('PostedFor', 'All'); })
                    ->orderby('id', 'DESC')->get();
                if ($registeredNotifications->count() > 0) {
                    session()->flash('notification', 'Thanks, Your message has been sent successfully ');
                }
            }
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
        return view('livewire.note-header-refresh', ['registeredNotifications' => $registeredNotifications]);
    }
}
