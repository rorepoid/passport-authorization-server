<div class="max-w-sm flex justify-between bg-white w-auto rounded-lg p-6 m-2 hover:shadow-2xl">
    <a href="{{ route('users.show', ['id' => $user->id]) }}" class="flex flex-shrink-0 justify-center">
        <img class="h-16 w-16 md:h-24 md:w-24 rounded-full mx-auto md:mx-0 md:mr-6 hover:shadow-2xl" src="{{ $user->avatar }}">
    </a>
    <div class="text-center md:text-left flex-shrink">
        <a href="{{ route('users.show', ['id' => $user->id]) }}">
            <h2 class="text-lg truncate w-40">{{ $user->name }}</h2>
        </a>
        <div class="text-purple-500 truncate ">&#64;{{ $user->username }}</div>
    </div>
</div>