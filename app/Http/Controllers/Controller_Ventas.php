<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ventas;
use App\Models\Productos;
use Illuminate\Support\Facades\DB;
use DataTables;

class Controller_Ventas extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index_ventas ()
    {
        $Ventas_get = Ventas::get();
        $Productos = Productos::select('kp_nombre_producto')->get();

        if(request()->ajax())
            {
                $Ventas_ajax = Ventas::get();
                return Datatables::of($Ventas_ajax)   
                ->make(true);
        }

        // Realizar una consulta que permita conocer cuál es el producto más vendido.
        // $Producto_mas_vendido = DB::select("SELECT 'id_producto', count('id_producto') AS 'total_ventas' from 'ventas' group by 'id_producto'");


        return view('Ventas_v', compact('Ventas_get', 'Productos'));
    }

    public function venta_producto(Request $request)
    {
        $id_consultas = $request->id_producto;
        $Cantidad_vender = $request->cantidad_vender;

        // CONSULTA DE LA DISPONIBILIDAD DEL PRODUCTO Y STOCK
        $Consulta_producto = Productos::where('id','=',$id_consultas)->get();  // CONSULTA CON ELOQUENT
        // $Consulta_producto = DB::select("SELECT * FROM `productos` WHERE id = $id"); // CONSULTA DIRECTA EN MYSQL
        $Consulta_stock = Productos::where('id','=',$id_consultas)->pluck('kp_stock')->first();
        $Consulta_nombre = Productos::where('id','=',$id_consultas)->pluck('kp_nombre_producto')->first();
        $Consulta_referencia = Productos::where('id',$id_consultas)->pluck('kp_referencia')->first();

        $id = $request->id;

        // SI EL STOCK DEL PRODUCTO A VENDER ES IGUAL O MENOR PERMITIMOS VENDER
        if ($Consulta_stock >= $Cantidad_vender) {
            // se puede vender
            $Stock_actualizado = $Consulta_stock - $Cantidad_vender;            

            $Registrar_Venta = Productos::updateOrCreate(
                [
                    'id' => $id_consultas
                ],
                [
                    'kp_stock' => $Stock_actualizado,
                ]
            );

        }else {
            // No se puede vender
            $Venta_incorrecta = "En Stock $Consulta_stock";
            return response()->json(['Venta_incorrecta'=>$Venta_incorrecta]);
        }

        $Registrar_Venta = Ventas::updateOrCreate(
            [
                'id' => $id
            ],
            [
                
                'id_producto' => $id_consultas,
                'kv_nombre_producto' => $Consulta_nombre,
                'kv_referencia' => $Consulta_referencia,
                'kv_cantidad_vendida' => $Cantidad_vender,
            ]
        );

        return Response()->json($Registrar_Venta);

    }

}