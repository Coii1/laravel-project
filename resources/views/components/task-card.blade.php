<a {{ $attributes->merge(['class' => 'card bg-neutral text-neutral-content w-96']) }}>
    <div class="card-body">
        <!-- <h2 class="card-title"></h2> -->
        <p>{{ $slot }}</p>
        <!-- <div class="card-actions justify-end">
            <button class="btn btn-primary">Accept</button>
            <button class="btn btn-ghost">Deny</button>
        </div> -->
    </div>
</a>