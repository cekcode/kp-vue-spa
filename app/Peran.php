<?php

namespace App;
 
use Illuminate\Database\Eloquent\Model;

class Peran extends Model
{
    protected $guarded = [];
    protected $table = 'peran';

    public function kategoris()
    {
    	return $this->belongsToMany('App\Kategori','peran_kategori')->withTimestamps();;
    }
}
