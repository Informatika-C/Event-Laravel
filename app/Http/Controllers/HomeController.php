<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use function Ramsey\Uuid\v1;
use Illuminate\Support\Facades\View;
use App\Models\EventLomba;
use App\Models\KelompokPeserta;
use App\Models\Lomba;
use App\Models\LombaKelompok;
use Carbon\Carbon;

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

        // sort event by tanggal_penutupan_pendaftaran in ascending order
        $event_sort = $events->sortBy('tanggal_penutupan_pendaftaran');

        if(count($event_sort) == 0) {
            return View::make('home', [
                'events' => $events,
                'event_first' => null,
                'event_time' => null,
            ]);
        }
        
        $event_first = $event_sort[0];
        // make loop to chek if tanggal_penutupan_pendaftaran alredy past
        foreach ($event_sort as $event) {
            $event_time = new DateTime($event->tanggal_penutupan_pendaftaran);
            $event_time = $event_time->getTimestamp();

            if ($event_time < time()) {
                continue;
            }

            $event_first = $event;
            break;
        }

        $event_time = new DateTime($event_first->tanggal_penutupan_pendaftaran);
        $event_time = $event_time->getTimestamp();

        foreach ($events as $event) {
            $event['add'] = 0;
            foreach ($event->lomba as $lomba) {
                $event['add'] += $lomba->kuota_lomba;
            }
        }
        return View::make('home', [
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

        // get user id and get all kelompok join with user id in kelompok_peserta table
        $user_id = auth()->user()->id ?? -1;
        $kelompoks = KelompokPeserta::where('peserta_id', $user_id)->get();

        // join lombas with kelompoks in lomba_kelompok if join add in lombas "is_join" column
        foreach ($lombas as $lomba) {
            foreach ($kelompoks as $kelompok) {
                $lomba_kelompok = LombaKelompok::where('lomba_id', $lomba->id)->where('kelompok_id', $kelompok->kelompok_id)->first();
                if ($lomba_kelompok) {
                    $lomba->is_join = true;
                    break;
                }
                $lomba->is_join = false;
            }

            // check peserta registered
            $lombaKelompoks = LombaKelompok::where('lomba_id', $lomba->id)->get();
            $pesertaRegistered = 0;

            foreach ($lombaKelompoks as $lombaKelompok) {
                $kelompokPesertas = KelompokPeserta::where('kelompok_id', $lombaKelompok->kelompok_id)->get();
                $pesertaRegistered += count($kelompokPesertas);
            }

            $lomba->pesertaRegistered = $pesertaRegistered;
        }

        return view('home.lombapgs', compact('lombas', 'event_id', 'event'));
    }

    public function showEventPage()
    {
        $events = EventLomba::all();
        return view('home.eventpgs', compact('events'));
    }

    public function showCountdown($id)
    {
        $lomba = Lomba::find($id);

        return view('home', compact('lomba'));
    }
}