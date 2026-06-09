<x-web-layout>
    @auth
    <p>はい {{ Auth::user()->name }} です！</p>
    @else
    <p>ログインしていません。</p>
    @endauth

    <p>{{ request()->path() }}</p>
</x-web-layout>