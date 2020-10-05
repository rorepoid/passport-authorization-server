<div class="w-full xl:flex justify-center py-1">
    <div
        class="h-48 xl:h-auto xl:w-48 flex-none bg-cover rounded-t xl:rounded-t-none xl:rounded-l text-center overflow-hidden"
        title="{{ $site->name }}">
        <img src="{{ $site->image }}"
            alt="github"
            srcset=""
            class="h-48 object-cover w-full">
    </div>
    <div class="border-r xl:max-w-xs border-b border-l border-grey-light xl:border-l-0 xl:border-t xl:border-grey-light bg-white rounded-b xl:rounded-b-none xl:rounded-r p-4 flex flex-col justify-between leading-normal">
        <div class="mb-8">
            <p class="text-sm text-grey-dark flex items-center">
                <svg class="text-grey w-3 h-3 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <path d="M4 8V6a6 6 0 1 1 12 0v2h1a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-8c0-1.1.9-2 2-2h1zm5 6.73V17h2v-2.27a2 2 0 1 0-2 0zM7 6v2h6V6a3 3 0 0 0-6 0z"/>
                </svg>
                Admins and Site Owners
            </p>
            <div class="text-black font-bold text-xl truncate mb-2">{{ $site->name }}</div>
            <div class="flex">
                @can("sites.{$site->id}.view")
                    <a href="{{ route('sites.show', ['site' => $site->id]) }}" class="text-center w-32 mx-2 cursor-pointer button bg-teal-500 hover:bg-teal-700 text-white font-bold py-2 px-4 rounded">
                        Details
                    </a>
                @endcan
                @can("sites.show.{$site->id}")
                    <button class="text-center w-32 mx-2 cursor-pointer button bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Manage
                    </button>
                @endcan
            </div>
        </div>
    </div>
</div>