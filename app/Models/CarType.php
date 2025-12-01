<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarType extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'name',
        'price',
        'space',
        'weight'
    ];
    public function transport() {
        return $this->hasMany(Transport::class);
    }
}
