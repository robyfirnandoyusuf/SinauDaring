<?php

namespace App\Http\Livewire\User;

use App\Models\Soal;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    public function render()
    {
        return view('livewire.user.index');
    }
}
