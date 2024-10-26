<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $guarded = ['id'];

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'role_id',
    ];

    protected $hidden = [
        'password',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function permissions()
    {
        \Log::info($this->role->permissions->pluck('name'));
        return $this->role->permissions->pluck('name');
    }

    public function hasAccess($access)
    {
        \Log::info('hasAccess: '. $this->permissions()->contains($access));
        return $this->permissions->contains($access);
    }
}
