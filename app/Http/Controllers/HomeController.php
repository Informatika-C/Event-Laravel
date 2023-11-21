<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use function Ramsey\Uuid\v1;
use App\Models\EventLomba;
use App\Models\Lomba;
use DateTime;

class HomeController extends Controller
{
    public function index()
    {
        // // check if user login
        // if (auth()->user()) {
        //     // untuk user menampilkan event berdasarkan rekomendasi
        //     return view('home');
        // }

        // ----------------------------- //

        // untuk guest/admin menampilkan event berdasarkan 5 terbaru 
        // get newest 5 events and join with penyelenggara table with eloquent
        $events = EventLomba::with('penyelenggara')->orderBy('created_at', 'desc')->take(5)->get();

        // sort event by tanggal_pendaftaran in ascending order
        $event_sort = $events->sortBy('tanggal_pendaftaran');

        $event_first = $event_sort[0];
        // make loop to chek if tanggal_pendaftaran alredy past
        foreach ($event_sort as $event) {
            $event_time = new DateTime($event->tanggal_pendaftaran);
            $event_time = $event_time->getTimestamp();

            if ($event_time < time()) {
                continue;
            }

            $event_first = $event;
            break;
        }

        $event_time = new DateTime($event_first->tanggal_pendaftaran);
        $event_time = $event_time->getTimestamp();

        return view('home', [
            'events' => $events,
            'event_first' => $event_first,
            'event_time' => $event_time,
        ]);
    }

    public function detailLomba(Request $request, $event_id, EventLomba $event)
    {
        $lombas = $event->lombas;
        // $event_id = $request->input('event_id');
        $lombas = $event_id ? Lomba::where('event_id', $event_id)->get() : Lomba::all();

        return view('home.lombapgs', compact('lombas', 'event_id', 'event'));
    }

    public function showCountdown($id)
    {
        $lomba = Lomba::find($id);

        return view('home', compact('lomba'));
    }
}
