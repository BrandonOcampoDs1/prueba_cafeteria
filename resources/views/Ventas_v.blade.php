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
                        <form class="row" id="f_venta_productos">
                            @csrf
                            <div class="mb-3 col-lg-6 col-sm-6">
                                <label>Id del producto</label>
                                <input required class="form-control" type="number" name="id_producto" id="id_producto" placeholder="Id del producto">
                            </div>

                            <div class="mb-3 col-lg-6 col-sm-6">
                                <label>Cantidad a vender</label>
                                <input required class="form-control" type="number" name="cantidad_vender" id="cantidad_vender" placeholder="Cantidad a vender" min="1">
                            </div>

                            <div class="col-12 mb-12 display-grid">
                                <button style="width: 100%" type="submit" class="btn btn-success btn_home mt-2">
                                    <i class="fas fa-cart-plus me-1 vertical-align-middle"></i>
                                    <b>Registrar venta</b>
                                </button>
                            </div>

                            {{-- <div class="mb-3 col-lg-4 col-sm-6">
                                <label>Nombre del producto</label>
                                <select class="form-control" name="kv_nombre_producto" required>
                                    <option value="">Productos 🔽</option>
                                    @foreach ($Productos as $row)
                                        <option value="{{$row->kp_nombre_producto}}"><b>{{$row->kp_nombre_producto}}</b></option>
                                    @endforeach
                                </select>
                            </div> --}}
                        </form>
                    </div>
                    <hr class="mt-3">
                    <div>
                        {{-- DATATABLA CON LA LISTA DE LOS PRODUCTOS Y SUS ACCIONES PARA ADMINISTRAR --}}
                        <table id="tabla_ventas" class="display" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Id del producto</th>
                                    <th>Nombre Producto</th>
                                    <th>Referencia</th>
                                    <th>Cantidad vendida</th>
                                    <th>Fecha de venta</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div> 
                </div>
            </div>
        </div>
    </div>
</div>
@endsection