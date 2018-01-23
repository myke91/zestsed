<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Investment extends Model
{

    protected $table = 'investment';
    protected $fillable = [
        'memberId',
        'quotaMonth',
        'quotaYear',
        'cycleMonth',
        'cycleYear',
        'quotaAmount',
        'quotaRollover',
        'quotaWithInterest',
        'interestAmount',
        'cumulativeInterest',
    ];
    protected $primaryKey = 'investmentId';
    public $timestamps = true;

}
