@extends('layouts.app')
@section('background', 'bg-blue-800')
@section('content')
<div class="flex justify-center">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css" rel="stylesheet">
    <div class="bg-blue-800 container">
        <div class="w-full h-full flex flex-wrap">
            <div class="sm:py-4 w-64 sm:h-auto ">
                <div x-data="{ hidden: true }">
                    <div class="lg:hidden">
                        <button
                            class="bg-gray-200 text-left text-2xl font-bold p-2 rounded-lg px-4 "
                            @click="hidden = !hidden">
                            <i class="w-8 fas fa-bars p-2 bg-gray-200 rounded-full"></i>
                        </button>
                    </div>
                    <div :class="{ 'lg:block' : hidden, 'hidden' : hidden }" class="h-full">
                        <div
                            class="absolute lg:relative w-64 lg:w-full sm:block sm:h-auto h-full py-4 px-2 text-gray-900 bg-white rounded-lg text-left capitalize font-medium shadow-lg">
                            <a href="{{ route('settings.profile') }}">
                                <button class="w-full cursor-pointer px-2 py-1 hover:bg-gray-200 hover:text-gray-700 rounded block mb-2">
                                    <span class="mx-2">Profile</span>
                                </button>
                            </a>
                            <a href="{{ route('settings.account') }}" class="select-none">
                                <button class="w-full cursor-pointer px-2 py-1 hover:bg-gray-200 hover:text-gray-700 rounded block mb-2">
                                    <span class="mx-2">Account</span>
                                </button>
                            </a>
                        </div>

                    </div>
                </div>
            </div>
            <div class="bg-gray-400 border-4 rounded-lg shadow-lg w-full lg:w-2/3 m-3 p-2">
                <div class="container">
                    @yield('setting')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection