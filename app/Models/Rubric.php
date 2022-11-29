<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rubric extends Model
{
    use HasFactory;
//    protected $table="rubrics";

    public function articles()
    {
        return $this->belongsToMany(Article::class);
    }
}
