<div>
    <div class="w-full h-full flex flex-row flex-wrap p-3">
        <div class="mx-auto w-full md:w-2/3">
        <!-- Profile Card -->
            <div class="rounded-lg shadow-lg bg-gray-800 w-full flex flex-row flex-wrap p-3 antialiased">
            <div class="md:w-1/3 w-full">
                <img class="rounded-lg shadow-lg antialiased" src="{{ $user->avatar }}">
            </div>
            <div class="md:w-2/3 w-full px-3 flex flex-row flex-wrap">
                <div class="w-full text-right text-gray-700 font-semibold relative pt-3 md:pt-0">
                <div class="text-2xl text-white leading-tight">
                    <span>{{ $user->name }}</span>
                </div>
                <div class="text-normal text-gray-300 hover:text-gray-400 cursor-pointer"><span class="border-b border-dashed border-gray-500 pb-1">Administrator</span></div>
                <div class="text-sm text-gray-300 hover:text-gray-400 cursor-pointer md:absolute pt-3 md:pt-0 bottom-0 right-0">We can do awesome things</div>
                </div>
            </div>
            </div>
        <!--End Profile Card -->
        </div>
    </div>
</div>
