<x-web-layout>
    <p>Hello edit</p>
    <p>{{ $forum }}</p>
    <form action="{{ route('forums.update', $forum) }}" method="POST">
        @csrf
        @method('PUT')
        <input type="text" name="title" required>
        <input type="text" name="content" required>
        <input type="submit">
    </form>
</x-web-layout>