<x-layout title="Login">

    @isset($mensagemSucesso)
    <div class="alert alert-success">
      {{ $mensagemSucesso}}
    </div>
    @endisset

    @isset($mensagemErro)
    <div class="alert alert-danger">
      {{ $mensagemErro }}
    </div>
    @endisset

    <div class="container" id="container">
        <div class="form-container sign-up">
            <form action="{{ route('users.store')}}" method="post">
                @csrf
                <h1>Crie sua conta</h1>
                <div class="social-icons">
                    <a href="{{ route('login.provider',['provider' => 'google'])}}" class="icon"><i class="fa-brands fa-google-plus-g"></i></a>
                    <a href="{{ route('login.provider',['provider' => 'github'])}}" class="icon"><i class="fa-brands fa-github"></i></a>
                </div>
                <span>Ou use suas crendencias para criar seu acesso</span>
                <input type="text" placeholder="Name" name="name" id="name">
                <input type="email" placeholder="Email" name="email" id="email">
                <input type="password" placeholder="Password" name="password" id="password">
                <button>Criar</button>
            </form>
        </div>
        <div class="form-container sign-in">
            <form action="{{ route('login.store')}}" method="post">
                @csrf
                <h1>Login</h1>
                <div class="social-icons">
                    <a href="{{ route('login.provider',['provider' => 'google'])}}" class="icon"><i class="fa-brands fa-google-plus-g"></i></a>
                    <a href="{{ route('login.provider',['provider' => 'github'])}}" class="icon"><i class="fa-brands fa-github"></i></a>
                </div>
                <span>Ou use seu e-mail e senha para acessar</span>
                <input type="email" placeholder="Email" id="email" name="email">
                <input type="password" placeholder="Password" id="password" name="password">
                <a href="{{route('password.request')}}">Esqueceu sua senha?</a>
                <button>Login</button>
            </form>
        </div>
        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-left">
                    <h1>Bem-vindo de volta!</h1>
                    <p>Entre com suas credenciais ou use a autenticação por uma das redes abaixo</p>
                    <button class="hidden" id="login">Sign In</button>
                </div>
                <div class="toggle-panel toggle-right">
                    <h1>Olá, amigo!</h1>
                    <p>Registre com suas credenciais ou use a autenticação por uma das redes abaixo</p>
                    <button class="hidden" id="register">Registrar</button>
                </div>
            </div>
        </div>
    </div>

</x-layout>