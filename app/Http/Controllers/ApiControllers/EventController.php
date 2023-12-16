<?php

namespace App\Http\Controllers\ApiControllers;

use App\Http\Controllers\Controller;
use App\Models\EventLomba;

class EventController extends Controller
{
    public function index(string $kategori)
    {
        $events = EventLomba::getWithPaginateByKategori($kategori, 10);
        return response()->json($events);
    }
}
