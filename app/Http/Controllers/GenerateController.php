<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GenerateController extends Controller
{
    public function index()
    {
        return view('generate');
    }

    public function generate(Request $request)
    {
        $valiable = $request->validate([
            'title' => 'required|string',
            'author' => 'required|string',
            'year' => 'required|integer',
            'publisher' => 'required|string',
        ]);
    }
}
