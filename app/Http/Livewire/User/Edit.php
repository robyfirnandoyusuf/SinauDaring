<?php

namespace App\Http\Livewire\User;

use Livewire\Component;
use App\Models\Matpel;
use App\Models\Soal;

class Edit extends Component
{
	public $kode,$jenis_soal,$matpel_id;

	public function mount($kode)
    {
		$soal = Soal::where('kode',$kode)->first();
		if (!$soal) abort(404);
		$this->kode  		= $kode;
        $this->jenis_soal 	= $soal->jenis_soal;
        $this->matpel_id 	= $soal->matpel_id;
    }

	public function update()
	{
		$soal = Soal::where('kode',$this->kode);
		$check = $soal->count();

		if ($check <= 0) abort(404);

		try {
			$update = $soal->update([
				'kode'=>$this->kode,
				'jenis_soal' =>$this->jenis_soal,
				'matpel_id'=>$this->matpel_id
			]);
		} catch (Exception $e) {
	        session()->flash('message', 'error|Data Gagal Diubah !');
		}

        session()->flash('message', 'success|Data Berhasil Diubah !');
        
        return redirect()->route('user.soal.index');
	}

    public function render()
    {
    	$kode = $this->kode;
    	$soal = Soal::where('kode',$kode)->first();
    	if (!$soal) abort(404);

    	$data['matpels'] = Matpel::all();
    	$data['single_soal'] = $soal;

        return view('livewire.user.edit',$data);
    }
}
