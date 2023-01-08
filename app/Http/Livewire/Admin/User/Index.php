<?php

namespace App\Http\Livewire\Admin\User;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Password;

class Index extends Component
{
    use WithPagination;
    public $username;
    public $email;
    protected $listeners = ['userUpdated' => '$refresh'];

    public function render()
    {
        $users = User::paginate(20);
        return view('livewire.admin.user.index')->with(["users" => $users]);
    }
    protected $rules = [
        'username' => ['required', 'min:3'],
        'email' => ['required', 'email'],
    ];
    public function store()
    {
        if (!auth()->user()->can('create users')) {
            return abort(404);
        }
        $this->validate();
        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->password = Hash::make(Str::random(10));
        $status = $user->save();
        $user->assignRole('writer');
        Password::sendResetLink(array("email" => $this->email));
        if ($status) {
            $this->reset();
            $this->emit('closeModal');
        }
    }
}
