<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Http\Requests\TaskRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class TaskController extends Controller
{
    private const STATUS_ORDER = ['backlog', 'todo', 'in_progress', 'done'];

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $statusFilterRaw = request('status', 'all');
        $statusFilter = is_string($statusFilterRaw) ? $statusFilterRaw : 'all';

        if ($statusFilter !== 'all' && !in_array($statusFilter, self::STATUS_ORDER, true)) {
            $statusFilter = 'all';
        }

        $tasks = Auth::user()
            ->tasks()
            ->orderByRaw("CASE status WHEN 'backlog' THEN 1 WHEN 'todo' THEN 2 WHEN 'in_progress' THEN 3 WHEN 'done' THEN 4 ELSE 5 END")
            ->orderBy('position')
            ->orderBy('created_at')
            ->get();

        $tasksByStatus = [
            'backlog' => $tasks->where('status', 'backlog')->values(),
            'todo' => $tasks->where('status', 'todo')->values(),
            'in_progress' => $tasks->where('status', 'in_progress')->values(),
            'done' => $tasks->where('status', 'done')->values(),
        ];

        return view('tasks.index', [
            'tasksByStatus' => $tasksByStatus,
            'statusFilter' => $statusFilter,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tasks.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TaskRequest $request)
    {
        $validated = $request->validated();

        $validated['position'] = $this->nextPosition($validated['status']);

        Auth::user()->tasks()->create($validated);

        return redirect('/tasks');
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        Gate::authorize('update', $task);

        return view('tasks.show', [
            'task' => $task
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        Gate::authorize('update', $task);

        return view('tasks.edit', [
            'task' => $task
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TaskRequest $request, Task $task)
    {
        Gate::authorize('update', $task);

        $validated = $request->validated();

        if ($task->status !== $validated['status']) {
            $validated['position'] = $this->nextPosition($validated['status']);
        }

        $task->update($validated);

        return redirect("/tasks/{$task->id}");
    }

    /**
     * Move task to the previous status column.
     */
    public function moveLeft(Task $task)
    {
        Gate::authorize('update', $task);

        $currentIndex = array_search($task->status, self::STATUS_ORDER, true);

        if ($currentIndex === false || $currentIndex === 0) {
            return redirect('/tasks');
        }

        $newStatus = self::STATUS_ORDER[$currentIndex - 1];

        $task->update([
            'status' => $newStatus,
            'position' => $this->nextPosition($newStatus),
        ]);

        return redirect('/tasks');
    }

    /**
     * Move task to the next status column.
     */
    public function moveRight(Task $task)
    {
        Gate::authorize('update', $task);

        $currentIndex = array_search($task->status, self::STATUS_ORDER, true);

        if ($currentIndex === false || $currentIndex === count(self::STATUS_ORDER) - 1) {
            return redirect('/tasks');
        }

        $newStatus = self::STATUS_ORDER[$currentIndex + 1];

        $task->update([
            'status' => $newStatus,
            'position' => $this->nextPosition($newStatus),
        ]);

        return redirect('/tasks');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        Gate::authorize('update', $task);

        $task->delete();

        return redirect('/tasks');
    }

    private function nextPosition(string $status): int
    {
        $maxPosition = Auth::user()
            ->tasks()
            ->where('status', $status)
            ->max('position');

        return $maxPosition === null ? 0 : $maxPosition + 1;
    }
}
