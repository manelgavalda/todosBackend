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
    protected $fillable = ['id', 'name', 'done', 'priority', 'user_id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
