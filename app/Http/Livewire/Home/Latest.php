<?php

namespace App\Http\Livewire\Home;

use App\Models\Blog;
use Livewire\Component;

class Latest extends Component
{
    public function render()
    {
        $blogs =Blog::published()->recent()->take(6)->get();
        return view('livewire.home.latest')->with(["blogs"=>$blogs]);
    }
}
