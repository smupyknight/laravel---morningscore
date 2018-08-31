<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Integrations\ViralLoops\ViralLoops;

class ViralLoopsReward extends Model
{
    protected $casts = [
        'is_redeemed' => 'boolean',
    ];
    
    protected $fillable = [
        'viral_loops_user_id',
        'viral_loops_id',
        'reward_name',
        'is_redeemed',
    ];
    /* 
     ------------------------------- 
     Relations 
     ------------------------------- 
     */ 
     
    public function viralLoopsUser()
    {
        return $this->belongsTo(ViralLoopsUser::class);
    }
    
    /* 
     ------------------------------- 
     Accessors
     ------------------------------- 
     */ 
     
    public function getUserAttribute()
    {
        return $this->viralLoopsUser->user;
    }
    
    public function getCampaignAttribute()
    {
        return $this->viralLoopsUser->campaign;
    }

    
    /* 
     ------------------------------- 
     Helpers
     ------------------------------- 
     */ 
     
    public function redeem()
    {
        if ($this->is_redeemed) {
            return; // already redeemed
        }
        
        $vl = new ViralLoops($this->campaign);
        $vl->redeemReward($this->viral_loops_id);

        $this->is_redeemed = true;
        $this->save();
        
        // TODO - actually give the reward
    }
}
