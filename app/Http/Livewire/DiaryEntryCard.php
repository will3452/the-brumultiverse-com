<?php

namespace App\Http\Livewire;

use App\Models\Diary;
use Livewire\Component;

class DiaryEntryCard extends Component
{
    public $item;
    public $showMore;
    public function mount (Diary $item) {
        $this->item = $item;
        $this->showMore = false;
    }
    public function showToggle() {
        $this->showMore = ! $this->showMore;
    }
    public function render()
    {
        return view('livewire.diary-entry-card');
    }
}
