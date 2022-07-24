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
        Schema::create('comentarios', function (Blueprint $table) {
            $table->id();
            //esto dice si elimino un usaurio elimino automatico sus comentarios
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            //esto dice si eliminan un post automaticamente elimino el comentario
            $table->foreignId('post_id')->constrained()->onDelete('cascade');
            $table->string('comentario');
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
        Schema::dropIfExists('comentarios');
    }
};
