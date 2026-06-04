<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Web App</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <nav class="bg-white shadow">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <a href="/" class="text-xl font-bold text-gray-800">Esperante</a>
            <div>
                @auth
                    <a href="#" class="text-gray-600 hover:text-gray-800 mr-4">掲示板へ</a>
                    <form action="/logout" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="text-gray-600 hover:text-gray-800">ログアウト</button>
                    </form>
                @else
                    <a href="#" class="text-gray-600 hover:text-gray-800 mr-4">レポート作成</a>
                    <a href="/auth/redirect" class="text-gray-600 hover:text-gray-800">GitHubでログイン</a>
                @endauth        
            </div>
        </div>
    </nav>
    <main class="container mx-auto px-4 py-8 pb-16">
        {{ $slot }}
    </main>
</body>
</html>