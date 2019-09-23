@extends('layouts.app')


@section('content')
<div class="container">
       
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    Productos nuevos
                </a>
            </div>

        </div>
    </nav>
   </div>
   
  <div>
      <table class="table table-light">
          <thead class="thead-light">
              <tr>
                 <th>
                     #
                 </th>
                  <th>
                      Producto
                  </th>
                  <th>
                      Precio
                  </th>
                  <th>
                      Acciones
                  </th>
              </tr>
          </thead>
          <tbody>
             @foreach($products as $product)
              <tr>
                  <td>
                      {{$loop->iteration}}
                  </td>
                  <td>
                      {{$product->name}}
                  </td>
                  <td>
                      {{$product->price}}
                  </td>
                  <td>
                      <a href="{{url('/productos/'.$product->id.'/edit')}}">
                      <button class="btn btn-primary">Editar</button>
                      </a>
                  </td>
                    <td>
                      <a href="{{url('/productos/'.$product->id)}}">
                      <button class="btn btn-info">Ver</button>
                      </a>
                  </td>
                  <td>
                      <form action="{{ url('/productos/'.$product->id )}}" method="post">
                          {{csrf_field()}}
                          {{method_field('DELETE')}}
                          <button class="btn btn-danger" type="submit" onclick="return confirm('¿Borrar?')">Borrar</button>
                      </form>
                      
                  </td>
                  
                  
              </tr>
              @endforeach
          </tbody>
          
      </table>
                 <form action="{{url('/createProductos')}}">
                     
                  <button type="submit" class="btn btn-default">
                <i class="fa fa-plus"></i> Agregar
            </button>
                 </form>
  </div>