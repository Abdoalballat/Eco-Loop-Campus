<?php

namespace App\Events;

use App\Models\containers;
use App\Models\login;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class wasteDeposited
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

        public $student;
        public $container;
        public $materialtype;
        public $weight;
        public $pointesearned;
    public function __construct($student,$container,$materialtype,$weight,$pointesearned )
    {
        $this->student= $student;
        $this->container= $container;
        $this->materialtype= $materialtype;
        $this->weight= $weight;
        $this->pointesearned= $pointesearned;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('channel-name'),
        ];
    }
}
