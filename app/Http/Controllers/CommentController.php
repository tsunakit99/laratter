<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tweet;
use App\Models\Comment;
use Validator;

class CommentController extends Controller
{
    public function store(Request $request, Tweet $tweet)
    {
        $request->validate([
            'comment' => 'required|string',
        ]);

        $comment = new Comment();
        $comment->comment = $request->input('comment');
        $comment->tweet_id = $request->input('tweet_id'); // tweet_id をセット
        $comment->user_id = auth()->user()->id; // ログインユーザーの ID をセット
        $comment->save();

        return redirect()->back()->with('success', 'コメントが投稿されました。');
    }

    public function destroy($id)
    {
        $comment = Comment::find($id);
        $comment->delete(); // コメントを削除

        // 削除後にツイートの詳細画面にリダイレクト
        return redirect()->route('tweet.show', $comment->tweet_id);
    }

    public function edit($id)
    {
        $comment = Comment::find($id);
        return response()->view('comment.edit', compact('comment'));
    }

    public function update(Request $request, $id)
    {
        // バリデーション
        $validator = Validator::make($request->all(), [
            'comment' => 'required|max:255',
            // 必要に応じてバリデーションルールを調整
        ]);

        // バリデーション:エラー
        if ($validator->fails()) {
            return redirect()
                ->route('comment.edit', $id)
                ->withInput()
                ->withErrors($validator);
        }

        // データ更新処理
        $comment = Comment::find($id);
        $comment->comment = $request->input('comment'); // 必要に応じてフォームフィールドの名前を調整
        $comment->save();

        return redirect()->route('tweet.show', $comment->tweet_id);
    }

}