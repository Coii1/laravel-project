<x-layout title="index">

    @if ($ideas->count())
        <div class="mt-6 text-white">
            <h2 class="font-bold">Your Ideas</h2>

            <ul class="mt-6 grid grid-cols-2 gap-x-6 gap-y-4">
                @foreach ($ideas as $idea)
                    <x-idea-card href="/ideas/{{ $idea->id }}">
                        {{ $idea->description }}
                    </x-idea-card>
                @endforeach
            </ul>
        </div>
    @else
        <div class="mt-6 text-white">
            <p>No ideas yet. Start by adding a new idea above. <a class="underline" href="/ideas/create">Create an idea</a>
            </p>
        </div>
    @endif
</x-layout>