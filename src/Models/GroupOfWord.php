<?php

namespace ManhND\TextSpinner\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GroupOfWord extends Model
{
    protected $fillable = ['name','id_category'];
    public  function scopeGetCategory($query,$id_cat){
        return $query->where('id_category',$id_cat)->select('id','name')->get();
    }
    public function category() : BelongsTo
    {
        return $this->belongsTo(config('spin-config.models.CategoryData'),'id_category','id');
    }
}
