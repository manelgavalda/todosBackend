<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    //fora updated i created.
    //protected to public
    public $fillable = ['name','done','priority'];


}
