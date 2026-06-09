<x-web-layout>
    <p>Hello edit</p>
    <p>{{ $forum }}</p>
    <p>{{ request()->path() }}</p>
    <form action="{{ route('forums.update', $forum) }}" method="POST">
        @csrf
        @method('PUT')
        <input type="text" name="title" value="{{ old('title')}}" required>
        <input type="text" name="content" value="{{ old('content')}}" required>
        <input type="submit">
    </form>
</x-web-layout>