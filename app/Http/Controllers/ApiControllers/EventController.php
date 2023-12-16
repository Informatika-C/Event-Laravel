<?php

namespace App\Http\Controllers\ApiControllers;

use App\Http\Controllers\Controller;
use App\Models\EventLomba;

class EventController extends Controller
{
    public function byKategori(string $kategori)
    {
        $events = EventLomba::getByKategori($kategori);

        if ($events == null) {
            return response()->json([
                'message' => 'Event not found'
            ], 404);
        }

        return response()->json($events);
    }

    public function show(int $id)
    {
        $event = EventLomba::getWithDetailById($id);

        if ($event == null) {
            return response()->json([
                'message' => 'Event not found'
            ], 404);
        }

        return response()->json($event);
    }
}
