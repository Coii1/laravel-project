<x-layout title="show"> 
    <div class="card bg-neutral p-6">
        <div>
            <h2 class="text-xl font-bold">{{ $task->title }}</h2>
            <p class="mt-3">{{ $task->description }}</p>
            <div class="mt-4 flex gap-2 text-xs">
                <span class="badge badge-outline">{{ str_replace('_', ' ', $task->status) }}</span>
                <span class="badge badge-outline">{{ $task->priority }}</span>
                @if ($task->due_date)
                    <span class="badge badge-outline">Due {{ $task->due_date->format('M d, Y') }}</span>
                @endif
                <span class="badge badge-outline">#{{ $task->position ?? 0 }}</span>
            </div>
        </div>
    
        <div class="mt-6">
            <a href="/tasks/{{ $task->id }}/edit" 
                class="btn btn-primary">
                Edit
            </a>
        </div>
    </div>
</x-layout>