<x-layout title="create">
    <form method="post" action="/tasks" class="space-y-4">
        @csrf

        <div class="col-span-full">
            <label for="title" class="block text-sm/6 font-medium text-white">Task Title</label>
            <div class="mt-2">
                <input id="title" name="title" type="text" value="{{ old('title') }}"
                    class="input input-bordered w-full @error('title') input-error @enderror" />
                <x-forms.error name="title" />
            </div>
        </div>

        <div class="col-span-full">
            <label for="description" class="block text-sm/6 font-medium text-white">Task Description</label>
            <div class="mt-2">
                <textarea id="description" name="description" rows="3"
                    class="textarea textarea-bordered w-full @error('description') textarea-error @enderror">{{ old('description') }}</textarea>

                <x-forms.error name="description" />
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label for="due_date" class="block text-sm/6 font-medium text-white">Due Date</label>
                <div class="mt-2">
                    <input id="due_date" name="due_date" type="date" value="{{ old('due_date') }}"
                        class="input input-bordered w-full @error('due_date') input-error @enderror" />
                    <x-forms.error name="due_date" />
                </div>
            </div>

            <div>
                <label for="status" class="block text-sm/6 font-medium text-white">Status</label>
                <div class="mt-2">
                    <select id="status" name="status" class="select select-bordered w-full @error('status') select-error @enderror">
                        <option value="backlog" @selected(old('status', 'backlog') === 'backlog')>Backlog</option>
                        <option value="todo" @selected(old('status') === 'todo')>To Do</option>
                        <option value="in_progress" @selected(old('status') === 'in_progress')>In Progress</option>
                        <option value="done" @selected(old('status') === 'done')>Done</option>
                    </select>
                    <x-forms.error name="status" />
                </div>
            </div>

            <div>
                <label for="priority" class="block text-sm/6 font-medium text-white">Priority</label>
                <div class="mt-2">
                    <select id="priority" name="priority" class="select select-bordered w-full @error('priority') select-error @enderror">
                        <option value="low" @selected(old('priority') === 'low')>Low</option>
                        <option value="medium" @selected(old('priority', 'medium') === 'medium')>Medium</option>
                        <option value="high" @selected(old('priority') === 'high')>High</option>
                    </select>
                    <x-forms.error name="priority" />
                </div>
            </div>

            <div>
                <label for="position" class="block text-sm/6 font-medium text-white">Position</label>
                <div class="mt-2">
                    <input id="position" name="position" type="number" min="0" value="{{ old('position', 0) }}"
                        class="input input-bordered w-full @error('position') input-error @enderror" />
                    <x-forms.error name="position" />
                </div>
            </div>
        </div>

        <div class="mt-6 flex items-center gap-x-6">
            <button type="submit"
                class="rounded-md bg-indigo-500 px-3 py-2 text-sm font-semibold text-white focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">Save</button>
        </div>
    </form>
</x-layout>