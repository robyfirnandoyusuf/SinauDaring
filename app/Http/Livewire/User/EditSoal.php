<?php

namespace App\Http\Livewire\User;
use Illuminate\Http\Request;
use Livewire\Component;

class EditSoal extends Component
{
	public function update($request)
	{
		dd(1);
	}

    public function render()
    {
        return view('livewire.user.edit-soal');
    }
}
