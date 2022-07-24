<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ImagenController;
use App\Http\Controllers\ComentarioController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\perfilController;
use App\Http\Controllers\SeguidorController;
use App\Http\Controllers\PruebaController;
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
//inicio devgram localhost
Route::get('/',[RegisterController::class,'inicioApp'])->name('inicioApp');
//creacion de usuarios
Route::get('/crear-cuenta',[RegisterController::class,'index'])->name('crear-cuenta');
Route::post('/crear-usuario',[RegisterController::class,'agregarUsuario'])->name('agregarUsuario');

//login de usuarios
Route::get('/login',[LoginController::class,'index'])->name('login');
Route::post('/procesar-login',[LoginController::class,'store'])->name('procesar-login');
Route::post('/cerrar-sesion',[LoginController::class,'cerrarSesion'])->name('cerrar-sesion');


//muro
Route::get('modelos/{user:username}',[PostController::class,'index'])->name('muro');
Route::get('/crear/crear-post',[PostController::class,'crearPost'])->name('post.crear');
//insertar la imagen en la db
Route::get('/crear/insertarImagenDb',[PostController::class,'insertarImagenDb'])->name('post.insertarImagenDb');
//mostrar publicaciones
Route::get('/posts/mostrar/{post}',[PostController::class,'mostrar'])->name('post.mostrar');
//eliminar un post Junto con su imagen
Route::delete('/eliminar/posts/{id}',[PostController::class,'eliminarPost'])->name('post.eliminar');


//crear comentarios area de POSTS
Route::post('/comentarios/crear/{post}',[ComentarioController::class,'crear'])->name('comentario.crear');
Route::delete('/eliminar/comentario/{id}',[ComentarioController::class,'eliminarComentario'])->name('eliminar.comentario');
//imagen    
Route::post('/almacenar-imagen',[ImagenController::class,'almacenarImagen'])->name('almacenar.imagen');

//registar y quitar me gustas aca pasamos el id post
Route::post('/posts/likes/{id}',[LikeController::class,'meGustas'])->name('like.megustas');

//rutas ediciones de perfil
//editar usuario
Route::get('/editar/usuario/perfil/{id}',[perfilController::class,'editarUsuario'])->name('usuario.editar');
//actualizar usuario

Route::post('/actualizar/perfil/usuario',[perfilController::class,'actualizarUsuario'])->name('usuario.catualizar');

//proceso de seguidores
Route::post('/seguir/usuario/{seguido}/{seguidor}',[SeguidorController::class,'seguir'])->name('usuario.seguir');

//cree un controlador pruebas para probar rutas de pruebas en este caso los componentes de blade
Route::get('/pruebas/slots',[PruebaController::class,'pruebaSlot'])->name('pruebas.slot');










