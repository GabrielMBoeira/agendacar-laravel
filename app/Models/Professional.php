<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        return $this->belongsTo(User::class);
    }

    public function agendas() {
        return $this->hasMany(Agenda::class);

    }

    public function services() {
        return $this->hasMany(Service::class);
    }


}
