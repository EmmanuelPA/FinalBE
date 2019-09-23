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

<div class="col-sm-offset-3 col-sm-6">
    <div class="panel-title">
        <h1>Agregar Productos</h1>
    </div>

<div class="panel-body">
 
    
    <form action="{{ url('/productos') }}" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
    
    <div class="form-group">
        <label for="name" class="control-label">Producto</label>
        <input type="text" name="name" value="" id="Nombre" placeholder="Nombre del producto..." class="form-control">
    </div>
    <div class="form-group">
        <label for="price" class="control-label">Precio</label>
        <input type="text" name="price" value="" id="Price" placeholder="Precio del producto..." class="form-control">
    </div>
    
    <div class="form-group">
        
            <button type="submit" class="btn btn-default">
                <i class="fa fa-plus"></i> Registrar
            </button>
            
       
    </div>
    </form>
    
</div>
</div>
