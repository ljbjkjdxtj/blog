<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article_label extends Model
{
    protected $guarded = [];

    public function labels(){
        return $this->hasMany(Label::class,'id','label_id');
    }
}
