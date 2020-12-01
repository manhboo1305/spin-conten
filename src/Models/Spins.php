<?php

namespace ManhND\TextSpinner\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Spins extends Model
{
    protected $table= 'spins';
    protected $fillable=['content','id_category'];
    public function category() :BelongsTo
    {
        return $this->belongsTo(config('config.models.CategoryData'),'id_category','id');
    }
}
