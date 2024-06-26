<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Modules extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'modules';
    public $fillable = ['title', 'description', 'status'];
    public function companies()
    {
        return $this->belongsToMany(Company::class, 'company_module');
    }
}