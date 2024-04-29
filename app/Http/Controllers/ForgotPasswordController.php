<?php

namespace App\Http\Controllers;


use App\Http\Requests\ForgotPasswordFormRequest;
use App\Http\Requests\ResetPasswordFormRequest;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class ForgotPasswordController extends Controller
{
    public function forgotPassword(string $token){

        return view('login.reset-password', ['token' => $token]);
    }

    public function passwordPutEmailReset()
    {

        return view('login.forgot-password');
    }

    public function passwordSendResetLink(ForgotPasswordFormRequest $request)
    {
        $status = Password::sendResetLink($request->only('email'));

        return $status === Password::RESET_LINK_SENT
                    ? to_route('login')->with("mensagem.sucesso", "E-mail enviado com sucesso")
                    : back();
    }

    public function resetPassword(ResetPasswordFormRequest $request)
    
    {
        $status = Password::reset(

            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));
     
                $user->save();              
     
                event(new PasswordReset($user));
            });
        
            return $status === Password::PASSWORD_RESET
            ? redirect()->route('login')->with("mensagem.sucesso", __($status))
            : back();
    }
}
