<?php

namespace App\Ai\Agents;

use Laravel\Ai\Contracts\Agent;
use Laravel\Ai\Contracts\Conversational;
use Laravel\Ai\Contracts\HasTools;
use Illuminate\Contracts\JsonSchema\JsonSchema;
use Laravel\Ai\Contracts\Tool;
use Laravel\Ai\Messages\Message;
use Laravel\Ai\Promptable;
use Laravel\Ai\Contracts\HasStructuredOutput;
use Stringable;

class ConnectAi implements Agent, HasStructuredOutput
{
    use Promptable;

    /**
     * Get the instructions that the agent should follow.
     */
    public function instructions(): Stringable|string
    {
        return <<<PROMPT
        あなたは日本語レポートの文体チェック専門家です。
        送られてきたレポートを分析して、以下のルールに違反している箇所を全て見つけてください。

        【チェックするルール】
        1. である調・ですます調の混在（どちらかに統一されているか）
        2. 句読点のルール（読点の打ちすぎ・なさすぎ）
        3. 接続詞の文体不一致（「だが」「しかし」「でも」などの混在）
        4. 主語・述語のねじれ（意味が通じにくい文）
        【出力形式】
        必ずJSON配列のみを返してください。
        説明文・マークダウン・コードブロック（```）は一切不要です。
        JSON配列だけを返してください。

        [
            {
                "original": "指摘する文字列（レポート本文からそのまま抜き出す）",
                "suggestion": "修正後の文字列",
                "reason": "指摘理由（20文字以内）",
                "type": "混在|句読点|接続詞|ねじれ のどれか1つ"
            }
        ]

    指摘がない場合は空配列 [] を返してください。
    【重要な制約】
- "original" は必ずレポート本文から一字一句そのまま抜き出してください
- 前後の文脈を含めすぎず、問題のある最小限の文字列にしてください
- 句点（。）は含めないでください
- 要約・言い換え・省略は絶対にしないでください
PROMPT;
    }
    //Jsonにする
        public function schema(JsonSchema $schema): array
    {
        return [
            'suggestions' => $schema->array()
                ->items(
                    $schema->object(fn ($schema) => [
                        'original'   => $schema->string()->required(),
                        'suggestion' => $schema->string()->required(),
                        'reason'     => $schema->string()->required(),
                        'type'       => $schema->string()
                                            ->enum(['混在', '句読点', '接続詞', 'ねじれ'])
                                            ->required(),
                    ])
                )
                ->required(),
        ];
    }

    /**
     * Get the list of messages comprising the conversation so far.
     *
     * @return Message[]
     */
    public function messages(): iterable
    {
        return [];
    }

    /**
     * Get the tools available to the agent.
     *
     * @return Tool[]
     */
    public function tools(): iterable
    {
        return [];
    }
}
