<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Label extends Model
{
    protected $guarded = [];

    public function article_label()
    {
        $this->belongsTo(Article_label::class);
    }
}
