<div class="container">

    <div class="flex items-center justify-center">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3">
            @foreach($users as $user)
                <div class="md:flex bg-white w-auto rounded-lg p-6 m-2 flex-wrap hover:shadow-2xl">
                    <a href="{{ route('users.show', ['id' => $user->id]) }}" class="w-full">
                        <img class="h-16 w-16 md:h-24 md:w-24 rounded-full mx-auto md:mx-0 md:mr-6 hover:shadow-2xl" src="{{ $user->avatar }}">
                    </a>
                    <div class="text-center md:text-left w-full">
                        <a href="{{ route('users.show', ['id' => $user->id]) }}">
                            <h2 class="text-lg">{{ $user->name }}</h2>
                        </a>
                        <div class="text-purple-500">&#64;{{ $user->username }}</div>
                        <div class="text-gray-600">{{ $user->email }}</div>
                        <div class="text-gray-600">(555) 765-4321</div>
                        <div class="border-black mt-2 flex">
                            <a href="/" class="flex-1 mx-1 px-2 bg-green-700 text-white rounded-lg py-1 font-bold hover:no-underline hover:bg-green-800">
                                Manage
                            </a>
                            <a href="/" class="flex-1 mx-1 px-2 bg-red-700 text-white rounded-lg py-1 font-bold hover:no-underline hover:bg-red-800">
                                Delete
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>