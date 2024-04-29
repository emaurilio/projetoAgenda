<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactFormRequest;
use App\Models\Contacts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactsController extends Controller
{
    public function index()
    {
        $contacts = Contacts::orderByDesc("nome")->where('user_id',Auth::user()->id)->simplePaginate(5);
        $mensagemSucesso = session("mensagem.sucesso");
        
        return view("contacts.index")->with("contacts", $contacts)->with("mensagemSucesso", $mensagemSucesso);
    }

    public function create()
    {
        return view("contacts.create");
    }

    public function store(ContactFormRequest $request)
    {

        $data = $request->except("_token");
        $data["user_id"] = Auth::user()->id;
        Contacts::create($data);

        return to_route("contacts.index")->with("mensagem.sucesso","Contato criado com sucesso");
    }

    public function destroy(String $id)
    {

        Contacts::where("id", $id)->delete();

        return to_route("contacts.index")->with("mensagem.sucesso","Contato excluído com sucesso");

    }

    public function edit(String $id)
    {

        $contacts = Contacts::where("id", $id)->first();

        return view("contacts.edit")->with("contacts", $contacts);
    }

    public function update(ContactFormRequest $request, String $id)
    {
        Contacts::where("id", $id)->update($request->except("_token","_method"));

        return to_route("contacts.index")->with("mensagem.sucesso","Contato Alterado com sucesso");
    }
}
