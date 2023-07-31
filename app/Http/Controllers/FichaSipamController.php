<?php

namespace App\Http\Controllers;

use App\Models\Militar;
use Illuminate\Http\Request;

class FichaSipamController extends Controller
{
    //
    public function index(Request $request, $id)
    {
        $militar = Militar::find($id);
        return view('ficha_sipam.index', compact('militar'));
    }
}
