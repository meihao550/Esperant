<x-web-layout>
    @auth
    <p>はい {{ Auth::user()->name }} です！</p>
    @else
    <p>ログインしていません。</p>
    @endauth
</x-web-layout>