<div class="flex justify-center">
    <div class="grid sm:grid-cols-2 container">
        @forelse($sites as $site)
            <livewire:sites.site-component :site="$site" :key="$site->id">
        @empty
            <div class="w-full p-3 col-span-2">
                <h1 class="font-bold text-center text-4xl">You don't have or belong to any site</h1>
            </div>
        @endforelse
    </div>
</div>