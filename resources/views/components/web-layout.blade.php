<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Web App</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <nav class="bg-white shadow">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <a href="/" class="text-xl font-bold text-gray-800">My Web App</a>
            <div>
                @auth
                    <a href="/dashboard" class="text-gray-600 hover:text-gray-800 mr-4">Dashboard</a>
                    <form action="/logout" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="text-gray-600 hover:text-gray-800">Logout</button>
                    </form>
                @else
                    <a href="/auth/redirect" class="text-gray-600 hover:text-gray-800">Login with GitHub</a>
                @endauth        
            </div>
        </div>
    </nav>
    <main class="container mx-auto px-4 py-8">
        {{ $slot }}
    </main>
</body>
</html>