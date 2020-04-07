@extends('layouts.app')
@section('content')
<div class="h-full">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css" rel="stylesheet">
    <div class="bg-gray-200 h-full md:p-10 flex flex-wrap sys-app-notCollapsed ">
        <div class="sm:pr-4 w-full h-full flex flex-wrap md:flex-col">
            <div class="sm:py-4 w-64 sm:h-auto ">
                <div x-data="{ hidden: true }">
                    <div class="md:hidden">
                        <button
                            class="bg-gray-200 text-left text-2xl font-bold p-2 rounded-lg px-4 "
                            @click="hidden = !hidden">
                            <i class="w-8 fas fa-bars p-2 bg-gray-200 rounded-full"></i>
                        </button>
                    </div>
                    <div :class="{ 'md:block' : hidden, 'hidden' : hidden }" class="h-full">
                        <div
                            class="absolute md:relative w-64 md:w-full sm:block sm:h-auto h-full py-4 px-2 text-gray-900 bg-white rounded-lg text-left capitalize font-medium shadow-lg">
                            <span wire:click="goToProfile" class="cursor-pointer px-2 py-1 hover:bg-gray-200 hover:text-gray-700 rounded block mb-2">
                                <span class="w-8 mb-5 relative">
                                </span>
                                <span class="mx-2">Profile</span>
                            </span>
                            <span class="cursor-pointer px-2 py-1 hover:bg-gray-200 hover:text-gray-700 rounded block mb-2">
                                <span class="w-8 mb-5 relative">
                                </span>
                                <span class="mx-2">Account</span>
                            </span>
                        </div>

                    </div>
                </div>
            </div>
            <div class="bg-gray-400 w-full md:w-2/3 h-full m-3">
                <div class="container">
                    @yield('setting')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection