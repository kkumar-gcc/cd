<?php

namespace App\Http\Livewire\Blogs;

use App\Models\Blog;
use Livewire\Component;

class Related extends Component
{
    protected $blog;
    public function mount(Blog $blog)
    {
        $this->blog = $blog;
    }
    public function render()
    {
        $blog = $this->blog;
        $related = Blog::published()
            ->with(['user', 'tags', 'blogviews'])
            ->whereHas('tags', function ($query) use ($blog) {
                $query->whereIn('title', $blog->tags->pluck('title'));
            }, '>=', count($this->blog->tags->pluck('title')))
            ->where("id", "!=", $blog->id)
            ->limit(5)
            ->withCount('tags')
            ->get();
        if (count($related) < 1) {
            $related = Blog::published()->view()->limit(5)
                ->get();
        }
        return view('livewire.blogs.related')->with(["related" => $related]);
    }
}
