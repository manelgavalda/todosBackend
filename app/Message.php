<?php

namespace ManelGavalda\TodosBackend;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Message
 * @package ManelGavalda\TodosBackend
 */
class Message extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'message'
    ];

    /**
     * Message to User relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}