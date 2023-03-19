<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Professional extends Model
{
    use HasFactory;
    protected $table = 'professionals';

    public function user() {
        return $this->belongsTo('App\Models\User');
    }

}
