<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Productos;
use Illuminate\Support\Facades\DB;
use DataTables;

class Controller_Producto extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index_producto ()
    {
        $Productos_get = Productos::get();

        if(request()->ajax())
            {
                $Productos_ajax = Productos::get();
                return Datatables::of($Productos_ajax)   

                ->addColumn('administrar_v', function ($row){
                    $botones = 
                        '
                        <div class="botones_administrar">
                            
                            <button class="btn_administrar" data-bs-toggle="modal" data-bs-target="#editar_producto'.$row->id.'">
                                <i class="text-success fas fa-edit"></i>
                            </button>

                            <form style="margin-left: 10px;" action="'.route('Eliminar_Producto', $row->id) .'">
                                <button class="btn_administrar ml-4" type="submit">
                                    <i class="text-danger fas fa-trash"></i>
                                </button>
                            </form>

                        </div>                    
                        ';
                    return $botones;
                })

                ->rawColumns(['administrar_v'])
                ->make(true);
        }

        // Consulta que permita conocer cuál es el producto que más stock tiene.
        $Mayor_Stock = Productos::max('kp_stock');
        // CONSULTA HECHA DIRECTAMENTE EN MYSQL = "SELECT id, kp_stock, kp_nombre_producto FROM productos WHERE kp_stock = ( SELECT MAX( kp_stock ) FROM productos);
        // NOMBRE DEL PRODUCTO CON MÁS STOCK 
        $Mayor_nombre = Productos::where('kp_stock',$Mayor_Stock)->pluck('kp_nombre_producto')->first();

        $Stock = $Mayor_nombre.' con '.$Mayor_Stock;
        return view('Producto_v', compact('Productos_get', 'Stock'));
    }

    public function registrar_producto(Request $request)
    {
        // VALIDAMOS LOS CAMPOS
        $validated = $request->validate([
            'kp_nombre_producto' => 'required',            
            'kp_referencia' => 'required',
            'kp_precio'=> 'required|numeric',
            'kp_peso' => 'required|numeric',
            'kp_categoria' => 'required',
            'kp_stock' => 'required|numeric',
            'kp_fecha_creación' => 'required',
        ]);

        $id = $request->id;

        // REGISTRAMOS EL PRODUCTO EN LA BASE DE DATOS
        $Registro_Producto = Productos::updateOrCreate(
            [
                'id' => $id
            ],
            [
                'kp_nombre_producto' => $request->kp_nombre_producto,
                'kp_referencia' => $request->kp_referencia,
                'kp_precio' => $request->kp_precio,
                'kp_peso' => $request->kp_peso,
                'kp_categoria' => $request->kp_categoria,
                'kp_stock' => $request->kp_stock,
                'kp_fecha_creación' => $request->kp_fecha_creación
            ]
        );

        return Response()->json($Registro_Producto);


    }

    public function eliminar_producto(Productos $id)
    {
        $id->delete();
        return redirect()->route('Index.productos');
    }
}
