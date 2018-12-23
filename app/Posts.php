<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
    protected $guarded = [];
    protected $table = 'posts';

    public function kategoris()
    {
    	return $this->belongsToMany('App\Kategori','kategori_posts', 'kategori_id', 'post_id')->withTimestamps();;
    }
}
