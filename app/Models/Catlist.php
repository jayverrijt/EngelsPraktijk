<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Catlist extends Model
{
    use HasFactory;

    protected $table = 'catlist';

    protected $fillable = [
        'category_name',
    ];

    public function questions() {
        return $this->hasMany(Question::class);
    }
}
