<!DOCTYPE html>
<html lang="en" class="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <title>Abas Merceria</title>


    <link rel="stylesheet" href="https://unpkg.com/@themesberg/flowbite@1.3.0/dist/flowbite.min.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.css">

</head>

<body class="text-slate-500 dark:text-slate-400 bg-white dark:bg-slate-900">

    <div class="container rounded-lg p-4 mt-5 dark:bg-slate-800">
        @if (Session::has('success'))
        <p class="block mb-2 text-sm font-medium dark:text-slate-300">{{ Session::get('success') }}</p>
        @endif

        @if ($datos->count() == 0)

        <form action="{{ route('productos.importar') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="mb-6">
                <label for="file" class="block mb-2 text-sm font-medium dark:text-slate-300">Selecciona un archivo</label>
                <input type="file" name="file" id="file" class="block w-full dark:bg-slate-900 rounded-lg border dark:border-slate-600 cursor-pointer focus:outline-none focus:border-transparent ">
            </div>

            <button class="dark:bg-violet-900 p-2 pl-4 pr-4 rounded-lg dark:hover:bg-violet-700 dark:text-slate-50 transition dark:disabled:opacity-75 disabled:opacity-75" >Cargar documento<button>
        </form>

        @else

        <div class="flex flex-col">

            <div class="bg-white dark:bg-slate-600 shadow overflow-hidden sm:rounded-lg">
                <div class="px-4 py-4 sm:px-6">
                    <h3 class="text-lg leading-6 font-medium text-slate-50">
                        Información
                    </h3>
                    <p class="mt-1 leading-6 font-medium dark:text-slate-50">Información cargada actualmente a la Base de Datos</p>
                </div>

                <div class="border-t border-gray-200 dark:border-slate-700">
                    <dl>
                        <div class="bg-gray-50 dark:bg-slate-500 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-50">
                                Total de productos cargados
                            </dt>
                            <dd class="mt-1 text-sm text-gray-50 sm:mt-0 sm:col-span-2">
                                {{ $datos->count() }} productos en la base de datos
                            </dd>
                        </div>
                        <div class="bg-gray-50 dark:bg-slate-600 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-50">
                                Fecha de actualización
                            </dt>
                            <dd class="mt-1 text-sm text-gray-50 sm:mt-0 sm:col-span-2">
                                {{ $fecha->created_at }}
                            </dd>
                        </div>
                        <div class="bg-gray-50 dark:bg-slate-500 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-50">
                                Archivo de descarga
                            </dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                <ul role="list" class="border border-gray-200 rounded-md divide-y divide-gray-200">
                                    <li class="pl-3 pr-4 py-3 flex items-center justify-between text-sm">
                                    <div class="w-0 flex-1 flex items-center">
                                        <!-- Heroicon name: solid/paper-clip -->
                                        <svg class="flex-shrink-0 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd" d="M8 4a3 3 0 00-3 3v4a5 5 0 0010 0V7a1 1 0 112 0v4a7 7 0 11-14 0V7a5 5 0 0110 0v4a3 3 0 11-6 0V7a1 1 0 012 0v4a1 1 0 102 0V7a3 3 0 00-3-3z" clip-rule="evenodd" />
                                        </svg>
                                        <span class="ml-2 flex-1 w-0 truncate text-gray-50">
                                        productos-aplicacion.pdf
                                        </span>
                                    </div>
                                    <div class="ml-4 flex-shrink-0">
                                        <button class="dark:bg-violet-900 p-2 pl-4 pr-4 rounded-lg dark:hover:bg-violet-700 dark:text-slate-50 transition dark:disabled:opacity-75 disabled:opacity-75">Descargar archivo</button>
                                    </div>
                                    </li>
                                </ul>
                            </dd>
                        </div>
                        <div class="bg-gray-50 dark:bg-slate-600 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-50">
                                Eliminar carga de archivos
                            </dt>
                            <dd class="mt-1 text-sm text-gray-50 sm:mt-0 sm:col-span-2">
                                <p class="pb-4">Antes de eliminar la carga, es recomendable descargar el archivo actual para cualquier eventualidad. Una vez hecho, puedes proceder a eliminar dando clic en el siguiente boton:</p>
                                <form action="{{ route('eliminar.productos') }}" method="post">
                                    @csrf
                                    <button class="dark:bg-violet-900 p-2 pl-4 pr-4 rounded-lg dark:hover:bg-violet-700 dark:text-slate-50 transition dark:disabled:opacity-75 disabled:opacity-75" onclick="confirm('¿Estas seguro que deseas eliminar la información?')">Eliminar información de la base de datos<button>
                                </form>
                            </dd>
                        </div>
                    </dl>
                </div>
            </div>



        </div>


        @endif





    </div>





    {{-- <form action="{{ route('productos.importar') }}" method="post" enctype="multipart/form-data">
        @csrf
        @if (Session::has('success'))
        <p>{{ Session::get('success') }}</p>
        @endif
        <input type="file" name="productos">
        <button>importar usuarios</button>

    </form> --}}

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://unpkg.com/@themesberg/flowbite@1.3.0/dist/flowbite.bundle.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.js"></script>

    <script>
        $(document).ready(function () {
            $('#dataTable').DataTable();

        });
    </script>

</body>

</html>
