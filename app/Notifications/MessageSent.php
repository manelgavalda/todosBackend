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
use NotificationChannels\Telegram\TelegramChannel;
use NotificationChannels\Telegram\TelegramMessage;

/**
 * Class MessageSent
 *
 * @package Acacha\TodosBackend\Notifications
 */
class MessageSent extends Notification
{
    use Queueable;

    public $user;

    public $message;

    /**
     * Create a new notification instance.
     *
     * @return void
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
            ->badge(1)
            ->title($this->user)
            ->message($this->message);
    }

    /**
     * @param $notifiable
     * @return mixed
     */
//    public function toOneSignal($notifiable)
//    {
//        return OneSignalMessage::create()
//            ->subject($this->user)
//            ->body($this->message);
//    }

    public function toTelegram($notifiable)
    {
        $url = url('http://todosbackend.manelgavalda.2dam.acacha.org/');
        return TelegramMessage::create()
            ->to('@dam21617')
            ->content($this->message->message) // Markdown supported.
            ->button('View message', $url); // Inline Button
    }

}