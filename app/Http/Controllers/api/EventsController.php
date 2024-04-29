<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Events;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventsController extends Controller
{
    public function index(int $user_id)
    {
        $events = Events::all()->where('user_id',$user_id);

        $count = 0;

        foreach($events as $event){

            $getEvents[$count] = $event;

            $count = 1 + $count;
   
        }

        return $getEvents;
    }

    public function destroy(int $id)
    {
        $event = Events::where("id", $id);
        $events = Events::where("id", $id)->delete();

        return $event;
    }

}
