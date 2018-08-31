<?php

namespace App\Models;

class Competitor extends BaseDomain
{
    public function newQuery()
    {
        return parent::newQuery()->whereNotNull('competitor_for');
    }
    
    protected static $available_colors = ['#0D6098', '#3498DB', '#ACC2E0'];
    protected static $chosen_colors = [];
    protected static $current_color_index = 0;
    
    /* 
     ------------------------------- 
     Relationships 
     ------------------------------- 
     */
    
    public function competitor()
    {
        return $this->belongsTo(Domain::class, 'competitor_for');
    }
    
    public function getColorAttribute()
    {
        if ( ! isset(static::$chosen_colors[$this->id])) {
            if ( ! isset(static::$available_colors[static::$current_color_index])) {
                static::$current_color_index = 0;
            }
            static::$chosen_colors[$this->id] = static::$available_colors[static::$current_color_index];
            static::$current_color_index++;
        }
        
        return static::$chosen_colors[$this->id];
    }
    
    public function getDomainSafeAttribute()
    {
        $domain = str_replace('www.', '', $this->domain);
        $domain = str_replace('.', '_', $domain);
        
        return $domain;
    }
    
}
