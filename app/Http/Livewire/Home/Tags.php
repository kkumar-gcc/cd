<?php

namespace App\Http\Livewire\Home;

use App\Models\Tag;
use Livewire\Component;

class Tags extends Component
{
    public function render()
    {
        $tags = Tag::all();
        return view('livewire.home.tags')->with(["tags" => $tags]);
    }
}
