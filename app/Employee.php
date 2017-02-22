<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $table="employee";

    protected $fillable = [
        'fullname', 'position', 'employment_date', 'salary', 'chief',
    ];

    public function childs() {
        return $this->hasMany('App\Employee', 'chief', 'id');
    }
}
