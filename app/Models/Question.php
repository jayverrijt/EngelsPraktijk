<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'question',
        'answer',
        'category_id',
        'level_id',
    ];

    public function categories() {
        return $this->hasOne(Catlist::class, 'category_id');
    }

    public function levels() {
        return $this->hasOne(Level::class, 'level_id');
    }
}
