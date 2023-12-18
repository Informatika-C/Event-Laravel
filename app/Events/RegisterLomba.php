<?php

namespace App\Events;

use App\Models\Lomba;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class RegisterLomba implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public function __construct(
        private Lomba $lomba,
    ) {
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new Channel('channel-lomba-' . $this->lomba->id),
        ];
    }

    public function broadcastAs(): string
    {
        return 'register-lomba';
    }

    public function broadcastWith(): array
    {
        return [
            'jumlah_peserta' => Lomba::getPesertaRegistered($this->lomba->id),
        ];
    }
}
