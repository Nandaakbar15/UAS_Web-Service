<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});


$router->group(['prefix' => 'auth'], function () use ($router) { // route untuk register dan login
    $router->post('/register', 'AuthController@register');
    $router->post('/login', 'AuthController@login');

    // routing data produk
    $router->post('/Produk', 'ProdukController@store'); // fungsi create -> untuk menambahkan data
    $router->get('/Produk', 'ProdukController@index'); // fungsi index -> untuk memunculkan semua data
    $router->put('/Produk/{id}', 'ProdukController@update'); // fungsi update -> untuk mengedit data
    $router->get('/Produk/{id}','ProdukController@show');
    $router->delete('/Produk/{id}', 'ProdukController@destroy'); // fungsi delete -> untuk menghapus data

    // routing data konsumen
    $router->post('/Konsumen', 'KonsumenController@store'); // fungsi create -> untuk menambahkan data
    $router->get('/Konsumen', 'KonsumenController@index'); // fungsi index -> untuk memunculkan semua data
    $router->put('/Konsumen/{id}', 'KonsumenController@update'); // fungsi update -> untuk mengedit data
    $router->get('/Konsumen/{id}','KonsumenController@show');
    $router->delete('/Konsumen/{id}', 'KonsumenController@destroy'); // fungsi delete -> untuk menghapus data

    // routing data Pemesanan
    $router->post('/Pemesanan', 'PemesananController@store'); // fungsi create -> untuk menambahkan data
    $router->get('/Pemesanan', 'PemesananController@index'); // fungsi index -> untuk memunculkan semua data
    $router->put('/Pemesanan/{id}', 'PemesananController@update'); // fungsi update -> untuk mengedit data
    $router->get('/Pemesanan/{id}','PemesananController@show');
    $router->delete('/Pemesanan/{id}', 'PemesananController@destroy'); // fungsi delete -> untuk menghapus data

    // routing data pesanan
    $router->post('/Datapesanan', 'DataPesananController@store'); // fungsi create -> untuk menambahkan data
    $router->get('/Datapesanan', 'DataPesananController@index'); // fungsi index -> untuk memunculkan semua data
    $router->put('/Datapesanan/{id}', 'DataPesananController@update'); // fungsi update -> untuk mengedit data
    $router->get('/Datapesanan/{id}','DataPesananController@show');
    $router->delete('/Datapesanan/{id}', 'DataPesananController@destroy'); // fungsi delete -> untuk menghapus data
});



