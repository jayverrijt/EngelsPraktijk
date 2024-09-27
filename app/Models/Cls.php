<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cls extends Model
{
    //Class is sadly reserved by PHP
    use HasFactory;

    protected $fillable = [
        'className',
        'level',
    ];

    public function users() {
        return $this->hasMany(User::class);
    }

    public function levels() {
        return $this->hasOne(Level::class, 'level_id');
    }
}
