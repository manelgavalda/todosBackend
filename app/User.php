<?php

namespace ManelGavalda\TodosBackend;

use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

/**
 * Class User.
 */
class User extends Authenticatable
{
    use HasApiTokens,Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'api_token',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'api_token',
    ];

    /**
     * Messages to User relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function messages()
    {
        return $this->hasMany(Message::class);
    }

//    /**
//     * A user can have many GCM tokens.
//     *
//     * @return \Illuminate\Database\Eloquent\Relations\HasMany
//     */
//    public function gcmTokens()
//    {
//        return $this->hasMany(GcmToken::class);
//    }
//
//    public function routeNotificationForGcm()
//    {
//        return 'AAAApS1Nkw8:APA91bE7eCxkiITBtLZvnkS-6XBRJVINl7XQQnm3NR6OnxBKeErvFyMN_NdqjJ_1cL8ACmb5UmVUMbbA1fH4wJmLXka2JzTsOTXEYeL678tId_6Rf3mRfUfNUX3dwbw-ogUP01YRSP1v';
////        return $this->gcmTokens->pluck('registration_id')->toArray();
//    }

    public function gcmTokens()
    {
//        return ['ei0jEANYfY4:APA91bElPP08IIMLVGRX9BYveyml9debTqforM1fkQS8ZDFQZTfpqS5jCrYtgagiApvWnkzWNG8sM_05ggI2r9j0AyLCU1bvAmPYujhlXFkzIlEWlI9x1VT1KMacwU8zl7QtX2ijxv2h'];
        return $this->gcmTokens->pluck('registration_id')->toArray();
    }

    public function routeNotificationForGcm()
    {
        return $this->gcmTokens();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    protected $events = [
      'created' => Registered::class,
    ];
}
