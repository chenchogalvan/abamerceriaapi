<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $fillable = [
        'sku',
        'lista1',
        'lista2',
        'lista3',
        'desc',
        'numero',
        'tamano',
        'colores',
        'unidad',
        'empaque',
        'sku_prove'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];



}
