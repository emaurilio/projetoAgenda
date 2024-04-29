<x-nav title="Contatos" position="-40px">
            
        <div class="container" id="container" style="height: 75vh; width: 1700px;">
            @csrf

            @isset($mensagemSucesso)
            <div class="alert alert-success" style="position: relative; top: 10px; text-align: center;">
              {{ $mensagemSucesso }}
            </div>
            @endisset

            <h1 style="position: relative; top: 20px; text-align: center;">Contatos</h1>
              <table  class ="table table-bordered" style="position: relative; top: 80px; text-align: center; border-spacing: 120px 50px; cellspadding:150px; vertical-align: middle;"> 
                <thead>
                  <tr>
                    <th scope="col">Nome</th>
                    <th scope="col">E-mail</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Editar</th>
                    <th scope="col">Deletar</th>
                  </tr>
                </thead>
                <tbody>
                @foreach ($contacts as $item)
                <tr>
                <td scope="row">{{$item->name}}</td>
                <td>{{$item->email}}</td>
                <td>{{$item->phone}}</td>
                <td><a href="{{route('contacts.edit',['id' => $item->id ])}}"> <button class="a__style" style="color:#ffff">
                    E
                  </button></a></td>
                <td> <form action="{{ route('contacts.destroy',['id' => $item->id ])}}" method='post'>
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-info">X</button>
                  </form></td>
                </tr>
            @endforeach
              </tbody>
              </table>
        <div style="position: relative; bottom: -250px;text-align: center;font-family: 'Montserrat', sans-serif; letter-spacing:3px;">{{$contacts->links()}}</div>
        </div> 
        
        <div>
          <a href="{{route('contacts.create')}}" class="a__style" style="position: relative; bottom: -40px; align-items: center;">Criar Contato</a>
          <a href="{{route('events.index')}}" class="a__style" style="position: relative; bottom: -40px; align-items: center;">Calendário</a>
        </div>

</x-nav>