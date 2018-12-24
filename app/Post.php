<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $guarded = [];
    protected $table = 'posts';

    public function kategoris()
    {
    	return $this->belongsToMany('App\Kategori','kategori_posts', 'post_id', 'kategori_id')->withTimestamps();;
    }
}
