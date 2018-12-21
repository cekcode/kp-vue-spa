<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $guarded = [];
    protected $table = 'kategori';

    public function perans()
    {
    	return $this->belongsToMany('App\Peran','peran_kategori', 'kategori_id', 'peran_id')->withTimestamps();
    }
}
