<x-layout>
    <div>
        <header class="py-8 md:py-12">
            <h1 class="text-3xl font-bold">Ideas</h1>
            <p class="text-muted-foreground text-sm mt-2">Capture your ideas</p>
        </header>

        <div class="mt-10">
            @forelse ($ideas as $idea)
                <p>{{ $idea->description }}</p>
            @empty
                <p>Nothing to show here</p>
            @endforelse
        </div>
    </div>
</x-layout>