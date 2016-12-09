<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Task.
 */
class Task extends Model
{
    //fora updated i created.
    //protected to public
    //user_id?
    public $fillable = ['id','user_id', 'name', 'done', 'priority'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
