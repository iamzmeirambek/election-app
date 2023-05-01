<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Election extends Model
{
    use HasFactory;

    protected $fillable = [
        'email',
        'metamaskAddress',
        'token',
        'approved'
    ];

    public function setMetamaskAddressAttribute($value){
        $this->attributes['metamaskAddress'] = bcrypt($value);
    }
}
