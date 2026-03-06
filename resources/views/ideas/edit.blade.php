<x-layout title="index">
    <form method="POST" action="/ideas/{{ $idea->id }}">
        @csrf
        @method('PATCH')

        <div class="col-span-full">
            <label for="description" class="block text-sm/6 font-medium text-white">Edit your Idea</label>
            <div class="mt-2">
                <textarea id="description" name="description" rows="3"
                    class="textarea textarea-bordered w-full"
                > {{ $idea->description }}</textarea>
                <x-forms.error name="description" />
            </div>
        </div>

        <div class="mt-6 flex items-center gap-x-2">
            <button type="submit"
                class="rounded-md bg-indigo-500 px-3 py-2 text-sm font-semibold text-white focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">Update</button>
            <button type="submit" form="delete-form"
                class="rounded-md bg-red-500 px-3 py-2 text-sm font-semibold text-white focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">Delete</button>

        </div>
    </form>

    <form method="POST" action="/ideas/{{ $idea->id }}" class="mt-2" id="delete-form">
        @csrf
        @method('DELETE')
    </form>
</x-layout>