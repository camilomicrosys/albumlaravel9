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
        Schema::create('seguidors', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('seguido_id'); 
            $table->unsignedBigInteger('seguidor_id'); 
            $table->foreign('seguido_id')->references('id')->on('users')->constrained()->onDelete('cascade');
            $table->foreign('seguidor_id')->references('id')->on('users')->constrained()->onDelete('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('seguidors');
    }
};
