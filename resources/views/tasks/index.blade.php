<x-layout title="index">

    @if ($tasks->count())
        <div class="mt-6 text-white">
            <h2 class="font-bold">Your Tasks</h2>

            <ul class="mt-6 grid grid-cols-2 gap-x-6 gap-y-4">
                @foreach ($tasks as $task)
                    <x-task-card href="/tasks/{{ $task->id }}">
                        <div class="font-semibold">{{ $task->title }}</div>
                        <p class="mt-2 text-sm opacity-90">{{ \Illuminate\Support\Str::limit($task->description, 120) }}</p>
                        <div class="mt-3 flex gap-2 text-xs">
                            <span class="badge badge-outline">{{ str_replace('_', ' ', $task->status) }}</span>
                            <span class="badge badge-outline">{{ $task->priority }}</span>
                            @if ($task->due_date)
                                <span class="badge badge-outline">Due {{ $task->due_date->format('M d') }}</span>
                            @endif
                        </div>
                    </x-task-card>
                @endforeach
            </ul>
        </div>
    @else
        <div class="mt-6 text-white">
            <p>No tasks yet. Start by adding a new one. <a class="underline" href="/tasks/create">Create a task</a>
            </p>
        </div>
    @endif
</x-layout>