<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Venta;

class VentaController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function store(Request $request)
    {
        Venta::create($request->all());
        return redirect('/');
    }

    public function datos()
    {
        $ventas = Venta::selectRaw('producto, SUM(cantidad) as total')
                        ->groupBy('producto')
                        ->get();

        return response()->json($ventas);
    }
}
