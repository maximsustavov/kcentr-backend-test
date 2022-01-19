<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CounterModel extends Model
{
    use HasFactory;

    protected $table = 'counter';

    public $timestamps = false;

    protected $dateFormat = 'Y-m-d';

    protected $fillable = ['date','views','clicks','cost'];

    protected $hidden = ['id'];

}
