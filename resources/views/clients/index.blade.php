@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading"><h4>Clientes</h4></div>
                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" action="{{ url('/clients/create')}}">
                            {!! csrf_field() !!}
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="clave_cliente">Clave</label>
                                <div class="col-md-4">
                                    <input id="clave_cliente" name="clave_cliente" type="text"
                                           placeholder="Clave" class="form-control input-md"
                                           value="{{ old('clave_cliente')}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="nombre_cliente">Nombre</label>
                                <div class="col-md-4">
                                    <input id="nombre_cliente" name="nombre_cliente" type="text"
                                           placeholder="Nombre Cliente" class="form-control input-md"
                                           value="{{ old('nombre_cliente')}}">
                                </div>
                                <label class="col-md-1 control-label" for="telefono_cliente">Teléfono</label>
                                <div class="col-md-4">
                                    <input id="telefono_cliente" name="telefono_cliente" type="text"
                                           placeholder="Teléfono Cliente" class="form-control input-md"
                                           value="{{ old('telefono_cliente')}}">
                                </div>

                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label" for="correo_cliente">E-mail</label>
                                <div class="col-md-4">
                                    <input id="correo_cliente" name="correo_cliente" type="email"
                                           placeholder="Correo Cliente" class="form-control input-md"
                                           value="{{ old('correo_cliente')}}">
                                </div>

                                <label class="col-md-1 control-label" for="direccion_cliente">Dirección</label>
                                <div class="col-md-4">
                                    <input id="direccion_cliente" name="direccion_cliente" type="text"
                                           placeholder="Dirección Cliente" class="form-control input-md"
                                           value="{{ old('direccion_cliente')}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="archivo_cliente">Archivo Cliente</label>
                                <div class="col-md-4">
                                    <input id="archivo_cliente" name="archivo_cliente" type="text"
                                           placeholder="Archivo Cliente" class="form-control input-md"
                                           value="{{ old('archivo_cliente')}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label"></label>
                                <div class="col-md-8">
                                    <button id="insert" name="insert" class="btn btn-primary" value="insert">Guardar
                                    </button>
                                    <button id="discard" type="button" name="discard" class="btn btn-primary">Limpiar
                                    </button>
                                </div>
                            </div>

                            @if($errors->any())
                                <div class="col-md-4 col-md-offset-2" id="alert">
                                    <div class="alert alert-danger" id="alert_errors" role="alert">
                                        {{$errors->first()}}
                                    </div>
                                </div>
                            @endif
                            @if (session('status'))
                                <div class="col-md-4 col-md-offset-2" id="alert">
                                    <div class="alert alert-success" id="alert_success" role="alert">
                                        {{ session('status') }}
                                    </div>
                                </div>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-9"><h4>Lista de Clientes</h4></div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <table class="table" id="tabla_employee">
                            <thead class="thead-light">
                            <tr>
                                <th scope="col">Cliente ID</th>
                                <th scope="col">Clave</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Teléfono</th>
                                <th scope="col">Dirección</th>
                                <th scope="col">Archivo Cliente</th>
                                <th scope="col">Accion</th>
                            </tr>
                            </thead>
                             <tbody>
                             @if(count($clients) > 0)
                                 @foreach ($clients as $client => $value)
                                     <tr>
                                         <td>{{$value->id}}</td>
                                         <td>{{$value->clave}}</td>
                                         <td>{{$value->nombre}}</td>
                                         <td>{{$value->telefono}}</td>
                                         <td>{{$value->direccion}}</td>
                                         <td>{{$value->archivo_clientes}}</td>
                                         <td>
                                            <div class="dropdown">
                                              <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                               Editar
                                              </button>
                                              <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                <li><a class="set_delete_client dropdown-item" data-toggle="modal" data-id="{{$value->id}}" data-name="{{$value->nombre}}" href="#deleteModal">Eliminar</a></li>
                                                <li><a class="dropdown-item" href="#">Modificar</a></li>
                                              </ul>
                                            </div>

                                         </td>
                                     </tr>
                                 @endforeach
                             @else
                                 <tr>
                                     <td>No hay Clientes.</td>
                                 </tr>
                             @endif
                             </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

   <!-- Modal -->
   <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
     <div class="modal-dialog">
       <div class="modal-content">
         <div class="modal-header">
           <h5 class="modal-title" id="deleteModalLabel">Eliminar Cliente</h5>
         </div>
         <form class="form-horizontal" method="POST" action="{{ url('/clients/delete')}}">
         <div class="modal-body">
          {!! csrf_field() !!}
           Esta seguro que desea eliminar.
           <br>
           <strong>Cliente ID: </strong><p id="id_client" ></p>
           <strong>Nombre: </strong><p id="name_client"></p>
         </div>
         <div class="modal-footer">
           <button type="button" class="btn btn-secondary" data-dismiss="modal" value="insert">Cerrar</button>
           <button type="submit" class="btn btn-danger delete_client" name="delete_client" id="delete_client">Eliminar</button>
         </div>
         </form>
       </div>
     </div>
   </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/clients/clients.js') }}"></script>
@show

