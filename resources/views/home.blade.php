@extends('layouts.app')

@section('content')
<div x-data="personalAccessTokens()">
    <div class="lg:w-1/2">
        <div class="bg-blue-700 p-3 rounded-t-md">
            <div >
                <div class="grid sm:grid-cols-2">
                    <div class="col-span-1 flex flex-row">
                        <span class="text-white text-xl w-full sm:w-auto text-center font-bold">
                            Personal Access Tokens
                        </span>
                    </div>
                    <div x-data="modal()" class="col-span-1 flex sm:flex-row-reverse">
                        <button
                        class="flex-row-reverse w-full sm:w-auto text-white bg-green-700 p-2 rounded-md border-black"
                        tabindex="-1"
                        @click="
                            open()
                            $nextTick(()=>$refs.tokenName.focus())
                        ">
                            Create New Token
                        </button>
                        <livewire:oauth.create-personal-access-token>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-gray-300 p-3 rounded-b-md">
            <!-- No Tokens Notice -->
            <p x-show="data.tokens.length === 0">
                You have not created any personal access tokens.
            </p>

            <!-- Personal Access Tokens -->
            <table class="w-full" x-show="data.tokens.length > 0">
                <thead>
                    <tr>
                        <th class="px-4 py-2">Name</th>
                        <th class="px-4 py-2">Action</th>
                    </tr>
                </thead>

                <tbody>
                    <tr v-for="token in tokens" class="bg-gray-400 border-8 border-gray-600">
                        <!-- Client Name -->
                        <td class="text-lg px-4 py-2">
                        </td>

                        <!-- Delete Button -->
                        <td class="px-4 py-2">
                            <button class="bg-red-700 rounded px-3 text-white" @click="revoke(token)">
                                Delete
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    function personalAccessTokens(){
        return {
            data: {
                accessToken: null,

                tokens: [],
                scopes: [],

                form: {
                    name: '',
                    scopes: [],
                    errors: []
                },
            },
            modal: modal(),
        }
    }

    function modal() {
        return {
            show: false,
            open() { this.show = true },
            close() { this.show = false },
            isOpen() { return this.show === true },
        }
    }
</script>
@endsection
