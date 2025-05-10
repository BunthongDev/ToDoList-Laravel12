<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>To-Do List</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-[#f5f5f7] min-h-screen flex justify-center items-start px-4 sm:px-6 lg:px-8 py-10 font-sans antialiased">
    <div class="bg-white shadow-xl rounded-2xl w-full max-w-xl p-6 sm:p-8">
        <h1 class="text-2xl sm:text-3xl font-semibold text-gray-900 mb-6 flex items-center justify-between">
            📝 To-Do List
        </h1>

        <!-- Add Task Form -->
        <form method="POST" action="/tasks" class="flex flex-col sm:flex-row gap-3 mb-8">
            @csrf
            <input type="text" name="title" placeholder="Add a new task..."
                class="flex-1 border-2 border-black rounded-xl px-4 py-2 text-sm sm:text-base focus:ring-2 focus:ring-blue-500 focus:outline-none transition"
                required>
            <button type="submit"
                class="bg-gray-900 hover:bg-gray-800 text-white px-5 py-2 rounded-xl text-sm sm:text-base transition">Add</button>
        </form>

        <!-- Task List -->
        <ul class="space-y-5">
            @foreach ($tasks as $task)
                <li class="border-2 border-dotted rounded-xl p-4 sm:p-5 shadow-sm transition hover:shadow-md">
                    <!-- Date Info -->
                    <div class="text-xs text-gray-400 mb-2">
                        <span>{{ $task->created_at->format('M d, Y h:i A') }}</span>
                        <span class="ml-2">({{ $task->created_at->diffForHumans() }})</span>
                    </div>



                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                        <div class="flex flex-col sm:flex-row sm:items-center gap-3">
                            <!-- Status Button -->
                            <form method="POST" action="/tasks/{{ $task->id }}/status">
                                @csrf
                                @method('PATCH')
                                <button
                                    class="text-sm font-medium
                                        {{ $task->status === 'done'
                                            ? 'text-green-600'
                                            : ($task->status === 'in_progress'
                                                ? 'text-yellow-600'
                                                : 'text-gray-500') }}
                                        hover:underline transition">
                                    @if ($task->status === 'done')
                                        ✅ Done
                                    @elseif ($task->status === 'in_progress')
                                        🔄 In Progress
                                    @else
                                        ⏳ Not Started
                                    @endif
                                </button>
                            </form>

                            <!-- Task Title -->
                            <span
                                class="{{ $task->status === 'done' ? 'line-through text-gray-400' : 'text-gray-800' }} text-sm sm:text-base font-bold">
                                {{ $task->title }}
                            </span>

                        </div>

                        <!-- Actions -->
                        <div class="flex gap-3 items-center">
                            <a href="/tasks/{{ $task->id }}/edit"
                                class="text-gray-500 hover:text-yellow-500 text-sm transition">✏️</a>

                            <form method="POST" action="/tasks/{{ $task->id }}">
                                @csrf
                                @method('DELETE')
                                <button class="text-gray-500 hover:text-red-500 text-sm transition">🗑️</button>
                            </form>
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
</body>

</html>
