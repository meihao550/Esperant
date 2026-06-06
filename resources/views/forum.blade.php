<x-web-layout>
    <h1>フォーラム</h1>
    <p>ここはフォーラムのページです。<br>
        大学の生徒同士の交流の場として、質問や情報交換ができます。</p>
    <h1 class="text-2xl mb-4">{{ $forums->count() }}件の投稿</h1>
    <div class="mb-4">
        <a href="{{ route('forums.create')}}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">新規投稿</a>
    </div>
    <p class="mb-4">あなたのユーザーIDは{{ auth()->user()->name }}</p>
    <table class="min-w-full bg-white">
            <thead>
                <tr>
                    <th class="py-2 px-4 border-b">タイトル</th>
                    <th class="py-2 px-4 border-b">内容</th>
                </tr>
            </thead>
        <tbody>
            @foreach ($forums as $forum)
            <tr>
                <td class="py-2 px-4 border-b">
                    <a href="{{ route('forums.show', $forum) }}" class="text-blue-500 hover:underline">{{ $forum->title }}</a>
                </td>
                <td>{{ $forum->content }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</x-web-layout>