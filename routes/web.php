<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'VideoControll@showvideo2')->name('home');
//router controler video
Route::get('/Subir_video', 'VideoControll@CreateVideo')->name('Subirvideo');
//Registrar el video en la base de datos
Route::post('/Guardar_Video', 'VideoControll@Savevideo')->name('guardarvideo');
//Motrar los video
Route::get('/Mis_videos', 'VideoControll@showvideo')->name('Mostrarvideo');
//Mostrar la miniatura(iamgen) del video
Route::get('/miniatura/{filename?}', 'VideoControll@Getimage')->name('imageVideo');
//Mostrar el video
Route::get('/video/{filename?}', 'VideoControll@Getvideo')->name('videoVideo');
//Editar el video
Route::get('/Mis_videos/{id}', 'VideoControll@getvideoedit')->name('editVideo');
//Editar el video
Route::post('/Mis_videos', 'VideoControll@postvideoedit')->name('posteditVideo');
//ver el video
Route::get('/Vervideo/{id}', 'VideoControll@getvideover')->name('Vervideo');
//Eliminar el video en la base de datos
Route::post('/Eliminar_video', 'VideoControll@delete')->name('Eliminarvideo');


//Registrar el video en la base de datos
Route::post('/Guardar_comentario', 'commentController@savecomen')->name('guardarcomentario');
// para guardar los comentario
Route::get('/comentario', 'commentController@showcomment')->name('comentario');
//Eliminar el coemtario en la base de datos
Route::post('/Eliminar_comentario', 'commentController@delete')->name('Eliminarcomentario');

