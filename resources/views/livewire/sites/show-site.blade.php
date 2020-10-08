<div class="w-full h-full flex justify-center">
    <div class="container p-5">
        <div class="flex flex-wrap lg:justify-between">
            <div>
                <h2 class="text-5xl font-bold">{{ $site->name }}</h2>
                <h2 class="text-xl mt-1"><b>Creator:</b> {{ $user->name }}</h2>
                <h2 class="text-xl mt-1"><b>Description:</b> {{ $site->description }}</h2>
            </div>
            <div>
                <img src="{{ $site->image }}" alt="{{ $site->name }}"
                    class="mt-1 rounded-lg max-h-xs max-w-xs">
            </div>
        </div>
        <div class="pt-16">
            <div class="text-2xl font-semibold mb-4" wire:init="loadUsers">List of users</div>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3">
                    @forelse($site->users as $user)
                        <livewire:user.user-rectangle-card :user="$user" :key="$user->id">

                    @empty
                        <div class="text-xl text-red-900 font-bold">This site has not any user</div>
                    @endforelse
            </div>
        </div>
    </div>
</div>
