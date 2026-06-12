<?php

namespace App\Http\Controllers;

use App\Models\Forum;
use App\Models\Reply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ForumController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $forums = Forum::query()->paginate(5);

        return view('forum.index', [
            'forums' => $forums,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('forum.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|min:5|max:20',
            'content' => 'required|string|min:4|max:200',
        ]);

        $validated['author'] = Auth::user()->name;
        Forum::create($validated);

        return redirect('/forums')->with('success', '投稿が保存されました。');
    }

    /**
     * Display the specified resource.
     */
    public function show(Forum $forum)
    {
        $replies = $forum->replies()->orderBy('created_at', 'asc')->get();

        return view('forum.show', [
            'forum' => $forum,
            'replies' => $replies,
        ]);
    }

    /**
     * 返信用メソッド
     * リソースコントローラーとは別のメソッド
     * ForumModelにhasMany()を作っている。
     */
    public function reply(Request $request, Forum $forum)
    {
        $validated = $request->validate([
            'content' => 'required|string|min:1|max:200',
        ]);
        $validated['author'] = Auth::user()->name;
        $validated['forum_id'] = $forum->id;
        Reply::create($validated);

        return redirect()->route('forums.show', $forum);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Forum $forum)
    {
        if (Auth::user()->name !== $forum->author) {
            abort(404);
        }

        return view('forum.edit', ['forum' => $forum]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Forum $forum)
    {
        $validated = $request->validate([
            'title' => 'required|min:1',
            'content' => 'required|min:5',
        ]);
        $forum->update($validated);

        return redirect()->route('forums.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Forum $forum)
    {
        if (Auth::user()->name !== $forum->author) {
            abort(404);
        }

        /**
         * forumテーブルから行を削除する。
         */
        $forum->delete();

        return redirect()->route('forums.index');
    }
}
