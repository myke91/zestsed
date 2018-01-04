<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    protected $table = 'device';
    protected $fillable = [
        'deviceId',
        'email',
        'deviceToken',
        'userId',
       
    ];
    protected $primaryKey = 'deviceId';
    public $timestamps = true;

    public function user() {
        return $this->belongsTo('App\Registration', 'userId', 'userId');
    }

}
