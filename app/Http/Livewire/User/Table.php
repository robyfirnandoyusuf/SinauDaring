<?php

namespace App\Http\Livewire\User;

use Livewire\Component;
use Livewire\WithPagination;
use \App\Models\Soal;

class Table extends Component
{
    use WithPagination;

    public $perPage = 10;
    public $sortField = 'id';
    public $sortAsc = true;
    public $search = '';

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortAsc = ! $this->sortAsc;
        } else {
            $this->sortAsc = true;
        }

        $this->sortField = $field;
    }

    public function render()
    {
        $soal = new Soal;
        $soal = $soal->with(['matpel']);
        
        if (!empty($this->search)) 
        {
            $soal = $soal->where('kode','like',$this->search);
        }
        $soal = $soal->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')->paginate($this->perPage);
        $data['soals'] = $soal;

        return view('livewire.user.table', $data);
    }
}
