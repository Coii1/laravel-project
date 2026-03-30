<x-layout title="Task Board" mainClass="max-w-[95rem] mx-auto mt-6 px-4">
    @php
        $columns = [
            'backlog' => 'Backlog',
            'todo' => 'To Do',
            'in_progress' => 'In Progress',
            'done' => 'Done',
        ];

        $statusFilter = isset($statusFilter) && is_string($statusFilter) ? $statusFilter : 'all';

        if ($statusFilter !== 'all' && !array_key_exists($statusFilter, $columns)) {
            $statusFilter = 'all';
        }

        $filterLabel = $statusFilter === 'all' ? 'All Tasks' : ($columns[$statusFilter] ?? 'All Tasks');
        $visibleColumns = $statusFilter === 'all' ? $columns : [$statusFilter => ($columns[$statusFilter] ?? 'Tasks')];
    @endphp

    <div class="mt-6 text-white">
        <div class="flex items-center justify-between gap-4">
            <div>
                <h2 class="font-bold text-lg">Your Task Board</h2>
                <p class="text-sm text-gray-300 mt-1">Viewing: {{ $filterLabel }}</p>
            </div>
            <a href="/tasks/create" class="btn btn-sm btn-primary">New Task</a>
        </div>

        <div class="mt-4">
            <div class="tabs tabs-boxed bg-base-200 inline-flex">
                <a href="/tasks" class="tab {{ $statusFilter === 'all' ? 'tab-active' : '' }}">All</a>
                @foreach ($columns as $statusKey => $statusLabel)
                    <a href="/tasks?status={{ $statusKey }}" class="tab {{ $statusFilter === $statusKey ? 'tab-active' : '' }}">{{ $statusLabel }}</a>
                @endforeach
            </div>
        </div>

        <div class="mt-6 grid grid-cols-1 {{ $statusFilter === 'all' ? 'lg:grid-cols-4' : 'lg:grid-cols-1' }} gap-4">
            @foreach ($visibleColumns as $statusKey => $statusLabel)
                @php
                    $columnTasks = $tasksByStatus[$statusKey] ?? collect();
                @endphp

                <section class="rounded-lg bg-base-200 p-4">
                    <div class="flex items-center justify-between">
                        <h3 class="font-semibold">{{ $statusLabel }}</h3>
                        <span class="badge badge-outline">{{ $columnTasks->count() }}</span>
                    </div>

                    <div class="mt-4 space-y-3">
                        @forelse ($columnTasks as $task)
                            <x-task-card href="/tasks/{{ $task->id }}">
                                <div class="font-semibold">{{ $task->title }}</div>
                                <p class="mt-2 text-sm opacity-90">{{ \Illuminate\Support\Str::limit($task->description, 110) }}</p>

                                <div class="mt-3 flex flex-wrap gap-2 text-xs">
                                    <span class="badge badge-outline">{{ $task->priority }}</span>
                                    @if ($task->due_date)
                                        <span class="badge badge-outline">Due {{ $task->due_date->format('M d') }}</span>
                                    @endif
                                </div>

                                <div class="mt-3 flex gap-2">
                                    @if ($task->status !== 'backlog')
                                        <form method="POST" action="/tasks/{{ $task->id }}/move-left">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-xs btn-outline">Left</button>
                                        </form>
                                    @endif

                                    @if ($task->status !== 'done')
                                        <form method="POST" action="/tasks/{{ $task->id }}/move-right">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-xs btn-outline">Right</button>
                                        </form>
                                    @endif
                                </div>
                            </x-task-card>
                        @empty
                            <div class="rounded-lg border border-base-300 p-3 text-sm text-gray-300">
                                No tasks in this column.
                            </div>
                        @endforelse
                    </div>
                </section>
            @endforeach
        </div>
    </div>
</x-layout>