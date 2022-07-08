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
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
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

        <div class="col-md-6">
            <div class="card">
                <h5 class="card-header text-center"><b>CONTROL DE PRODUCTOS</b></h5>
                <div class="card-body">
                  <h5 class="card-title">Control para almacenar y gestionar el inventario de los productos</h5>
                </div>
                <div class="card-footer text-muted">
                    <a style="width: 100%" href="{{ url ( '/Productos')}}" class="btn btn-info">ADMINISTRAR</a>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <h5 class="card-header text-center"><b>VENTA DE PRODUCTOS</b></h5>
                <div class="card-body">
                  <h5 class="card-title">Módulo para la venta de productos</h5>
                </div>
                <div class="card-footer text-muted">
                    <a style="width: 100%" href="{{ url ( '/Ventas')}}" class="btn btn-success">Vender</a>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
