<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Card extends Model {

    protected $table = 'card';
    protected $fillable = ['category', 'card_id', 'manager_phone', 'manager_name', 'user_phone', 'car_number'];

}