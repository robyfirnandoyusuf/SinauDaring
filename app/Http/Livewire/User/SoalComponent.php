<?php

namespace App\Http\Livewire\User;

use Livewire\Component;
use \App\Models\Soal;
use \App\Models\DetailSoal;
use \App\Models\Pilihan;
use App\Http\Livewire\Field;
use Illuminate\Http\Request;
use App\Http\Livewire\User\EditSoal;

class SoalComponent extends Component
{
    public $soal, $jawaban,$pilihan_a,$pilihan_b,$pilihan_c,$pilihan_d;
    public $updateMode 	= false;
    public $inputs 		= [];
    public $i 			= 1;
    public $lastI 		= 1;
    public $indexEdit;

    public function mount()
    {
        $this->jawaban[] = 'A';

        $kode = request()->kode;
        $soal = Soal::where('kode',$kode)->first();
        $detailSoal = DetailSoal::with(['paket_soal','pilihan'])->where('soal_id',$soal->id);
        if ($detailSoal->count() >= 1) 
        {
            $this->i = $detailSoal->count();
        }
    }

    public function update()
    {
        $kode       = request()->kode;
        $soalDb     = Soal::where('kode',$kode)->first();
        $detailSoal = DetailSoal::where('soal_id',$soalDb->id)->first();

        if ($detailSoal->count() >= 1) 
        {
            Pilihan::where('detail_soal_id',$detailSoal->id)->delete();
        }
        DetailSoal::where('soal_id',$soalDb->id)->delete();

        $no = 0;
        $soalIds = [];
        foreach ($this->soal as $key => $soal) 
        {
            $detailSoal = DetailSoal::insertGetId([
                'soal_id'=>$soalDb->id,
                'soal' => $soal, 
                'kunci_jawaban' => $this->jawaban[$no],
                'created_at' => date('Y-m-d H:i:s')
            ]);

            $soalIds[] = $detailSoal;

            $no++;
        }

        $this->pilihan_a=array_values($this->pilihan_a);
        $this->pilihan_b=array_values($this->pilihan_b);
        $this->pilihan_c=array_values($this->pilihan_c);
        $this->pilihan_d=array_values($this->pilihan_d);

        foreach ($soalIds as $i => $soal_id) 
        {
            Pilihan::insert([
                'detail_soal_id' => $soal_id,
                'pilihan_a' => $this->pilihan_a[$i],
                'pilihan_b' => $this->pilihan_b[$i],
                'pilihan_c' => $this->pilihan_c[$i],
                'pilihan_d' => $this->pilihan_d[$i],
                'created_at' => date('Y-m-d H:i:s')
            ]);
        }
        
        $this->inputs = [];
        $this->resetInputFields();

        session()->flash('message', 'success|Data Berhasil Disimpan.');
        return redirect()->route('user.soal.index');
    }

    public function store()
    {
        $kode   = request()->kode;
    	$soalDb = Soal::where('kode',$kode)->firstOrFail();
    	
    	if (!$soalDb) abort(404);

        if ($soalDb->jenis_soal == 'pilihan') 
        {
            $validatedDate = $this->validate([
                    'soal.0' => 'required',
                    'jawaban.0' => 'required',
                    'soal.*' => 'required',
                    'jawaban.*' => 'required',
                ],
                [
                    'soal.0.required' => 'soal field is required',
                    'jawaban.0.required' => 'jawaban field is required',
                    'soal.*.required' => 'soal field is required',
                    'jawaban.*.required' => 'jawaban field is required',
                ]
            );

            $this->jawaban = array_values($this->jawaban);
            $no = 0;
            $soalIds = [];

            foreach ($this->soal as $key => $soal) 
            {
                $detailSoal = DetailSoal::insertGetId([
                    'soal_id'=>$soalDb->id,
                    'soal' => $soal, 
                    'kunci_jawaban' => $this->jawaban[$no],
                    'created_at' => date('Y-m-d H:i:s')
                ]);
                $soalIds[] = $detailSoal;
                $no++;
            }

            $this->pilihan_a=array_values($this->pilihan_a);
            $this->pilihan_b=array_values($this->pilihan_b);
            $this->pilihan_c=array_values($this->pilihan_c);
            $this->pilihan_d=array_values($this->pilihan_d);

            foreach ($soalIds as $key => $soal_id) 
            {
                Pilihan::insert([
                    'detail_soal_id' => $soal_id,
                    'pilihan_a' => $this->pilihan_a[$key],
                    'pilihan_b' => $this->pilihan_b[$key],
                    'pilihan_c' => $this->pilihan_c[$key],
                    'pilihan_d' => $this->pilihan_d[$key],
                    'created_at' => date('Y-m-d H:i:s')
                ]);
            }
        }
	    
        $this->inputs = [];
        $this->resetInputFields();

        session()->flash('message', 'success|Data Berhasil Disimpan.');
        return redirect()->route('user.soal.index');
    }


    public function add($i)
    {
        $i              = $i + 1;
        $this->i        = $i;
        $this->inputs[] = $i;
        $this->jawaban[] = 'A';

        /*$this->soal = [];
        $this->pilihan_a = [];
        $this->pilihan_b = [];
        $this->pilihan_c = [];
        $this->pilihan_d = [];*/
    }

    public function remove($i)
    {
        unset($this->inputs[$i]);

        $i = 1;
        $last = 1;
        foreach ($this->inputs as $key => $value) 
        {
        	$last = $this->inputs[$key] = $last+1;
        	$last = $i+1;
        }

        $this->i = $last;
    }

    private function resetInputFields()
    {
        $this->soal = '';
        $this->jawaban = '';
    }

    public function render()
    {
    	$kode = request()->kode;
    	$soal = Soal::where('kode',$kode)->first();
    	if (!$soal) abort(404);
    	
    	$data['type'] = $soal->jenis_soal;

        //check edit or create
        $detailSoal = DetailSoal::with(['paket_soal','pilihan'])->where('soal_id',$soal->id);

        if ($detailSoal->count() >= 1) 
        {
            $data['soals']  = $detailSoal->get();

            if (empty($this->soal)) 
            {
                if (!\Session::has('message')) 
                {
                    foreach ($data['soals'] as $key => $value) 
                    {
                        $this->soal[] = $value->soal;
                        $this->pilihan_a[] = $value->pilihan->pilihan_a;
                        $this->pilihan_b[] = $value->pilihan->pilihan_b;
                        $this->pilihan_c[] = $value->pilihan->pilihan_c;
                        $this->pilihan_d[] = $value->pilihan->pilihan_d;
                        $this->jawaban[] = $value->kunci_jawaban;
                    }
                }
            }

            return view('livewire.user.edit-soal',$data);
        }
        else
        {
            return view('livewire.user.create-soal',$data);
        }
    }
}
