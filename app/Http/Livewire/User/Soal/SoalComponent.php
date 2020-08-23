<?php

namespace App\Http\Livewire\User\Soal;

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
    public $updateMode,$isedit 	= false;
    public $inputs 		= [];
    public $i 			= 1;
    public $lastI 		= 1;
    public $indexEdit;

    public function mount()
    {
        $kode = request()->kode;
        $soal = Soal::where('kode',$kode)->first();
        $detailSoal = DetailSoal::with(['paket_soal','pilihan'])->where('soal_id',$soal->id);

        if ($detailSoal->count() >= 1) 
        {
            $this->isedit = true;
            $this->i = $detailSoal->count();
        }
        else
        {
            if ($soal->jenis_soal == 'pilihan'){
                if (empty($this->jawaban[0])) $this->jawaban[0] = 'A';
            }
        }
    }

    public function update()
    {
        $kode       = request()->kode;
        $soalDb     = Soal::where('kode',$kode)->first();
        $detailSoal = DetailSoal::where('soal_id',$soalDb->id)->first();

        $this->soal     = array_values($this->soal);
        $this->jawaban  = array_values($this->jawaban);

        if ($detailSoal->count() >= 1) 
        {
            Pilihan::where('detail_soal_id',$detailSoal->id)->delete();
        }
        DetailSoal::where('soal_id',$soalDb->id)->delete();

        if ($soalDb->jenis_soal == 'pilihan') 
        {
            $no = 0;
            $soalIds = [];
            foreach ($this->inputs as $key => $value) 
            {
                $detailSoal = DetailSoal::insertGetId([
                    'soal_id'=>$soalDb->id,
                    'soal' => $this->soal[$no], 
                    'kunci_jawaban' => $this->jawaban[$no],
                    'created_at' => date('Y-m-d H:i:s')
                ]);

                $soalIds[] = $detailSoal;

                $no++;
            }

            $this->pilihan_a = array_values($this->pilihan_a);
            $this->pilihan_b = array_values($this->pilihan_b);
            $this->pilihan_c = array_values($this->pilihan_c);
            $this->pilihan_d = array_values($this->pilihan_d);

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
        }
        else
        {
            $dataSoal = [];
            $no = 0;
            foreach ($this->inputs as $key => $value) 
            {
                $dataSoal[] = [
                    'soal_id'=>$soalDb->id,
                    'soal' => $this->soal[$no], 
                    'kunci_jawaban' => $this->jawaban[$no],
                    'created_at' => date('Y-m-d H:i:s')
                ];
                $no++;
            }
            DetailSoal::insert($dataSoal);
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
            $this->soal = array_values($this->soal);
            $this->pilihan_a = array_values($this->pilihan_a);
            $this->pilihan_b = array_values($this->pilihan_b);
            $this->pilihan_c = array_values($this->pilihan_c);
            $this->pilihan_d = array_values($this->pilihan_d);
            $this->jawaban = array_values($this->jawaban);

            $validatedDate = $this->validate([
                    'soal.0' => 'required',
                    'jawaban.0' => 'required',
                    'pilihan_a.0' => 'required',
                    'pilihan_b.0' => 'required',
                    'pilihan_c.0' => 'required',
                    'pilihan_d.0' => 'required',
                    'soal.*' => 'required',
                    'jawaban.*' => 'required',
                    'pilihan_a.*' => 'required',
                    'pilihan_b.*' => 'required',
                    'pilihan_c.*' => 'required',
                    'pilihan_d.*' => 'required',
                ],
                [
                    'soal.0.required' => 'soal field is required',
                    'jawaban.0.required' => 'jawaban field is required',
                    'pilihan_a.0.required' => 'pilihan A field is required',
                    'pilihan_b.0.required' => 'pilihan B field is required',
                    'pilihan_c.0.required' => 'pilihan C field is required',
                    'pilihan_d.0.required' => 'pilihan D field is required',
                    'soal.*.required' => 'soal field is required',
                    'jawaban.*.required' => 'jawaban field is required',
                    'pilihan_a.*' => 'pilihan A field is required',
                    'pilihan_b.*' => 'pilihan B field is required',
                    'pilihan_c.*' => 'pilihan C field is required',
                    'pilihan_d.*' => 'pilihan D field is required',
                ]
            );

            $this->soal     = array_values($this->soal);
            $this->jawaban  = array_values($this->jawaban);

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
        else
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

            $dataSoal = [];
            $this->soal     = array_values($this->soal);
            $this->jawaban  = array_values($this->jawaban);

            foreach ($this->soal as $key => $soal) 
            {
                $dataSoal[] = [
                    'soal_id'=>$soalDb->id,
                    'soal' => $soal, 
                    'kunci_jawaban' => $this->jawaban[$key],
                    'created_at' => date('Y-m-d H:i:s')
                ];
            }

            $detailSoal = DetailSoal::insert($dataSoal);
        }
	    
        $this->inputs = [];
        $this->resetInputFields();

        session()->flash('message', 'success|Data Berhasil Disimpan.');
        return redirect()->route('user.soal.index');
    }


    public function add($i)
    {
        $kode = request()->kode;
        $soalDb = Soal::where('kode',$kode)->firstOrFail();

        $i              = $i + 1;
        $this->i        = $i;
        $this->inputs[] = $i;
        $this->soal[$i]    = "";
        $this->jawaban[$i] = "";

        if ($soalDb->jenis_soal == 'pilihan') 
            $this->jawaban[$i] = 'A';
        // dd($this->soal);
    }

    public function remove($i)
    {
        $kode = request()->kode;
        $soalDb = Soal::where('kode',$kode)->firstOrFail();

        $this->inputs = array_values($this->inputs);
        $this->soal = array_values($this->soal);
        $this->jawaban = array_values($this->jawaban);

        if ($soalDb->jenis_soal == 'pilihan') 
        {
            $this->pilihan_a = array_values($this->pilihan_a);
            $this->pilihan_b = array_values($this->pilihan_b);
            $this->pilihan_c = array_values($this->pilihan_c);
            $this->pilihan_d = array_values($this->pilihan_d);

            unset($this->pilihan_a[$i+1]);
            unset($this->pilihan_b[$i+1]);
            unset($this->pilihan_c[$i+1]);
            unset($this->pilihan_d[$i+1]);
            unset($this->soal[$i+1]);
        }
        else
        {
            unset($this->soal[$i]);
        }
        unset($this->inputs[$i]);
        unset($this->jawaban[$i]);

        $i = 1;
        $last = 1;

        if (!$this->isedit) 
        {
            foreach ($this->inputs as $key => $value) 
            {
                $last = $this->inputs[$key] = $last+1;
                $last = $i+1;
            }    
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
        $arrJawaban = [];

        if ($detailSoal->count() >= 1) 
        {
            $data['soals']  = $detailSoal->get();

            if (empty($this->soal)) 
            {
                if (!\Session::has('message')) 
                {
                    $i = 1;
                    foreach ($data['soals'] as $key => $value) 
                    {
                        $this->soal[] = $value->soal;
                        if ($soal->jenis_soal == 'pilihan') 
                        {
                            $this->pilihan_a[] = $value->pilihan->pilihan_a;
                            $this->pilihan_b[] = $value->pilihan->pilihan_b;
                            $this->pilihan_c[] = $value->pilihan->pilihan_c;
                            $this->pilihan_d[] = $value->pilihan->pilihan_d;
                        }
                        
                        $this->jawaban[] = $value->kunci_jawaban;
                        $this->inputs[] = $key;

                        $i++;
                    }
                }
            }

            if ($soal->jenis_soal == 'pilihan') 
            {
                // $this->jawaban = array_values($this->jawaban);
            }
            $this->i = count($this->inputs);

            return view('livewire.user.soal.edit-soal',$data);
        }
        else
        {
            return view('livewire.user.soal.create-soal',$data);
        }
    }
}
