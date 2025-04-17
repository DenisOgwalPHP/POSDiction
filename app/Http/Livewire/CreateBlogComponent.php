<?php

namespace App\Http\Livewire;
use App\Models\Blog;
use Carbon\Carbon;
use Livewire\Component;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;


class CreateBlogComponent extends Component
{
    use WithFileUploads;
    public $name;
    public $slug;
    public $description;
    public $image;

    public function generateslug()
    {
        $this->slug = Str::slug($this->name, '-');
    }

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'name' => 'required',
            'slug' => 'required|unique:blogs',
            'description' => 'required',
            'image' => 'required',
        ]);
    }

    public function addBlog()
    {
        $this->validate([
            'name' => 'required',
            'slug' => 'required|unique:blogs',
            'description' => 'required',
            'image' => 'required',
        ]);
        try {
            $blog = new Blog();
            $blog->name = $this->name;
            $blog->slug = $this->slug;
             $blog->Posted_by = Auth::user()->id;
            $blog->description = $this->description;
            $blog->Branch = Auth::user()->Branch;
            $imageName = Carbon::now()->timestamp . '.' . $this->image->extension();
            $this->image->storeAs('blogs', $imageName);
            $blog->image = $imageName;
            $blog->save();
            session()->flash('addblog', 'Blog has been created Successfully');
            return redirect()->route('Create-Blog');
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
    public function deleteBlog($id)
    {
        try {
            $category = Blog::find($id);
            $category->delete();
            session()->flash('deleteblog', 'Blog has been deleted successfully');
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
            }else{
                $registeredBlogs = Blog::where('Posted_by',Auth::user()->id)->orderby('id', 'DESC')->get();
            }
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
        return view('livewire.create-blog-component', ['registeredBlogs' => $registeredBlogs])->layout('layouts.base');
    }
}
