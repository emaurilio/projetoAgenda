<x-layout title="Redefinir Senha">
        
        <div class="container" id="container">
                <form action="{{ route('password.update')}}" method="post">
                    @csrf
                    <h1 style="position: relative; top:50px;">Inclua sua nova senha</h1>
                    <input type="hidden" name="token" id="token" value="{{$token}}">
                    <input type="email" placeholder="Email" name="email" id="email" style="width: 500px; padding:20px; margin-top: 150px;">
                    <input type="password" placeholder="Password" name="password" id="password" style="width: 500px; padding:20px;">
                    <input type="password" placeholder="Password" name="password_confirmation" id="password_confirmation" style="width: 500px; padding:20px; ">
                    <button type='submit' style="padding:20px;position: relative; bottom: 3,00x;margin-bottom: 100px">Redefinir</button>
                </form>
        </div>
        
</x-layout>