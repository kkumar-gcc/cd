<?php

namespace App\Http\Livewire\Profile;

use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;

class EditProfile extends Component
{
    use WithFileUploads;
    public $username;
    public $location;
    public $firstName;
    public $lastName;
    public $shortBio;
    public $aboutMe;
    public $websiteUrl;
    public $profileImage;
    public $backgroundImage;
    public function mount()
    {
        $user = auth()->user();
        $this->username = $user->username();
        $this->location = $user->location;
        $this->firstName = $user->firstName();
        $this->lastName = $user->lastName();
        $this->shortBio = $user->shortBio();
        $this->aboutMe = $user->aboutMe();
        $this->websiteUrl = $user->websiteUrl();
    }
    public function render()
    {
        return view('livewire.profile.edit-profile');
    }
    protected $rules = [
        "username" => 'required',
        "shortBio" => "required|min:20|max:300"
    ];
    public function update()
    {
        $this->validate();
        $user = User::find(auth()->user()->id);
        if ($this->profileImage) {
            $user->profile_image = $this->profileImage->storeOnCloudinary()->getSecurePath();
        }
        if ($this->backgroundImage) {
            $user->background_image = $this->backgroundImage->storeOnCloudinary()->getSecurePath();
        }
        $user->first_name = $this->firstName;
        $user->last_name = $this->lastName;
        $user->about_me = $this->aboutMe;
        $user->short_bio = $this->shortBio;
        $user->portfolio_url = $this->websiteUrl;
        $saved = $user->save();
        if ($saved) {
            $this->emit('changed');
            session()->flash('message', 'profile updated successfully');
        }
    }
}
