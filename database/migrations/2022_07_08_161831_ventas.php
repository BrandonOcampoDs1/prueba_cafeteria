<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ventas', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->bigInteger('id_producto');
                $table->string('kv_nombre_producto');
                $table->string('kv_referencia');
                $table->bigInteger('kv_cantidad_vendida');
                $table->timestamp('kv_fecha_venta');
                $table->timestamps();
            }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('ventas');
    }
};
