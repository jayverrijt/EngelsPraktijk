<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    use HasFactory;

    protected $fillable = [
        'level_name',
    ];

    public function classes() {
        return $this->hasMany(Cls::class);
    }

    public function questions() {
        return $this->hasMany(Question::class);
    }
}
