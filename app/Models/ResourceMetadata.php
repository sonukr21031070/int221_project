<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResourceMetadata extends Model
{
    use HasFactory;

    protected $table = 'resource_metadata';

    protected $fillable = [
        'resource_id',
        'disability_focus',
        'accessibility_features',
        'duration_seconds',
        'language',
        'additional_notes'
    ];

    public function resource()
    {
        return $this->belongsTo(Resource::class);
    }
}
