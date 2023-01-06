<?php

namespace App\Http\Livewire;

use App\Models\Blog;
use Livewire\Component;

class TopBlogs extends Component
{
    public $blogs;
    public function mount()
    {
        $this->blogs =Blog::select(['id', 'title','body','cover_image','slug','created_at'])->published()->view()->limit(5)->get();
    }
    public function render()
    {
        return view('livewire.top-blogs',["topBlogs"=>$this->blogs]);
    }
}
