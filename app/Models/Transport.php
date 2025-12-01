<?php

namespace App\Models;

use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transport extends Model
{
    use HasFactory;
    protected $table = 'transport';

    protected $fillable = [
        //columns
    ];


    public function car_Type()
    {
        return $this->belongsTo(CarType::class, 'car_type_id');
    }
}
