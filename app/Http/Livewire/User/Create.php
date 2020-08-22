<?php

namespace App\Http\Livewire\User;

use Livewire\Component;
use App\Models\Matpel;
use App\Models\Soal;

class Create extends Component
{
    public $kode,$jenis_soal,$matpel_id;

	/**
     * store function
     */
    public function store()
    {
        $this->validate([
            'kode'=>'required',
            'jenis_soal'=>'required',
            'matpel_id'=>'required',
        ]);

        $post = Soal::create([
            'kode' => $this->kode,
            'jenis_soal' => $this->jenis_soal,
            'matpel_id' => $this->matpel_id,
        ]);

        //flash message
        session()->flash('message', 'success|Data Berhasil Disimpan.');

        //redirect
        return redirect()->route('user.soal.index');

    }

    public function render()
    {
    	$data['matpels'] = Matpel::all();
        return view('livewire.user.create',$data);
    }
}
