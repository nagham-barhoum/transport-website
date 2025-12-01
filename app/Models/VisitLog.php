<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VisitLog extends Model
{
    protected $fillable = [
             'ip_address',
             'country' ,
             'referer' ,
             'city',
             'source',
             'user_agent',
             'visited_at',
    ];

}
