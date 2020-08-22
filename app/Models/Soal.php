<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Soal extends Model
{
    protected $guarded = [];

    // protected $casts = ['birthdate' => 'date'];

    public function matpel()
    {
    	return $this->hasOne(Matpel::class,'id','matpel_id');
    }

    public static function search($query)
    {
        return empty($query) ? static::query()
            : static::where('kode', 'like', '%'.$query.'%');
                // ->orWhere('email', 'like', '%'.$query.'%');
    }
}
