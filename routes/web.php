<?php

use Illuminate\Support\Facades\Route;
use Codexshaper\WooCommerce\Facades\Product;
use Codexshaper\WooCommerce\Facades\Webhook;
use Codexshaper\WooCommerce\Facades\Report;
use Codexshaper\WooCommerce\Facades\WooCommerce;

use Illuminate\Http\Request;



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
    // $options = [
    //     'per_page' => 50 // Or your desire number
    // ];
    // $products = Product::all($options);


});


  //busqueda por SKU - ej, 823134
Route::get('/busqueda-sku', function (Request $request) {

    $product = Product::where('sku', $request->get('sku'))->get();
    return $product;
});


Route::get('/busqueda-name', function (Request $request) {
    //busqueda por SKU - ej, 823134
    $options = [
        'per_page' => 50 // Or your desire number
    ];

    $product = Product::where('name', 'LIKE', '% '.$request->get('name').' %')->get();

    // dd($product);

    return $product;
});
