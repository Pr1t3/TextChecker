<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Тестовое задание</title>
</head>
<body class="bg-gray-100 font-sans">
    <div class="container mx-auto p-4">
        <h1 class="text-3xl font-bold text-center mb-8">Проверка текста</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h2 class="text-xl font-semibold mb-4">Ваш текст</h2>
                <form action="/store-text" method="post" onsubmit="syncTextarea()" id="checkForm">
                    @csrf
                    <div
                        id="userText"
                        data-has-user-text="{{ session()->has('user_text') ? 'true' : 'false' }}"
                        contenteditable="true"
                        class="w-full p-4 border border-gray-300 rounded-lg mb-4 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    >
                        {!! session('user_text') !!}
                    </div>

                    <textarea id="hiddenTextarea" name="userText" class="hidden"></textarea>

                    <input
                        type="submit"
                        value="Проверить"
                        class="w-full bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600 transition duration-200"
                    >
                </form>
            </div>

            <div class="bg-white p-6 rounded-lg shadow-md">
                <h2 class="text-xl font-semibold mb-4">История проверок</h2>
                <div class="space-y-4">
                    @foreach($history as $record)
                    <div class="border-b border-gray-200 pb-4">
                        <small class="text-sm text-gray-500">{{ $record->created_at }}</small>
                        <div class="mt-2 text-gray-700">{!! $record->text !!}</div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</body>
</html>