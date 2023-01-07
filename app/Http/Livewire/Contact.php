<?php

namespace App\Http\Livewire;

use App\Models\Contact as ModelsContact;
use Livewire\Component;

class Contact extends Component
{
    public $name;
    public $email;
    public $body;
    public function render()
    {
        return view('livewire.contact');
    }
    protected $rules = [
        'name' => 'required|min:6',
        'email' => 'required|email',
        'body' => 'required|min:20',
    ];
    public function submit()
    {
        $this->validate();
        $saved = ModelsContact::create([
            'name' => $this->name,
            'email' => $this->email,
            'body' => $this->body,
        ]);
        if ($saved) {
            $this->reset();
            $this->emit('changed');
            session()->flash('message', 'Form submitted successfully.We will contact you soon.');
        }
    }
}
