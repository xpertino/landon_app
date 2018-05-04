<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Client;
use App\Room;
use App\Reservation;

class ReservationsController extends Controller
{
    //
    public function bookRoom($client_id, $room_id, $date_in, $date_out)
    {
        $client = Client::find($client_id);
        $room = Room::find($room_id);
        $reservation = new Reservation();
        $reservation->date_in = $date_in;
        $reservation->date_out = $date_out;
        $reservation->client()->associate($client);
        $reservation->room()->associate($room);
        if( Room::isRoomBooked($room_id, $date_in, $date_out) ) {
            abort('405', 'Trying to book an already booked room');
        }
        $reservation->save();

        return redirect()->route('clients');        
        //return view('reservations/bookRoom');
    }
}
