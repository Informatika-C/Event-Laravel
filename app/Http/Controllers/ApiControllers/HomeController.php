<?php

namespace App\Http\Controllers\ApiControllers;

use App\Http\Controllers\Controller;
use App\Models\EventLomba;
use App\Models\Penyelenggara;
use DateTime;

class HomeController extends Controller
{
    public function index()
    {
        $five_latest_events = EventLomba::latest()->take(5)->get();
        $five_latest_events_filter = $five_latest_events->map(function ($event) {
            return $this->fillterEvent($event);
        });

        $nearest_event = $this->getNearestEvent($five_latest_events);

        return response()->json([
            'events' => $five_latest_events_filter,
            'nerest_event' => $nearest_event,
        ], 200);
    }

    private function getPenyelenggara($event)
    {
        $penyelenggara = Penyelenggara::find($event["penyelenggara_id"]);

        $event["penyelenggara"] = $penyelenggara;

        return $event;
    }

    private function fillterEvent($event): array
    {
        $event = $this->getPenyelenggara($event);

        return [
            'id' => $event->id,
            'nama_event' => $event->nama_lomba,
            'tempat' => $event->tempat,
            'tanggal_pendaftaran' => $event->tanggal_pendaftaran,
            'tanggal_penutupan_pendaftaran' => $event->tanggal_penutupan_pendaftaran,
            'tanggal_pelaksanaan' => $event->tanggal_pelaksanaan,
            'banner' => $event->banner ? '/storage/banner/' . $event->id . '/' . $event->banner : null,
            'poster' => $event->poster ? '/storage/poster/' . $event->id . '/' . $event->poster : null,
            'penyelenggara' => $event->penyelenggara ? $event->penyelenggara : null,
        ];
    }

    private function getNearestEvent($events): ?array
    {
        $event_sort = $events->sortBy('tanggal_pendaftaran');

        if (count($event_sort) == 0) {
            return null;
        }

        $nerest_event = $event_sort[0];
        foreach ($event_sort as $event) {
            $event_time = $this->getUnixTimeFromDate($event->tanggal_pendaftaran);
            $current_time = time();

            if ($event_time < $current_time) {
                continue;
            }

            $nerest_event = $event;
            break;
        }

        $nerest_event_time = $this->getUnixTimeFromDate($nerest_event->tanggal_pendaftaran);

        $nerest_event_filter = $this->fillterEvent($nerest_event);
        $nerest_event_filter['nerest_event_time'] = $nerest_event_time;

        return $nerest_event_filter;
    }

    private function getUnixTimeFromDate($date): int
    {
        $time = new DateTime($date);
        $time = $time->getTimestamp();

        return $time;
    }
}
