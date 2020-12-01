<?php

namespace ManhND\TextSpinner\Models;

use Illuminate\Database\Eloquent\Model;

class CategoryData extends Model
{
    protected $table = 'category_data';
    protected $fillable = ['name'];

    public  function scopeGetData($query){
        return $query->select('id','name')->get();
    }
}
