@extends('app')

@section('contenido')
<div class="db_links d-flex">
   <button type="button" id="addC" class="btn  btn-success create-modal ">AÑADIR CAMPEÓN</button> 
</div>

<table class="table table-dark" style="width:1400px;">
   <thead>
    <tr>
      <th scope="col">Id</th>
      <th scope="col">Nombre</th>
      <th scope="col">Descripción</th>
      <th scope="col">Rol</th>
      <th scope="col">Linea</th>
      <th scope="col">Dificultad</th>
    </tr>
  </thead>
 
  <tbody id="champBody">
  </tbody>
</table>

<div id="create" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"></h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" role="form" enctype="multipart/form-data">
           
           
          <div class="form-group row add">
            <label class="control-label col-sm-2" for="nombre">Nombre :</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="nombre" name="nombre"
              placeholder="Nombre de campeón" required>
              <p class="bg-info text-center alert alert-danger hidden"></p>
            </div>
          </div>
          <div class="form-group row">
            <label class="control-label col-sm-2" for="desc">Desc :</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="desc" name="desc"
              placeholder="Descripción de campeón" required>
              <p class="bg-info text-center alert alert-danger hidden"></p>
            </div>
          </div>
          <div class="form-group  row">
            <label class="control-label col-sm-2" for="rol">Rol :</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="rol" name="rol"
              placeholder="Rol de tu campeón" required>
              <p class="bg-info text-center alert alert-danger hidden">Luchador, Asesino, Mago, Tirador, Apoyo , Tanque</p>
            </div>
          </div>
          <div class="form-group  row">
            <label class="control-label col-sm-2" for="linea">Linea :</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="linea" name="linea"
              placeholder="Linea de tu campeón" required>
              <p class="bg-info text-center alert alert-danger hidden">Top, Mid, Bot, Support, Jungle</p>
            </div>
          </div>
          <div class="form-group  row">
            <label class="control-label col-sm-2" for="dificultad">Dificultad :</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="dificultad" name="dificultad"
              placeholder="Tu dificultad de campeón" required>
              <p class="bg-info text-center alert alert-danger hidden">Fácil, Moderada, Avanzada</p>
            </div>
          </div>
           <div class="form-group  row">
            <label class="control-label col-sm-2" for="imagen">Imagen :</label>
            <div class="col-sm-10">
              <input type="file" class="form-control" id="imagen" name="imagen"
              placeholder="Tu imagen de campeón" required>
              <p class="bg-info text-center alert alert-danger hidden"></p>
            </div>
          </div>
          <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}"/>
        </form>
      </div>
          <div class="modal-footer">
            <button class="btn btn-warning" type="submit" id="addCS">
              <span class="glyphicon glyphicon-plus"></span>Guardar campeón
            </button>
            <button class="btn btn-warning" type="button" data-dismiss="modal">
              <span class="glyphicon glyphicon-remobe"></span>Cerrar
            </button>
          </div>
    </div>
  </div>
</div></div>


<div id="edit" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"></h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" role="modal" enctype="multipart/form-data">
          <div class="form-group">
            <label class="control-label col-sm-2" for="idE">ID: </label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="idE" name="idE" disabled>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-2" for="nombreE">Nombre: </label>
            <div class="col-sm-10">
            <input type="text" class="form-control" id="nombreE" name="nombreE">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-2" for="descE">Desc: </label>
            <div class="col-sm-10">
            <input type="text" type="name" class="form-control" id="descE" name="descE"></textarea>
            </div>
          </div>
         <div class="form-group">
            <label class="control-label col-sm-2" for="rolE">Rol: </label>
            <div class="col-sm-10">
            <input type="text" type="name" class="form-control" id="rolE" name="rolE"></textarea>
            <p class="bg-info text-center alert alert-danger hidden">Luchador, Asesino, Mago, Tirador, Apoyo , Tanque</p>
            </div>
         </div>
         <div class="form-group">
            <label class="control-label col-sm-2" for="lineaE">Linea: </label>
            <div class="col-sm-10">
            <input type="text" type="name" class="form-control" id="lineaE" name="lineaE"></textarea>
            <p class="bg-info text-center alert alert-danger hidden">Top, Mid, Bot, Support, Jungle</p>
            </div>
         </div>
          <div class="form-group">
            <label class="control-label col-sm-2" for="dificultadE">Dificultad: </label>
            <div class="col-sm-10">
            <input type="text" type="name" class="form-control" id="dificultadE" name="dificultadE"></textarea>
            <p class="bg-info text-center alert alert-danger hidden">Fácil, Moderada, Avanzada</p>
            </div>
         </div>
          <div class="form-group">
            <label class="control-label col-sm-2" for="imagenE">Imagen: </label>
            <div class="col-sm-10">
            <input type="file" type="name" class="form-control" id="imagenE" name="imagenE"></textarea>
            
            </div>
         </div>
           <div class="modal-footer">
            <p id="errore"></p>
            <button class="btn btn-warning" type="submit" id="editCS">
              <span class="glyphicon glyphicon-plus"></span>Guardar campeón
            </button>
            <button class="btn btn-warning" type="button" data-dismiss="modal">
              <span class="glyphicon glyphicon-remobe"></span>Cerrar
            </button>
          </div>
          <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}"/>
        </form>
    </div>
  </div>
</div>
</div>

  
@stop
<!--
          {{-- Form Delete Post --}}
        <div class="deleteContent">
          Are You sure want to delete <span class="title"></span>?
          <span class="hidden id"></span>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn actionBtn" data-dismiss="modal">
          <span id="footer_action_button" class="glyphicon"></span>
        </button>
        <button type="button" class="btn btn-warning" data-dismiss="modal">
          <span class="glyphicon glyphicon"></span>close
        </button>
      </div>
      
-->