<?php

namespace App\Http\Livewire\Home;

use App\Models\Blog;
use Livewire\Component;

class Featured extends Component
{
    public function render()
    {
        $blogs =Blog::published()->featured()->view()->take(3)->get();
        return view('livewire.home.featured')->with(["featuredBlogs"=>$blogs]);
    }
}
