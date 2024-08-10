<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutPage extends Model
{
    use HasFactory;
    protected $fillable = [
        'organization_id',
        'heading_1',
        'image_1',
        'paragraph_1',
        'heading_2',
        'image_2',
        'paragraph_2',
    ];
    

    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }
}