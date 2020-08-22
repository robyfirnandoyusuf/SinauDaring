<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailSoal extends Model
{
    //
    protected $guarded = [];

    public function paket_soal()
    {
    	return $this->hasOne(Soal::class,'id','soal_id');
    }

    public function pilihan()
    {
    	return $this->hasOne(Pilihan::class,'detail_soal_id','id');
    }
}
