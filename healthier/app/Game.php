<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Game extends Model
{
    //
    protected $fillable = [ 'name','kind', 'location','time','content','info','writerId'];

    public function susers()
    {
        return $this->belongsToMany('App\Suser')->withTimestamps();
    }

    public function setTimeAttribute($time)
    {
        $this->attributes['time'] = Carbon::createFromFormat('Y-m-d',$time);
    }
}
