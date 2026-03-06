<x-layout title="show"> 
    <div class="card bg-neutral p-6">
        <div>
            <div>{{ $idea->description }}</div>
        </div>
    
        <div class="mt-6">
            <a href="/ideas/{{ $idea->id }}/edit" 
                class="btn btn-primary">
                Edit
            </a>
        </div>
    </div>
</x-layout>