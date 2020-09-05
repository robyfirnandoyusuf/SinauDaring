<?php

namespace App\Http\Livewire\User\Soal;

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
            'token' => $this->genCode(),
            'jenis_soal' => $this->jenis_soal,
            'matpel_id' => $this->matpel_id,
        ]);

        //flash message
        session()->flash('message', 'success|Data Berhasil Disimpan.');

        //redirect
        return redirect()->route('user.soal.index');

    }

    public function genCode($length=7)
    {
        mt_srand((double)microtime()*10000);
        $charid = md5(uniqid(rand(), true));
        $c = unpack("C*",$charid);
        $c = implode("",$c);

        return substr($c,0,$length);
    }

    public function render()
    {
    	$data['matpels'] = Matpel::all();
        return view('livewire.user.soal.create',$data);
    }
}
