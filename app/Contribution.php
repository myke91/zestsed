<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contribution extends Model {

    protected $table = 'contribution';
    protected $fillable = [
        'contributionId',
        'modeOfPayment',
        'sourceOfPayment',
        'vendorName',
        'dateOfContribution',
        'contributionAmount',
        'isApproved',
        'dateOfApproval',
        'userId'
    ];
    protected $primaryKey = 'contributionId';
    public $timestamps = true;

    public function user() {
        return $this->belongsTo('App\Registration', 'userId', 'registrationId');
    }

    public function investments() {
        return $this->hasMany('App\Investment', 'contributionId', 'contributionId');
    }

}
