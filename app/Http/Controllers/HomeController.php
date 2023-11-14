<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use function Ramsey\Uuid\v1;
use App\Models\EventLomba;

class HomeController extends Controller
{
    public function index()
    {
        // check if user login
        if (auth()->user()) {
            return view('home');
        }

        // ----------------------------- //

        // get newest 5 events and join with penyelenggara table with eloquent
        $events = EventLomba::with('penyelenggara')->orderBy('created_at', 'desc')->take(5)->get();

        return view('home', [
            'events' => $events
        ]);
    }
}
