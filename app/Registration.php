<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
     protected $table = 'registration';
    protected $fillable = [
        'registrationId',
        'firstName',
        'lastName',
        'otherNames',
        'dateOfBirth',
        'email',
        'phoneNumber',
        'gender',
        'nextOfKin',
        'nextOfKinTelephone',
        'residentialAddress',
        'occupation',
        'image',
        'purposeOfInvesting',
        'isApproved',
        'dateOfApproval'];
    protected $primaryKey = 'registrationId';
    public $timestamps = true;
    
     public function contributions() {
        return $this->hasMany('App\Contribution', 'userId', 'registration');
    }
}
