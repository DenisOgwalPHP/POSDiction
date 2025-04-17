<?php

namespace App\Http\Livewire;
use App\Models\Documentation;
use Livewire\Component;
use Carbon\Carbon;
use Livewire\WithFileUploads;

class DocumentationComponent extends Component
{
    use WithFileUploads;
    public $description;
    public $description1;
    public $attachment1;
    public $attachment;
    public function mount()
    {
        try {
            $documentation = Documentation::find(1);
            if ($documentation) {
                $this->description = $documentation->Description;
                $this->description1 = $documentation->Description1;
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
    public function saveDocumentation()
    {
        $this->validate([

            'attachment' => 'required',
            'attachment1' => 'required',
        ]);
        try {
            $documentation = Documentation::find(1);
            if (!$documentation) {
                $documentation = new Documentation();
            }
            $documentation->Description = $this->description;
            $documentation->Description1 = $this->description1;

            $AttachmentName = 'DashboardAttachment' . '.' . $this->attachment->extension();
            $this->attachment->storeAs('Documentation', $AttachmentName);
            $documentation->attachment = $AttachmentName;

            $AttachmentName1 = 'AppAttachment' . '.' . $this->attachment1->extension();
            $this->attachment1->storeAs('Documentation', $AttachmentName1);
            $documentation->attachment1 = $AttachmentName1;
            $documentation->save();
            session()->flash('createdocumentation', 'Documentation saved successfully');
            return redirect()->route('Documentation');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
    public function render()
    {
        return view('livewire.documentation-component')->layout('layouts.base');
    }
}