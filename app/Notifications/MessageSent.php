<?php

namespace ManelGavalda\TodosBackend\Notifications;

use ManelGavalda\TodosBackend\Message;
use ManelGavalda\TodosBackend\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use NotificationChannels\Gcm\GcmChannel;
use NotificationChannels\Gcm\GcmMessage;
use NotificationChannels\OneSignal\OneSignalMessage;
use NotificationChannels\Telegram\TelegramChannel;
use NotificationChannels\Telegram\TelegramMessage;

/**
 * Class MessageSent
 *
 * @package ManelGavalda\TodosBackend\Notifications
 */
class MessageSent extends Notification implements ShouldQueue
{
    use Queueable;

    public $user;

    public $message;

    /**
     * Create a new notification instance.
     *
     * @param User $user
     * @param Message $message
     */
    public function __construct(User $user, Message $message)
    {
        $this->user = $user;
        $this->message = $message;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [GcmChannel::class, TelegramChannel::class];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        //TODO
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            $this->user,
            $this->message
        ];
    }

    /**
     * @param $notifiable
     * @return mixed
     */
    public function toGcm($notifiable)
    {
        return GcmMessage::create()
            ->title($this->user->name)
            ->message($this->message->message)
            ->data('message',$this->message)
            ->data('user',$this->user);
    }

    /**
     * @param $notifiable
     * @return mixed
     */
    public function toOneSignal($notifiable)
    {
        return OneSignalMessage::create()
            ->subject($this->user)
            ->body($this->message);
    }

    public function toTelegram($notifiable)
    {
        $url = url('https://todosbackend.manelgavalda.2dam.acacha.org/');
        return TelegramMessage::create()
            ->to('@dam21617alum')
            ->content($this->message->message) // Markdown supported.
            ->button('TodosBackend Manel', $url); // Inline Button
    }
}