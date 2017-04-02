<?php

namespace ManelGavalda\TodosBackend\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use ManelGavalda\TodosBackend\Message;
use ManelGavalda\TodosBackend\User;
use NotificationChannels\Gcm\GcmChannel;
use NotificationChannels\Gcm\GcmMessage;

class MessageSent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user;

    public $message;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(User $user, Message $message)
    {
        $this->user = $user;
        $this->message = $message;
    }
    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('chat');
    }

    /**
     * @param $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [GcmChannel::class];
    }
    /**
     * @param $notifiable
     * @return mixed
     */
    public function toGcm($notifiable)
    {
        return GcmMessage::create()
            ->badge(1)
            ->title($this->user->name)
            ->message($this->message->message)
            ->priority(GcmMessage::PRIORITY_HIGH);
    }
}