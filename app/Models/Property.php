<?php

namespace App\Models;

use App\Policies\PropertyPolicy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    /** @use HasFactory<\Database\Factories\PropertyFactory> */
    use HasFactory;

    protected $fillable = [
        'type',
        'usage',
        'option',
        'prix',
        'surface',
        'pays',
        'ville',
        'status',
        'user_id',
    ];

    public function bailleur()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function photos()
    {
        return $this->hasMany(PropertyPhoto::class);
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    public function favoredBy()
    {
        return $this->belongsToMany(User::class, 'favorites')
                    ->withTimestamps();
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
}