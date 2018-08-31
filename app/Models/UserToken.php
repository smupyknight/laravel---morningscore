<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserToken extends Model
{
    protected $casts = [
            'is_primary' => 'boolean',
    ];
    
    protected $fillable = [
        'user_id',
        'service',
        'service_user_id',
        'token',
        'token_secret',
        'refresh_token',
        'expiration',
        'is_primary',
    ];
    
    // Relations
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    // Scopes
    public function scopeHasServiceId($q, $service, $id)
    {
        return $q->where('service', '=', $service)
            ->where('service_user_id', '=', $id);
    }
    
    public function scopePrimary($q)
    {
        return $q->where('is_primary', '=', true);
    }
}
