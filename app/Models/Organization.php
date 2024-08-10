<?php

namespace App\Models;

use App\Models\User;
use App\Models\AboutPage;
use App\Models\Organizationdetail;
use App\Models\Organization_member;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Organization extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'email', 'phone',
    ];

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    
    public function organizationdetail(): HasOne
    {
        return $this->hasOne(Organizationdetail::class);
    }
    
    public function members(): HasMany
    {
        return $this->hasMany(Organization_member::class);
    }

    public function aboutPage()
    {
        return $this->hasOne(AboutPage::class);
    }
}