<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserInfo extends Model
{
    use HasFactory;
    protected $fillable = [
        'firstname',
        'lastname',
        'middlename',
        'contact',
        'birthdate',
        'address',
    ];
    protected $appends = ['full_name'];
    public function getFullNameAttribute()
    {

        $full_name = $this->firstname . ' ' . $this->lastname;

        //!empty($this->middlename) || 
        if ($this->middlename != null) {
            $full_name .= " " . strtoupper($this->middlename[0]) . '.';
        }

        return $full_name;


    }

}
