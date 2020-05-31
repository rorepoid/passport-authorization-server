<div>
    <div class="rounded-lg shadow-lg bg-gray-800 w-full flex flex-row flex-wrap p-3 antialiased">
        <div class="w-1/3 flex items-center">
            <img class="sm:w-10/12 rounded-lg shadow-lg antialiased" src="{{ $user->avatar }}">
        </div>
        <div class="w-2/3 px-3 flex flex-row flex-wrap">
            <div class="w-full text-right text-gray-700 font-semibold pt-3 md:pt-0">
                <div class="text-2xl text-white leading-tight">
                    <span>{{ $user->name }}</span>
                </div>
                <div class="text-normal text-gray-300 hover:text-gray-400 cursor-pointer">
                    @forelse($user->roles as $role)
                        <span class="border-b border-dashed border-gray-500 pb-1 px-1 border-r-2">{{ $role->name }}</span>
                    @empty
                        Amazing user
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
