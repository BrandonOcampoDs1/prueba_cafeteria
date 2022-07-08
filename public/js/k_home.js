// TABLA DE PRODUCTOS
$(document).ready(function () {
    $('#tabla_productos').DataTable( {
        ajax: {
            url: "/Productos",
        },
        columns: [
            {
                data: 'id',
                name: 'id'
            },
            {
                data: 'kp_nombre_producto',
                name: 'kp_nombre_producto'
            },
            {
                data: 'kp_referencia',
                name: 'kp_referencia'
            },
            {
                data: 'kp_precio',
                name: 'kp_precio'
            },
            {
                data: 'kp_peso',
                name: 'kp_peso'
            },
            {
                data: 'kp_categoria',
                name: 'kp_categoria'
            },
            {
                data: 'kp_stock',
                name: 'kp_stock'
            },
            {
                data: 'kp_fecha_creación',
                name: 'kp_fecha_creación'
            },
            {
                data: 'administrar_v',
                name: 'administrar_v'
            }
        ],
        scrollX: true,
        retrieve: true,
        paging: false,
        aaSorting: [],
        scrollY: "250px",
        pageLength: "50",
        scrollCollapse: true,
        processing: true,
    });
});

// TABLA PARA LAS VENTAS
$(document).ready(function () {
    $('#tabla_ventas').DataTable( {
        ajax: {
            url: "/Ventas",
        },
        columns: [
            {
                data: 'id_producto',
                name: 'id_producto'
            },
            {
                data: 'kv_nombre_producto',
                name: 'kv_nombre_producto'
            },
            {
                data: 'kv_referencia',
                name: 'kv_referencia'
            },
            {
                data: 'kv_cantidad_vendida',
                name: 'kv_cantidad_vendida'
            },
            {
                data: 'kv_fecha_venta',
                name: 'kv_fecha_venta'
            }
        ],
        scrollX: true,
        retrieve: true,
        paging: false,
        aaSorting: [],
        scrollY: "350px",
        pageLength: "50",
        scrollCollapse: true,
        processing: true,
    });
});

// ENVÍO DE FORMULARIO DE PRODUCTOS Y MARCAS
$(document).on("submit","#f_registro_productos", function (e) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    
    e.preventDefault();
    var formData = new FormData(this);
    $.ajax({
        type:'post',
        url: "/RegistrarProducto",
        data: formData,
        cache:false,
        contentType: false,
        processData: false,
        success: (data) => {
            // RESETEAMOS EL FORMULARIO
            $("#f_registro_productos")[0].reset();
            // DAMOS UNA ALERTA DE QUE SE REGISTRO CORRECTAMENTE
            $.ambiance({
                title: "Producto registrado correctamente!",
                type: "success",
            });
            // RECARGAMAOS LA TABLA PARA QUE SE VEA REFLEJADO
            $ ('#tabla_productos').DataTable().ajax.reload();
            $('.modal_editar').modal('hide')

        },
        error: function(data){
            console.log(data);
        }
    });
})

$(document).on("submit","#f_venta_productos", function (e) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    
    e.preventDefault();
    var formData = new FormData(this);
    $.ajax({
        type:'post',
        url: "/VentaProducto",
        data: formData,
        cache:false,
        contentType: false,
        processData: false,
        success: (data) => {
            let Stock = JSON.stringify(data.Venta_incorrecta)

            if (Stock == undefined) {
                $("#f_venta_productos")[0].reset();
                $.ambiance({
                    title: "Producto vendido correctamente!",
                    type: "success",
                });
                $ ('#tabla_ventas').DataTable().ajax.reload();
                $ ('#tabla_productos').DataTable().ajax.reload();
            }else {
                $.ambiance({
                    title: Stock,
                    message: "No es posible realizar la venta!",
                    type: "error",
                    timeout: 7
                });
            }   
        },
        error: function(data){
            console.log(data);
        }
    });
})