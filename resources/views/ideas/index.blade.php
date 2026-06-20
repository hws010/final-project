<x-layout>
    <div>
        <header class="py-8 md:py-12">
            <h1 class="text-3xl font-bold">Ideas</h1>
            <p class="text-muted-foreground text-sm mt-2">Capture your ideas</p>
            
            <x-card
                x-data
                @click="$dispatch('open-modal', 'create-idea')"
                is="button"
                type="button"
                class="mt-10 cursor-pointer h-32 w-full text-left"
            >
                <p>What's the idea?</p>
            </x-card>
        </header>

        <div class="mt-10 text-muted-foreground">
            <div class="mb-4">
                <a href="{{ route('ideas-index') }}" class="btn {{ request('status') ? 'btn-outlined' : '' }}">All</a>
                @foreach (App\IdeaStatus::cases() as $status)
                    <a href="{{ route('ideas-index') . '?status=' . $status->value }}" 
                        class="btn {{ request('status') === $status->value ? '' : 'btn-outlined' }}"
                        >
                        {{ $status->lable() }} <span class="text-xs pl-3">{{ $statusCount[$status->value] }}</span>
                    </a>
                @endforeach
            </div>

            <div class="grid md:grid-cols-2 gap-6">
                @forelse ($ideas as $idea)
                    <x-card href="{{ route('ideas-show', $idea) }}">
                        <h3 class="text-foreground text-lg">{{ $idea->title }}</h3>
                        <div class="mt-1">
                            <x-idea.status-lable status="{{ $idea->status }}">{{ $idea->status->lable() }}</x-idea.status-lable>
                        </div>

                        <div class="mt-5 line-clamp-3">{{ $idea->description }}</div>
                        <div class="mt-4">{{ $idea->created_at->diffForHumans() }}</div>
                    </x-card>
                @empty
                    <x-card>
                        title
                    </x-card>
                @endforelse
            </div>
        </div>

        <!-- create model -->
        <x-modal name="create-idea" title="New idea">

            <form 
                x-data="{ 
                        currentStatus: '{{ \App\IdeaStatus::PENDING->value }}',
                        newLink: '',
                        links: [],
                        newStep: '',
                        steps: []
                    }" 
                action="{{ route('ideas-create') }}" method="post">
                @csrf
                <div class="space-y-6">
                    <x-form.field 
                        lable="Title"
                        name="title"
                        placeholder="Input the title of your idea"
                        type="text"
                        extra="required"
                    />
                    
                    <div>
                        <label for="status" class="label mb-2">Status</label>
    
                        <div class="flex gap-x-3">
                            @foreach (\App\IdeaStatus::cases() as $status)
                                <button 
                                    type="button" 
                                    @click="currentStatus = @js($status->value)"
                                    class="btn flex-1 h-10"
                                    :class="currentStatus !== '{{ $status->value }}' ? 'btn-outlined' : ''"
                                >
                                    {{ $status->lable() }}
                                </button>
                            @endforeach
                        </div>
    
                        <input type="hidden" name="status" :value="currentStatus">
    
                        <x-form.error name="status" />
                    </div>
    
                    <x-form.field 
                        lable="Description"
                        name="description"
                        placeholder="Describe your idea..."
                        type="textarea"
                    />

                    <!-- Steps -->
                    <div>
                        <fieldset class="space-y-3">
                            <legend class="label">Steps</legend>

                            <div class="flex gap-x-2 items-center">
                                <input 
                                    x-model="newStep"
                                    id="new-step"
                                    placeholder="Step to finish your idea successfuly"
                                    class="input flex-1"
                                    spellcheck="false"
                                >

                                <button 
                                    type="button" class="text-2xl"
                                    @click="steps.push(newStep.trim()); newStep = '';" 
                                    :disabled="newStep.trim().length === 0"
                                    aria-label="Add a new step"
                                >
                                    +
                                </button>

                            </div>

                            <template x-for="(step, index) in steps" :key="step">
                                <div class="flex gap-x-2 items-center">
                                    <input name="steps[]" x-model="step" class="input">

                                    <button
                                        style="rotate: 45deg"
                                        type="button" class="text-2xl text-red-500"
                                        aria-label="Remove link"
                                        @click="steps.splice(index, 1)"
                                    >+</button>
                                </div>
                            </template>
                        </fieldset>
                    </div>

                    <!-- Links -->
                    <div>
                        <fieldset class="space-y-3">
                            <legend class="label">Links</legend>

                            <div class="flex gap-x-2 items-center">
                                <input 
                                    x-model="newLink"
                                    type="url"
                                    id="new-link"
                                    placeholder="http://example.com"
                                    autocomplete="url"
                                    class="input flex-1"
                                    spellcheck="false"
                                >

                                <button 
                                    type="button" class="text-2xl"
                                    @click="links.push(newLink.trim()); newLink = '';" 
                                    :disabled="newLink.trim().length === 0"
                                    aria-label="Add a new link"
                                >
                                    +
                                </button>

                            </div>

                            <template x-for="(link, index) in links" :key="link">
                                <div class="flex gap-x-2 items-center">
                                    <input name="links[]" x-model="link" class="input">

                                    <button
                                        style="rotate: 45deg"
                                        type="button" class="text-2xl text-red-500"
                                        aria-label="Remove link"
                                        @click="links.splice(index, 1)"
                                    >+</button>
                                </div>
                            </template>
                        </fieldset>
                    </div>
    
                    <div class="flex justify-end gap-x-5">
                        <button 
                            class="btn btn-outlined"
                            @click="show = false"
                            type="button"
                        >Cancel</button>
                        <button 
                            type="submit" 
                            class="btn btn-outlined"
                        >Create</button>
                    </div>
                </div>
            </form>
        </x-modal>

    </div>
</x-layout>