<?php

namespace App\Http\Controllers;

use App\Http\Requests\EventFormRequest;
use App\Http\Requests\StoreEventFormRequest;
use App\Http\Requests\UpdateEventFormRequest;
use App\Models\Events;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventsController extends Controller
{
    public function index()
    {
        $events = Events::all()->where('user_id',Auth::user()->id);
        $mensagemSucesso = session("mensagem.sucesso");

        return view("events.index")->with("events", $events)->with("mensagemSucesso", $mensagemSucesso)->with("user_id",Auth::user()->id);
    }

    public function store(StoreEventFormRequest $request)
    {

        $events = Events::create(['title' => $request->title,'start' => $request->start,'end'=> $request->end, 'user_id' => Auth::user()->id, 'color'=>$request->color]);

        return to_route("events.index")->with("mensagem.sucesso", "Evento criado com sucesso");

    }

    public function update(UpdateEventFormRequest $request)
    {   
        $events = Events::find($request->editId);
        $events->update(["title"=> $request->editTitle,"start"=> $request->editStart,"end"=> $request->editEnd,"color" => $request->editColor, "id" => $request->editId]);

         return to_route("events.index")->with("mensagem.sucesso", "Evento editado com sucesso");
    
    }

}