<?php

namespace App\Http\Livewire;

use App\Models\Blog;
use Livewire\Component;

class Search extends Component
{
    public $query;
    public $suggestions = [];
    public function render()
    {
        if ($this->query) {
            $this->suggestions = Blog::query()
                ->where('title', 'LIKE', "%{$this->query}%")
                ->orWhere('body', 'LIKE', "%{$this->query}%")
                ->published()->take(10)->get();
        }
        return view('livewire.search');
    }
}
