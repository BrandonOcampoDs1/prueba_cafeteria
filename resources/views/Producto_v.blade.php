@extends('layouts.app')

@section('content')
{{-- NAVBAR PARA EL SISTEMA --}}
<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm mb-2">
    <div class="container">
        <i style="margin-right: 5px; color: #002855;" class="fs-3 fas fa-coffee"></i>
        <a style="color: #002855;" class="navbar-brand fw-bold fs-3" href="{{ url('/home') }}">
            {{ config('app.name', 'Laravel') }}
        </a>    

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto">

            </ul>

            <ul class="navbar-nav ms-auto">
                <!-- Authentication Links -->
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                    @endif

                    @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            <b>{{ Auth::user()->name }}</b>
                        </a>

                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                {{ __('CERRAR SESIÓN') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-5">
    <div class="row">
        <div class="col-12">
            <div>
                <div class="row">
                    <div class="row mt-3">
                        {{-- FORMULARIO QUE SE ENVÍA MEDIANTE JQUERY T JAVASCRIPT "kp_HOME.JS" --}}
                        <form class="row f_registro_productos" id="f_registro_productos">
                            @csrf
                            <div class="mb-3 col-lg-4 col-sm-6">
                                <label>Nombre del producto</label>
                                <input required class="form-control" type="text" name="kp_nombre_producto" id="kp_nombre_producto" placeholder="Nombre del producto">
                            </div>

                            <div class="mb-3 col-lg-4 col-sm-6">
                                <label>Referencia</label>
                                <input required class="form-control" type="text" name="kp_referencia" id="kp_referencia" placeholder="Referencia del producto">
                            </div>
    
                            <div class="mb-3 col-lg-4 col-sm-6">
                                <label>Precio</label>
                                <input required class="form-control" type="number" name="kp_precio" id="kp_precio" placeholder="Precio">
                            </div>
    
                            <div class="mb-3 col-lg-4 col-sm-6">
                                <label>Peso (kg)</label>
                                <input required class="form-control" type="number" name="kp_peso" id="kp_peso" placeholder="Peso del producto (kg)">
                            </div>
    
                            <div class="mb-3 col-lg-4 col-sm-6">
                                <label>Categoría</label>
                                <input required class="form-control" type="text" name="kp_categoria" id="kp_categoria" placeholder="Categoría">
                            </div>
    
                            <div class="mb-3 col-lg-4 col-sm-6">
                                <label>Stock</label>
                                <input required class="form-control border border-warning" type="number" name="kp_stock" id="kp_stock" placeholder="Stock del producto">
                            </div>

                            <div class="mb-3 col-lg-4 col-sm-6">
                                <label>Fecha de creación</label>
                                <input required class="form-control" type="date" name="kp_fecha_creación" id="kp_fecha_creación" min=<?php $hoy=date("Y-m-d"); echo $hoy;?>>
                            </div>
    
                            <div class="col-12 mb-3 display-grid">
                                <button style="width: 100%" type="submit" class="btn btn-primary btn_home mt-2">
                                    <i class="fas fa-plus-square me-2 vertical-align-middle" style="font-size: 1.2em;"></i>
                                    Registrar
                                </button>
                            </div>
                        </form>
                    </div>
                    <hr>
                    <div class="tabla_productos">
                        {{-- DATATABLA CON LA LISTA DE LOS PRODUCTOS Y SUS ACCIONES PARA ADMINISTRAR --}}
                        <table id="tabla_productos" class="display" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Nombre Producto</th>
                                    <th>Referencia</th>
                                    <th>Precio</th>
                                    <th>Peso</th>
                                    <th>Categoría</th>
                                    <th>Stock</th>
                                    <th>Fecha de registro</th>
                                    <th>Gestionar</th>
                                </tr>
                            </thead>
    
                            <tbody>
                            </tbody>
                        </table>
                    </div>

                    <div class="stock">
                        <div class="alert alert-info mt-2" role="alert">
                            <b>Producto con más stock disponible {{$Stock}}</b>    
                        </div>
                    </div>
    
                    @foreach ($Productos_get as $row)
                        <div class="modal fade modal_editar" id="editar_producto{{$row->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-xl">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Editar <b>Producto</b></h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
    
                                    <div class="modal-body">
                                        <form class="row f_registro_productos" id="f_registro_productos">
                                            <input type="hidden" name="id" value="{{$row->id}}">
                                            @csrf
                                            <div class="mb-3 col-lg-4 col-sm-6">
                                                <label>Nombre del producto</label>
                                                <input required class="form-control" type="text" value="{{$row->kp_nombre_producto}}" name="kp_nombre_producto" id="kp_nombre_producto" placeholder="Nombre del producto">
                                            </div>
                
                                            <div class="mb-3 col-lg-4 col-sm-6">
                                                <label>Referencia</label>
                                                <input required class="form-control" type="text" value="{{$row->kp_referencia}}" name="kp_referencia" id="kp_referencia" placeholder="Referencia del producto">
                                            </div>
                    
                                            <div class="mb-3 col-lg-4 col-sm-6">
                                                <label>Precio</label>
                                                <input required class="form-control" type="number" value="{{$row->kp_precio}}" name="kp_precio" id="kp_precio" placeholder="Precio">
                                            </div>
                    
                                            <div class="mb-3 col-lg-4 col-sm-6">
                                                <label>Peso (kg)</label>
                                                <input required class="form-control" type="number" value="{{$row->kp_peso}}" name="kp_peso" id="kp_peso" placeholder="Peso del producto (kg)">
                                            </div>
                    
                                            <div class="mb-3 col-lg-4 col-sm-6">
                                                <label>Categoría</label>
                                                <input required class="form-control" type="text" value="{{$row->kp_categoria}}" name="kp_categoria" id="kp_categoria" placeholder="Categoría">
                                            </div>
                    
                                            <div class="mb-3 col-lg-4 col-sm-6">
                                                <label>Stock</label>
                                                <input required class="form-control border border-warning" type="number" value="{{$row->kp_stock}}" name="kp_stock" id="kp_stock" placeholder="Stock del producto">
                                            </div>
                
                                            <div class="mb-3 col-lg-4 col-sm-6">
                                                <label>Fecha de creación</label>
                                                <input required class="form-control" type="date" name="kp_fecha_creación" value="{{$row->kp_fecha_creación}}" id="kp_fecha_creación" min=<?php $hoy=date("Y-m-d"); echo $hoy;?>>
                                            </div>
                    
                                            <div class="col-12 mb-3 display-grid">
                                                <button style="width: 100%" type="submit" class="btn btn-primary btn_home mt-2">
                                                    <i class="fas fa-plus-square me-2 vertical-align-middle" style="font-size: 1.2em;"></i>
                                                    Registrar
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection