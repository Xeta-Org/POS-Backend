<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\PersonalAccessToken as SanctumPersonalAccessToken;
use Str;

class PersonalAccessToken extends SanctumPersonalAccessToken
{
    use HasFactory;

    protected $table = 'personal_access_tokens';

    protected $keyType = 'string';
    public $incrementing = false;

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model){
            $model->id = (string) Str::uuid();
        });
    }
}
