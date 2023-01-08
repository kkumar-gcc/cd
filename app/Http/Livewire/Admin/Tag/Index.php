<?php

namespace App\Http\Livewire\Admin\Tag;

use App\Models\Tag;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class Index extends Component
{
    use WithPagination;
    use WithFileUploads;
    use AuthorizesRequests;
    public $title;
    public $description;
    public $color;
    public $tag_id;
    public $coverImage;
    public $editTag;
    protected $rules = [
        'title' => ['required', 'min:3'],
        'color' => ['required']
    ];

    public function render()
    {
        $tags = Tag::paginate(20);
        return view('livewire.admin.tag.index')->with(["tags" => $tags]);
    }

    public function edit(Tag $tag)
    {
        $this->authorize('update', $tag);
        $this->title = $tag->title;
        $this->description = $tag->description();
        $this->color = $tag->color;
        $this->tag_id = $tag->id;
        $this->emit('editTag');
    }

    public function deleteConfirm(Tag $tag)
    {
        $this->authorize('delete', $tag);
        $this->title = $tag->title;
        $this->tag_id = $tag->id;
        $this->emit('deleteTag');
    }
    public function update(Tag $tag)
    {
        $this->authorize('update', $tag);
        $this->validate();
        $tag->title = $this->title;
        $tag->description = $this->description;
        if ($this->coverImage) {
            $tag->cover_image = $this->coverImage->storeOnCloudinary()->getSecurePath();
        }
        $tag->color=$this->color;
        $tag->save();
        $this->reset(['title', 'tag_id', 'color', 'description', 'coverImage']);
        $this->emit('closeModal');
    }
    public function delete(Tag $tag)
    {
        $this->authorize('delete', $tag);
        $tag->delete();
        $this->reset(['title', 'tag_id', 'color', 'description', 'coverImage']);
        $this->emit('closeModal');
    }
    public function store()
    {
        $this->authorize('create', Tag::class);
        $this->validate();
        Tag::create([
            "title" => $this->title,
            "description" => $this->description,
            "color" => $this->color
        ]);
        $this->emit('closeModal');
    }
}
