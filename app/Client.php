<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    //
    protected $fillable = array('title', 'name', 'last_name', 'address', 'zip_code', 'city', 'state', 'email');

    public function reservations() {
        return $this->hasMany('App\Reservation');
    }

}
