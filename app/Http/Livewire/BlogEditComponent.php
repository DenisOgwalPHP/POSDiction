<?php

namespace App\Http\Livewire;
use App\Models\Blog;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class BlogEditComponent extends Component
{
    use WithFileUploads;
    public $name;
    public $slug;
    public $description;
    public $image;
    public $newImage;
    public $blog_id;
    public function mount($blog_slug)
    {
        try {
            $blog = Blog::where('slug', $blog_slug)->first();
            $this->name = $blog->name;
            $this->slug = $blog->slug;
            $this->description = $blog->description;
            $this->image = $blog->image;
            $this->blog_id = $blog->id;
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function generateslug()
    {
        $this->slug = Str::slug($this->name, '-');
    }
    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'name' => 'required',
            'slug' => 'required',
            'description' => 'required',
        ]);
    }

    public function updateBlog()
    {
        $this->validate([
            'name' => 'required',
            'slug' => 'required',
            'description' => 'required',
        ]);
        try {
            $blog = Blog::find($this->blog_id);
            $blog->name = $this->name;
            $blog->slug = $this->slug;
            $blog->description = $this->description;
            if ($this->newImage) {
                $imageName = Carbon::now()->timestamp . '.' . $this->newImage->extension();
                $this->newImage->storeAs('blogs', $imageName);
                $blog->image = $imageName;
            }
            $blog->save();
            session()->flash('editblogs', 'Blog has been Edited Successfully');
            return redirect()->route('Create-Blog');
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
    public function render()
    {
        try {
            if (Auth::user()->utype == "Administrator") {
                $registeredBlogs = Blog::orderby('id', 'DESC')->get();
            } else {
                $registeredBlogs = Blog::where('Posted_by', Auth::user()->id)->orderby('id', 'DESC')->get();
            }
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
        return view('livewire.blog-edit-component', ['registeredBlogs' => $registeredBlogs])->layout('layouts.base');
    }
}
