<html lang='pt-br'>
  <head>
    <meta charset='utf-8' />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/calendar.css">
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css' rel='stylesheet'>
    <link href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css' rel='stylesheet'>
    <script>
      var VARS_AMBIENTE = new Array();
      VARS_AMBIENTE['user_id'] = <?php echo $user_id; ?>;
    </script>
    <script src='js/calendarEvents.js'></script>
    <script src='js/calendarRender.js'></script>
  </head>
  <body>

    <nav>
      
      <div id="msgDelete">
        @isset($mensagemSucesso)
        <div class="alert alert-success" style="text-align:center;">
          {{ $mensagemSucesso }}
        </div>
        @endisset
      </div>

      @if ($errors->any())
        <div class="alert alert-danger" style="text-align:center;">
          @foreach ($errors->all() as $error)
            {{ $error }}
          @endforeach
        </div>
      @endif



      <div>
        <a href={{route('contacts.index')}} class="a__style" style="position: relative; top: 30px; right: -80px; margin-left:30px">Home</a>

        @auth
          <a href="{{'logout'}}" class="a__style" style="position: relative; top:30px; left: 1580px;">Sair</a>        
        @endauth
      </div>
    </nav>

    <div id='calendar'>  
    </div>

    <div class="modal fade" id="visualizeModal" tabindex="-1" aria-labelledby="visualizeModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="visualizeModalLabel">Visualizar Evento</h5>
            <h5 class="modal-title" id="editModalLabel" style="display: none;">Editar Evento</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="btnClose"></button>
          </div>

          <div class="modal-body">
        
            <div id="visualizeEvent">
              
              <dl class="row">

                <dt class="col-sm-3">ID: </dt>
                <dd class="col-sm-9" id="visualize_id"></dd>
                
                <dt class="col-sm-3">Título: </dt>
                <dd class="col-sm-9" id="visualize_title"></dd>

                <dt class="col-sm-3">Início: </dt>
                <dd class="col-sm-9" id="visualize_start"></dd>

                <dt class="col-sm-3">Final: </dt>
                <dd class="col-sm-9" id="visualize_end"></dd>
            
              </dl>

              <button class="btn btn-warning" id="btnNewEditEvent" name="btnNewEditEvent">Editar</button>

              <button type="button" class="btn btn-danger" id="btnDeleteEvent" name="btnDeleteEvent">Apagar</button>
              

            </div>

            <div id="visualizeEditEvent" style="display: none;">

              <form method="POST" id="formEditEvent" action="{{route('events.update')}}">
                @csrf
                @method("PUT")

                <input type="hidden" name="editId" id="editId">
                <div class="row mb-3">
                    <label for="editTitle" class="col-sm-2 col-form-label">Título</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="editTitle" id="editTitle" placeholder="Título Evento">
                    </div>
                </div>
      
                  <div class="row mb-3">
                    <label for="editStart" class="col-sm-2 col-form-label">Início</label>
                    <div class="col-sm-10">
                      <input type="datetime-local" class="form-control" name="editStart" id="editStart" placeholder="Data Início">
                    </div>
                  </div>
      
                  <div class="row mb-3">
                    <label for="editEnd" class="col-sm-2 col-form-label">Fim</label>
                    <div class="col-sm-10">
                      <input type="datetime-local" class="form-control" name="editEnd" id="editEnd" placeholder="Data Fim">
                    </div>
                  </div>
      
                  <div class="row mb-3">
                    <label for="editColor" class="col-sm-2 col-form-label">Cor</label>
                    <div class="col-sm-10">
                      <select name="editColor" id="editColor" class="form-control">

                        <option value="">Selecione</option>
                        <option style="color:#FFD700;" value="#FFD700">Amarelo</option>
                        <option style="color:#0071c5;" value="#0071c5">Azul Turquesa</option>
                        <option style="color:#FF4500;" value="#FF4500">Laranja</option>
                        <option style="color:#8B4513;" value="#8B4513">Marrom</option>
                        <option style="color:#1C1C1C;" value="#1C1C1C">Preto</option>
                        <option style="color:#436EEE;" value="#436EEE">Royal Blue</option>
                        <option style="color:#A020F0;" value="#A020F0">Roxo</option>
                        <option style="color:#40E0D0;" value="#40E0D0">Turquesa</option>
                        <option style="color:#228B22;" value="#228B22">Verde</option>
                        <option style="color:#8B0000;" value="#8B0000">Vermelho</option>
                      </select>

                    </div>
                  </div>
      
                  <div>
                    <button type="submit" name="btnEditEvent" id="btnEditEvent" class="btn btn-primary" style="background-color: #512da8; border-color: #512da8;">Salvar</button>

                    <button type="button" name="btnCancelEditEvent" id="btnCancelEditEvent" class="btn btn-warning">Cancelar</button> 
                  </div>
                </form>



            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="registerModalLabel">Cadastrar Evento</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
      <div class="modal-body">
        <form method="POST" id="formCadEvent" action="{{route('events.store')}}">
          @csrf
          <div class="row mb-3">
              <label for="title" class="col-sm-2 col-form-label">Título</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="title" id="title" placeholder="Título Evento">
              </div>
          </div>

            <div class="row mb-3">
              <label for="start" class="col-sm-2 col-form-label">Início</label>
              <div class="col-sm-10">
                <input type="datetime-local" class="form-control" name="start" id="start" placeholder="Data Início">
              </div>
            </div>

            <div class="row mb-3">
              <label for="end" class="col-sm-2 col-form-label">Fim</label>
              <div class="col-sm-10">
                <input type="datetime-local" class="form-control" name="end" id="end" placeholder="Data Fim">
              </div>
            </div>

            <div class="row mb-3">
              <label for="color" class="col-sm-2 col-form-label">Cor</label>
              <div class="col-sm-10">
                <select name="color" id="color" class="form-control">
                  <option value="">Selecione</option>
                  <option style="color:#FFD700;" value="#FFD700">Amarelo</option>
                  <option style="color:#0071c5;" value="#0071c5">Azul Turquesa</option>
                  <option style="color:#FF4500;" value="#FF4500">Laranja</option>
                  <option style="color:#8B4513;" value="#8B4513">Marrom</option>
                  <option style="color:#1C1C1C;" value="#1C1C1C">Preto</option>
                  <option style="color:#436EEE;" value="#436EEE">Royal Blue</option>
                  <option style="color:#A020F0;" value="#A020F0">Roxo</option>
                  <option style="color:#40E0D0;" value="#40E0D0">Turquesa</option>
                  <option style="color:#228B22;" value="#228B22">Verde</option>
                  <option style="color:#8B0000;" value="#8B0000">Vermelho</option>
                </select>
              </div>
            </div>

            <div>
              <button type="submit" name="btnCadEvent" id="btnCadEvent" class="btn btn-success">Cadastrar</button>
            </div>
        </form>
      </div>
        </div>
      </div>
    </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src='js/index.global.min.js'></script>
    <script src="js/bootstrap5/index.global.min.js"></script>
    <script src='js/core/locales-all.global.min.js'></script>
  </body>
</html>