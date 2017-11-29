<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConnectionTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('connection_types', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('connection_id');
            $table->foreign('connection_id')
                ->references('id')
                ->on('category_connections')
                ->onDelete('cascade');
            $table->unsignedInteger('type');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('connection_types');
    }
}
