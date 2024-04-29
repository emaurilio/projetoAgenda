<x-nav title="Crie Seu Contato" position="-180px">

    <div class="container" id="container">
            <form action="{{ route('contacts.store')}}" method="post">
                @csrf
                <h1 style="position: relative; top: -90px;">Novo Contato</h1>
                <input type="text" placeholder="Nome" name="name" id="name" style="position: relative; top: -50px; padding: 10px; font-size: 18px; text-align: center;">
                <input type="email" placeholder="Email" name="email" id="email" style="position: relative; top: -10px; padding: 10px; font-size: 18px; text-align: center;">
                <input type="phone" placeholder="Telefone" name="phone" id="phone" style="position: relative; top: 30px; padding: 10px; font-size: 18px; text-align: center;">
                <button type="submit" style="position: relative; top: 80px; padding: 10px; font-size: 18px; text-align: right;">Criar Contato</button>
            </form>
        </div>
        
</x-nav>