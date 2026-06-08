<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('replies', function (Blueprint $table) {
            $table->id();
            $table->string('author');       // 投稿者名
            $table->text('content');        // 返信内容
            $table->foreignId('forum_id')  // どのスレッドへの返信か
               ->constrained()         // forumsテーブルのidと紐づけ
               ->cascadeOnDelete();    // スレッド削除時に返信も一緒に削除
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('replies');
    }
};
