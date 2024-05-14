<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Generous extends Model
{
    use HasFactory;
    protected $albums = 'generous';
    public $fillable = ['title', 'status'];
    public $timestamps = false;
}
