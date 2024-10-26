<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class Role extends Model
{
    use HasApiTokens;

    protected $guarded = ['id'];

    public $timestamps = false;
}
