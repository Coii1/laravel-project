<x-layout title="create">
    <form method="post" action="/ideas">
        @csrf

        <div class="col-span-full">
            <label for="description" class="block text-sm/6 font-medium text-white">Create a New Idea</label>
            <div class="mt-2">
                <textarea id="description" name="description" rows="3"
                    class="textarea textarea-bordered w-full @error('description') textarea-error @enderror"></textarea>

                <x-forms.error name="description" />
            </div>
            <p class="mt-3 text-sm/6 text-gray-400">Write a few sentences about your idea.</p>
        </div>

        <div class="mt-6 flex items-center gap-x-6">
            <button type="submit"
                class="rounded-md bg-indigo-500 px-3 py-2 text-sm font-semibold text-white focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">Save</button>
        </div>
    </form>
</x-layout>