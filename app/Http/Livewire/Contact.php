<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Contact extends Component
{
    public $name;
    public $email;
    public $message;
    public function render()
    {
        return view('livewire.contact');
    }
    // protected $rules = [
    // ];
    protected $rules = [
        'name' => 'required|min:6',
        'email' => 'required|email',
        'message' => 'required|min:20',
    ];
    public function submit()
    {
        $this->validate();
        // $this->blog->access = $this->blog_access;
        // $this->blog->comment_access = $this->comment_access;
        // $this->blog->adult_warning = $this->adult_warning;
        // $this->blog->age_confirmation = $this->age_confirmation;
        // $this->blog->featured=$this->featured;
        // if ($saved) {
        $this->reset();
        $this->emit('changed');
        session()->flash('message', 'Form submitted successfully.We will contact you soon.');
        // }
    }
}
