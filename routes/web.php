<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// RUTA PARA LA GESTIÓN DE LOS PRODUCTOS
Route::get('/Productos', [App\Http\Controllers\Controller_Producto::class, 'index_producto'])->name('Index.productos');
Route::post('/RegistrarProducto', [App\Http\Controllers\Controller_Producto::class, 'registrar_producto'])->name('Productos_Registro');
Route::get('/EliminarProducto/{id}', [App\Http\Controllers\Controller_Producto::class, 'eliminar_producto'])->name('Eliminar_Producto');

// VENTAS
Route::get('/Ventas', [App\Http\Controllers\Controller_Ventas::class, 'index_ventas'])->name('Index.ventas');
Route::post('/VentaProducto', [App\Http\Controllers\Controller_Ventas::class, 'venta_producto'])->name('Productos_Ventas');

