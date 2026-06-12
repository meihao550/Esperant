<?php

namespace App\Http\Controllers;

use App\Ai\Agents\ConnectAi;
use Illuminate\Http\Request;

class GeminiTestController extends Controller
{
    public function index()
    {
        return view('gemini.test');
    }

    public function review(Request $request)
    {
        $request->validate([
            'report' => 'required|string|min:2',
        ]);
        // ── ダミーデータ（レート制限中のテスト用） ──────────
        // 1-1 本番に戻すときはここをコメントアウトして1-2のコードを使う
        /* $suggestions = [
            [
                'original'   => '思います',
                'suggestion' => '考える',
                'reason'     => 'である調に統一',
                'type'       => '混在',
            ],
            [
                'original'   => 'とても大切だと',
                'suggestion' => '非常に重要だと',
                'reason'     => '口語表現',
                'type'       => 'ねじれ',
            ],
            [
                'original'   => 'です。しかし',
                'suggestion' => 'である。しかし',
                'reason'     => '文末がですます調',
                'type'       => '混在',
            ],
            [
                'original'   => 'でも',
                'suggestion' => 'しかし',
                'reason'     => '接続詞の混在',
                'type'       => '接続詞',
            ],
        ]; */
        // 1-2 本番やテストの際オンにする。レート制限回避用
        $response = (new ConnectAi)
            ->prompt($request->report,
                timeout: 120,
            );

        $suggestions = $response['suggestions'];

        return view('gemini.test', [
            'suggestions' => $suggestions,
            'original' => $request->report,
        ]);

    }
}
