<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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


// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/about', function () {
    return view('about');
});
Route::get('/contact', function () {
    return view('contact');
});

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'HomeController@index')->name('home');
Route::get('/home/{id}', 'HomeController@show');


Route::get('/admin', 'AdminController@index');

//Route::get('/posts/create', 'PostsController@create');
//Route::get('/posts/{post}', 'PostsController@show');/////////////////////////
//Route::get('/posts', 'PostsController@index');
//Route::post('/posts', 'PostsController@store');
//Route::get('/posts/{post}/edit', 'PostsController@edit');////////////////////
//Route::patch('/posts/{post}', 'PostsController@update');/////////////////////
//Route::delete('/posts/{post}', 'PostsController@destroy');///////////////////

//LOGIN
Route::resource('/users', 'UsersController');
Route::resource('/grupos', 'GruposController');
Route::resource('/accesos', 'AccesosController');

Route::resource('/agentes', 'AgenteController');
Route::get('/register/agent', 'AgenteController@agente')->name('agente');
Route::post('/regisagent', 'AgenteController@storeagent')->name('agentregistrado');

Route::resource('/empresas', 'EmpresaController');
Route::get('/register/creat', 'EmpresaController@empresa')->name('empresa');
Route::post('/registers', 'EmpresaController@storeemp')->name('registrado');

//INMUEBLE
Route::resource('/servicios', 'ServicioController');

Route::resource('/zonas', 'ZonaController');

Route::resource('/tipoinmuebles', 'TipoInmuebleController');

Route::resource('/inmuebles','InmuebleController');
Route::resource('/proyectos','ProyectoController');
Route::resource('/apartamentos','ApartamentoController');
Route::resource('/localcomercials', 'LocalComercialController');
Route::resource('/lotes', 'LoteController');

Route::resource('/fotos', 'FotoController');
//Route::resource('/tipoinmuebles', 'TipoInmuebleController');


//PAGOS TRANSACCIONALES
Route::resource('/planes','PlaneController');//Y
Route::resource('/tipopagos','TipopagoController');//Y
Route::resource('/ofertas','OfertaController');//Y
Route::resource('/facturas','FecturaController');
Route::resource('/notaventas','NotaventaController');

//PUBLICAIONES

Route::resource('/tipopublicacions','TipopublicacionController');

//PUBLICACION
Route::resource('/publicacions','PublicacionController');
Route::get('/publicacion/{publicacion}','PublicacionController@crea')->name('crear');

//nota de venta y factura

Route::resource('/notaventas','NotaVentaController');
Route::resource('/facturas','FacturaController');
