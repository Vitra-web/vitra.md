<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MessageAnswer implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;


    public string $userId;
    public int $industryId;
    public string $message;

    public function __construct(string $userId, int $industryId, string $message)
    {
        $this->userId = $userId;
        $this->industryId = $industryId;
        $this->message = $message;
    }

    public function broadcastOn(): array
    {
        return ['answer'];
    }

    public function broadcastAs(): string
    {
        return 'chat';
    }
//    use Dispatchable, InteractsWithSockets, SerializesModels;
//
//    /**
//     * Create a new event instance.
//     */
////    public $username;
//    public $message;
//
//    public function __construct( $message )
//    {
////       $this->username = $username;
//       $this->message = $message;
//    }
//
//    /**
//     * Get the channels the event should broadcast on.
//     *
//     * @return array<int, \Illuminate\Broadcasting\Channel>
//     */
////    public function broadcastOn(): Channel
////    {
////        return new Channel('chat');
////
////    }
//    public function broadcastOn(): array
//    {
//        return ['public'];
//    }
//    public function broadcastAs(): string
//    {
//        return 'chat';
//    }
////    public function broadcastWith() {
////        return ['username' => $this->username, 'message' => $this->message] ;
////    }
}
