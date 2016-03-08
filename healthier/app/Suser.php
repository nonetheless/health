<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Suser extends Model
{
    //
    protected $table = 'susers';
    protected $fillable = [ 'name','email', 'location','birthday','about','sign','password'];

    public function games()
    {
        return $this->belongsToMany('App\Game')->withTimestamps();
    }
}
