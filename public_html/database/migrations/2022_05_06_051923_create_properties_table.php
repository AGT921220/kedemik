<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        

        Schema::create('properties', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->bigInteger('price');
            $table->string('image');
            $table->string('sale_rent')->default('sale');
            $table->text('description');
            $table->decimal('mts_construction')->nullable();
            $table->decimal('mts_ground')->nullable();
            $table->decimal('bedrooms')->nullable();
            $table->decimal('lounge')->nullable();
            $table->decimal('dining_room')->nullable();
            $table->decimal('kitchen')->nullable();
            $table->decimal('living')->nullable();
            $table->decimal('house_plants')->nullable();
            $table->decimal('bathrooms')->nullable();
            $table->decimal('half_bathrooms')->nullable();
            $table->decimal('terrace')->nullable();
            $table->decimal('garage')->nullable();
            $table->decimal('porch')->nullable();
            $table->decimal('yard')->nullable();
            $table->decimal('laundry')->nullable();
            $table->string('alternate_construction')->nullable();
            $table->string('state_of_use')->nullable();
            $table->string('location')->nullable();
            $table->string('suburb')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('phone')->nullable();
            $table->decimal('offices')->nullable();
            $table->decimal('cubicles')->nullable();
            $table->decimal('lobby')->nullable();
            $table->decimal('elevator')->nullable();
            $table->decimal('stairs')->nullable();
            $table->bigInteger('is_shared')->default(0);
            $table->string('seller_name')->nullable();
            $table->string('seller_phone')->nullable();
            $table->boolean('news')->default(false);
            $table->bigInteger('count')->default(0);

            $table->timestamps();
        });


        // Ranchos: Pozos, Casas, sistema de riego, servicio eléctrico,apto animales, apro siembra, maquinaria.
    
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('properties');
    }
}
