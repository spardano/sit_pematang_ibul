<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function getEvents()
    {
        $events = Event::where('status_publish', 1)->orderBy('created_at', 'desc')->get();

        $data_baru = array();
        $multiplied = $events->map(function ($item) {
            $media = $item->getMedia('event')->where('model_id', $item->id)->first();

            $temp['id'] = $item->id;
            $temp['judul_event'] = $item->judul_event;
            $temp['sub_judul_event'] = $item->sub_judul_event;
            $temp['deskripsi'] = $item->deskripsi;
            $temp['mulai'] = $item->mulai;
            $temp['selesai'] = $item->selesai;
            $temp['status_publish'] =  $item->status_publish;
            $temp['thumbnail'] = $media->getUrl();
            return $temp;
        });

        $data_baru = $multiplied->all();

        return response()->json([
            'status' => true,
            'data' => $data_baru
        ]);
    }

    public function getSingleEvent($id)
    {
        $event = Event::find($id);
        $data['event'] = $event;
        $data['gambar'] = $event->getFirstMediaUrl('event');

        return response()->json([
            'status' => true,
            'data' => $data
        ]);
    }
}
