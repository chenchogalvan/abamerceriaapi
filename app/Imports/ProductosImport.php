<?php

namespace App\Imports;

use App\Models\Producto;
use Maatwebsite\Excel\Concerns\ToModel;

class ProductosImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {

        return new Producto([
            'sku' => $row[0],
            'lista1' => $row[1],
            'lista2' => $row[2],
            'lista3' => $row[3],
            'desc' => $row[4],
            'numero' => $row[5],
            'tamano' => $row[6],
            'colores' => $row[7],
            'unidad' => $row[8],
            'empaque' => $row[9]
        ]);
    }
}
