<x-layout title="Recupere Sua Senha">
        
        <div style="height: 200px" class="container" id="container">
                <form action="{{ route('password.email')}}" method="post">
                    @csrf
                    <h1>Esqueceu sua senha?</h1>
                    <p style="font-size: 18px;margin-top: 35px;">Digite seu endereço de email e nós enviaremos um link de recuperação de senha para sua caixa de entrada.</p>
                    <input type="email" placeholder="Email" name="email" id="email" style="width: 500px; padding:20px; margin-top: 50px; margin-bottom: 100px">
                    <button type='submit' style="padding:20px">Enviar Recuperação de Senha</button>
                </form>
        </div>

</x-layout>