<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Edit Task</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-[#f5f5f7] min-h-screen flex justify-center items-start px-4 sm:px-6 lg:px-8 py-10 font-sans antialiased">
    <div class="bg-white shadow-xl rounded-2xl w-full max-w-xl p-6 sm:p-8">
        <h1 class="text-2xl sm:text-3xl font-semibold text-gray-900 mb-6 flex items-center justify-between">
            ✏️ Edit Task
        </h1>

        <form method="POST" action="/tasks/{{ $task->id }}" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Task Title</label>
                <input type="text" name="title" id="title" value="{{ $task->title }}" required
                    class="w-full border border-gray-300 rounded-xl px-4 py-2 text-sm sm:text-base focus:ring-2 focus:ring-blue-500 focus:outline-none transition shadow-sm">
            </div>

            <div class="flex gap-3">
                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-xl text-sm sm:text-base transition shadow-sm">
                    Update Task
                </button>
                <a href="/" class="text-sm text-gray-500 hover:text-blue-500 transition px-4 py-2">
                    ← Cancel
                </a>
            </div>
        </form>
    </div>
</body>

</html>
