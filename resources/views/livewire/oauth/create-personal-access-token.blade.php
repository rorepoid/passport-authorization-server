<div>
    <div x-show="isOpen()">
        <!--Modal-->
        <!-- opacity-0 pointer-events-none -->
        <div class="modal fixed w-full h-full top-0 left-0 flex items-center justify-center"
             style="display: none"
             x-show="open"
             @click.away="open = false"
        >
            <div class="modal-overlay absolute w-full h-full bg-gray-900 opacity-50"></div>

            <div class="modal-container bg-white w-11/12 md:max-w-md mx-auto rounded shadow-lg z-50 overflow-y-auto">

                <!-- Add margin if you want to see some of the overlay behind the modal-->
                <div class="modal-content py-4 text-left px-6">
                    <!--Title-->
                    <div class="flex justify-between items-center pb-3">
                        <p class="text-2xl font-bold">Create Token</p>
                        <div x-on:click="close" class="modal-close cursor-pointer z-50">
                            <svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="18"
                                 height="18" viewBox="0 0 18 18">
                                <path
                                    d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
                            </svg>
                        </div>
                    </div>

                    <!--Body-->
                    <div x-show="!accessToken">
                        <div class="mb-2 md:mx-2">
                            <label for="name" class="font-bold mb-1 text-gray-700 block select-none">Name</label>
                            <input
                                id="name"
                                type="text"
                                name="name"
                                x-on:keydown.enter="store"
                                x-model="form.name"
                                class="w-full px-3 py-2 rounded-lg shadow-sm focus:outline-none focus:shadow-outline text-black text-lg"
                                placeholder="Enter name..."
                                autocomplete="off"
                                x-ref="tokenName">
                        </div>
                        <!--Footer-->
                        <div class="flex justify-end pt-2">
                            <button
                                @click="store"
                                :disabled="form.name.length < 1"
                                class="modal-close bg-indigo-500 px-4 p-3 rounded-lg text-white"
                                :class="{'opacity-50 cursor-not-allowed': form.name.length < 1,
                                         'hover:bg-indigo-400': form.name.length > 1}"
                            >Create
                            </button>
                        </div>
                    </div>
                    <div x-show="accessToken">
                        <p class="font-mono font-bold text-sm text-teal-600">
                            Here is your new personal access token. This is the only time it will be shown so don't lose it!
                            You may now use this token to make API requests.
                        </p>
                        <button
                            @click="copyToClipboard()"
                            class="font-serif text-gray-700 rounded-lg bg-gray-200 px-2 my-3 border-2 border-black hover:bg-gray-700 hover:text-white"
                            :class="{accessToken}"
                        >Copy to Clipboard</button>
                        <textarea
                            name="accessToken"
                            id="accessToken"
                            readonly="readonly"
                            class="bg-gray-300 w-full"
                            x-text="accessToken"
                            rows="10"
                        ></textarea>
                        <!--Footer-->
                        <div class="flex justify-end pt-2">
                            <button
                                class="modal-close px-4 bg-teal-500 p-3 rounded-lg text-white hover:bg-teal-600"
                                @click="
                                    accessToken = null
                                    $nextTick(()=>$refs.tokenName.focus())
                                "
                            >Create another new Token
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
