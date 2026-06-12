<x-web-layout>

    {{-- @if (session('success'))
        <div class="alert alert-success flex justify-center items-center h-screen" id="flash-message">
            {{ session('success') }}
        </div>
    @endif --}}
    <div id="make-element">
        <h1>フォーラム</h1>
        <p>ここはフォーラムのページです。<br>
            大学の生徒同士の交流の場として、質問や情報交換ができます。</p>
        <h1 class="text-2xl mb-4">{{ $forums->total() }}件の投稿</h1>
        <div class="mb-4">
            <a href="{{ route('forums.create')}}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">新規投稿</a>
        </div>
        @auth
        <p class="mb-4">あなたのユーザーIDは{{ Auth::user()->name }}</p>
        @endauth
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
                    <td>
                        @if(Auth::user()->name === $forum->author)
                            <form action="{{ route('forums.destroy', $forum)}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <input type="submit" value="削除">
                            </form>
                        @endif
                    </td>
                    <td>
                        @if(Auth::user()->name === $forum->author)
                            <a href="{{ route('forums.edit', $forum) }}">編集</a>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-4">
            {{ $forums->links() }}
        </div>
    </div>
</x-web-layout>
