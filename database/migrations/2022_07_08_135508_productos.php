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
        Schema::create('productos', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('kp_nombre_producto');
                $table->string('kp_referencia');
                $table->bigInteger('kp_precio');
                $table->bigInteger('kp_peso');
                $table->string('kp_categoria');
                $table->bigInteger('kp_stock');
                $table->date('kp_fecha_creación');
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
        Schema::drop('productos');
    }
};
