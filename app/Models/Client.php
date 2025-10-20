<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    /** @use HasFactory<\Database\Factories\ClientFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'agent_id',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function agent()
    {
        return $this->belongsTo(User::class, 'agent_id');
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }
}