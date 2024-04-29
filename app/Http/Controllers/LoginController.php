<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginFormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
 
    public function index () {

        $mensagemSucesso = session("mensagem.sucesso");
        
        $mensagemErro = session("mensagem.erro");

        if(isset($mensagemErro))
        {
            return view('login.index')->with("mensagemErro", $mensagemErro);
        }
        
        return view('login.index')->with("mensagemSucesso", $mensagemSucesso);
    
    }

    public function store(LoginFormRequest $request) {


        if(!Auth::attempt($request->only('email','password'))) {
            return redirect()->back()->with("mensagem.erro","Usuário ou senha inválidos");
        }

        return to_route('contacts.index')->with("mensagem.sucesso", "Login realizado com sucesso");
    }

    public function destroy(Request $request){

        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return to_route('login')->with("mensagem.sucesso", "Logout realizado com sucesso");
    }



}
