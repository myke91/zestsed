<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Investment extends Model {

    protected $table = 'investment';
    protected $fillable = [
        'investmentId',
        'interestRate',
        'dateOfInvestment',
        'contributionId'
    ];
    protected $primaryKey = 'investmentId';
    public $timestamps = true;

    public function contribution() {
        return $this->belongsTo('App\Contribution', 'contributionId', 'contributionId');
    }

}
