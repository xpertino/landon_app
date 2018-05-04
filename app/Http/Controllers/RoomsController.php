<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Client;
use App\Room;

class RoomsController extends Controller
{
    //
    public function checkAvailableRooms(Request $request, $client_id)
    {
        $dateFrom = $request->dateFrom;
        $dateTo = $request->dateTo;
        $data['dateFrom'] = $dateFrom;
        $data['dateTo'] = $dateTo;
        $data['client'] = Client::find($client_id);
        $data['rooms'] = Room::getAvailableRooms($dateFrom, $dateTo);

        return view('rooms/checkAvailableRooms', $data);
    }
}
