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

    public function posts()
    {
        // return $this->belongsToMany('App\Posts','kategori_posts')->orderBy('created_at','DESC')->paginate(5);
        return $this->belongsToMany('App\Posts','kategori_posts', 'kategori_id', 'post_id')->withTimestamps();
    }
}
