<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organizationdetail extends Model
{
    protected $table = 'organizationdetails';
    use HasFactory;
    protected $fillable = [
        'organization_id', 
        'DateOfEstablishment', 
        'RegistrationNumber', 
        'HeadquartersAddress', 
        'WebsiteURL', 
        'NumberOfEmployees'
    ];

    public function organization(): BelongsTo
    {
        return $this->belongsTo(Organization::class);
    }
}