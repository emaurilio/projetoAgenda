<x-nav title="Alterar Contato" position="-180px">

    <div class="container" id="container">
            <form action="{{ route('contacts.update',['id' => $contacts->id])}}" method="post">
                @method("PUT")
                @csrf
                <h1 style="position: relative; top: -90px;">Editar Contato</h1>
                <input style="position: relative; top: -50px; padding: 10px; font-size: 18px; text-align: center;" type="text" placeholder="Name" name="name" id="name" value="{{$contacts->name}}">
                <input style="position: relative; top: -10px; padding: 10px; font-size: 18px; text-align: center;" type="text" type="email" placeholder="Email" name="email" id="email" value="{{$contacts->email}}">
                <input style="position: relative; top: 30px; padding: 10px; font-size: 18px; text-align: center;" type="phone" placeholder="Telefone" name="phone" id="phone" value="{{$contacts->phone}}">
                <button style="position: relative; top: 80px; padding: 10px; font-size: 18px; text-align: center;" type='submit'>Alterar</button>
            </form>
        </div>

</x-nav>