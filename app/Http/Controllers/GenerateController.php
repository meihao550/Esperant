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
        $input = $request->all();
        // ここで参考文献の生成ロジックを実装
        // 例: $references = ReferenceGenerator::generate($input);
        // 生成された参考文献をビューに渡す
        return view('generate', ['references' => $references]);
    }
}
