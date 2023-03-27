<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Professional extends Model
{
    use HasFactory;
    protected $table = 'professionals';

    protected $fillable = [
        'name',
        'date_start',
        'date_end',
        'interval',
        'service1',
        'time_service1',
        'service2',
        'time_service2',
        'service3',
        'time_service3',
        'service4',
        'time_service4',
        'service5',
        'time_service5',
        'status',
        'created_at',
        'updated_at',
        'user_id'
    ];

    public function user() {
        return $this->belongsTo('App\Models\User');
    }

}
