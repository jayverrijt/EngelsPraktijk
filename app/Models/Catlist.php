<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Catlist extends Model
{
    use HasFactory;

    protected $table = 'catlist';

    protected $fillable = [
        'categoryName',
    ];

    public function questions() {
        return $this->hasMany(Question::class);
    }
}
