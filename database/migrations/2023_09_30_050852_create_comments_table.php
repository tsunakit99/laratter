<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('tweet_id'); // tweet_id カラムを追加
            $table->text('comment');
            $table->timestamps();

            // tweet_id カラムに外部キー制約を設定
            $table->foreign('tweet_id')->references('id')->on('tweets')->onDelete('cascade');

            // user_id カラムに外部キー制約を設定（ユーザーとコメントの関連付け）
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};