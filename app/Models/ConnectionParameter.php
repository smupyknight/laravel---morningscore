<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConnectionParameter extends Model
{
    // Relations
    public function connection()
    {
        return $this->belongsTo(Connection::class);
    }
    
    public function domain()
    {
        return $this->belongsTo(Domain::class);
    }

}
