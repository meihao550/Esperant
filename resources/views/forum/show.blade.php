<x-web-layout>
    <h1>{{ $forum->title }}</h1>
    <p>{{ $forum->content }}</p>
    <p>投稿者: {{ $forum->author }}</p>

    <form action="{{ route('forums.reply', $forum)}}" method="POST">
        @csrf
       <h2 class="text-xl mt-6 mb-4">返信投稿</h2>
       <input type="text" name="content">
       <input type="submit">
    </form>

    <h2 class="text-xl mt-6 mb-4">返信</h2>
    
    @foreach ($replies as $reply)
        <div class="border border-gray-300 rounded p-4 mb-4">
            <p>{{ $reply->content }}</p>
            <p class="text-sm text-gray-500">返信者: {{ $reply->author }} | {{ $reply->created_at?->format('Y-m-d H:i') }}</p>
        </div>
    @endforeach
</x-web-layout>