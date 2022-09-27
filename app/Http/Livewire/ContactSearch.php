<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class ContactSearch extends Component
{
    public $searchText;
    public $searchResults;
    public $isSearch;
    public function mount () {
        $this->searchText = "";
        $this->searchResults = [];
        $this->isSearch = false;
    }

    public function addFriend(User $user) {
        auth()->user()->befriend($user);
    }

    public function search () {
        $this->isSearch = true;
        $this->searchResults = User::whereHas('interest')->where('first_name', 'LIKE', '%'.$this->searchText.'%')->get();
    }

    public function render()
    {
        return view('livewire.contact-search');
    }
}
