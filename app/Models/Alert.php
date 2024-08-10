<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\organization;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Alert extends Model
{
    use HasFactory;
    protected $table = 'alerts';
    protected $fillable = [
        'user_id', 'organization_id', 'address', 'city', 'zip', 'latitude', 'longitude', 'CNIC'
    ];

    public function organization(): BelongsTo
    {
        return $this->belongsTo(organization::class, 'organization_id');
    }
    
}