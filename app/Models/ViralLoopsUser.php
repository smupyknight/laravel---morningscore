<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ViralLoopsUser extends Model
{
    protected $fillable = ['user_id', 'campaign', 'referral_code', 'referrer'];

    /* 
     ------------------------------- 
     Relations 
     ------------------------------- 
     */ 
     
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function rewards()
    {
        return $this->hasMany(ViralLoopsReward::class);
    }
}
