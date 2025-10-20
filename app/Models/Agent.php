<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agent extends Model
{
    /** @use HasFactory<\Database\Factories\AgentFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function clients()
    {
        return $this->hasMany(Client::class, 'agent_id');
    }

    public function properties()
    {
        return $this->hasMany(Property::class, 'agent_id');
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'agent_id');
    }
}