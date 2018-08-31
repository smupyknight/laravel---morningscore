<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Support\Enums\SocialiteServiceType;
use App\Traits\HasConnectionParameters;

class Connection extends Model
{
    use HasConnectionParameters;
    
    // Relations
    public function company(){
        return $this->belongsTo(Company::class);
    }

    
    // Scopes
    public function scopeService($q, $slug)
    {
        $type = SocialiteServiceType::slugToType($slug);
        return $q->where('service', $type);
    }
}
