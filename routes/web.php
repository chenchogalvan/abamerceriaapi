<?php

use App\Imports\ProductosImport;
use Illuminate\Support\Facades\Route;
use Codexshaper\WooCommerce\Facades\Product;
use Codexshaper\WooCommerce\Facades\Webhook;
use Codexshaper\WooCommerce\Facades\Report;
use Codexshaper\WooCommerce\Facades\WooCommerce;

use Illuminate\Support\Facades\Mail;
use App\Mail\SugerenciaEmail;
use App\Models\Producto;
use Symfony\Component\HttpFoundation\Response;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

use function PHPUnit\Framework\isEmpty;

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
    $datos = Producto::all();
    $fecha = Producto::first();
    return view('importar', compact('datos', 'fecha'));
});

Route::post('/eliminar', function () {
    Producto::truncate();
    return redirect()->back()->with('success', 'La información se eliminó correctamente');
})->name('eliminar.productos');

Route::post('/importar', function (Request $request) {
    $item = $request->file('file');

    Excel::import(new ProductosImport, $item);
    return redirect()->back()->with('success', 'La información se importo de forma correcta.');
})->name('productos.importar');


  //busqueda por SKU - ej, 823134
Route::get('/busqueda-sku', function (Request $request) {

    $sku = $request->get('sku');


    $producto = Producto::where('sku', '=', $sku)->get();

    return $producto;


    // $product = Product::where('sku', $request->get('sku'))->get();
    // return $product;
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


Route::post('/enviar-mensaje', function (Request $request) {

    $nombre = $request->get('nombre');
    $correo = $request->get('correo');
    $telefono = $request->get('telefono');
    $sugerencia =  $request->get('sugerencia');

    $mailData = [
        'nombre' => $nombre,
        'correo' => $correo,
        'telefono' => $telefono,
        'sugerencia' => $sugerencia,
    ];

    //Enviar correo
    Mail::to('alfredogalvan.91@gmail.com')->send(new SugerenciaEmail($mailData));

    return response()->json([
        'message' => 'Success'
    ], Response::HTTP_OK);
});
