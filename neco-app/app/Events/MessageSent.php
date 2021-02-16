<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MessageSent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $send_user;
    public $receive_user;
    public $message;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($send_user, $receive_user, $message)
    {
        $this->send_user = $send_user;
        $this->receive_user = $receive_user;
        $this->message = $message;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('message.'.$this->receive_user);
    }

    public function broadcastAs()
    {
        return 'message-sent';
    }

   
}
