<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Companies extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'companies';
    public $fillable = [
        'legal_name',
        'email',
        'user_id',
        'contact',
        'head_office_address',
        'city',
        'state',
        'country',
        'contact_person',
        'contact_person_designation',
        'contact_person_phone',
        'contact_person_email',
        'website',
        'industry',
        'license_key',
        'is_license_key_verified',
        'status',
        'founded_date',
        'number_of_employees',    
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id');
    }
}
