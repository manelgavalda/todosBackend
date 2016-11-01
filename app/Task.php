<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    //protected to public
    public $fillable = ['name','done','priority','created_at','updated_at'];
}
