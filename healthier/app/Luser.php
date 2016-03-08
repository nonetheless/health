<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Luser extends Model
{
    protected $fillable = [ 'name','email', 'password','kind'];

}
