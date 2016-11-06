<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    //fora updated i created.
    //protected to public
    //user_id?
    public $fillable = ['user_id','name','done','priority'];

    public function user(){
        return $this->belongsTo(User::class, 'foreign_key', 'other_key');
    }
}