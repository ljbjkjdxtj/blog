<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Block extends Model
{
    protected $guarded=[];

    public function article()
    {
        return $this->belongsTo(Article::class,'block_id','id');
    }
}
