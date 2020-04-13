<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $guarded = [];

    public function block()
    {
        return $this->hasOne(Block::class,'id','article_id');
    }
}
