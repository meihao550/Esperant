<x-web-layout>
    <h1>新規投稿</h1>
    <form action="{{ route('forums.store')}}" method="POST" class="mt-4">
        @csrf
        <div class="mb-4">
            <label for="title" class="block text-gray-700">タイトル:</label>
            <input type="text" name="title" id="title"  value="{{ old('title')}}" class="w-full border border-gray-300 rounded px-4 py-2" minlength="5" maxlength="50" required>
            <label for="content" class="block text-gray-700 mt-4">内容:</label>
            <input type="text" name="content" id="content" value="{{ old('content')}}" class="w-full border border-gray-300 rounded px-4 py-2" minlength="4" maxlength="200" required>
            <input type="submit" value="投稿" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-4">
            <p>投稿者:{{ Auth::user()->name }}</p>
            @if ($errors->any())
                <div class="alert alert-danger mt-4">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    </form>
</x-web-layout>