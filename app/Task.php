<?php

namespace ManelGavalda\TodosBackend;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Task.
 */
class Task extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['name', 'done', 'priority', 'user_id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
