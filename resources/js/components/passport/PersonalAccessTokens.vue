<style scoped>
    .action-link {
        cursor: pointer;
    }
</style>

<template>
    <div>
        <div>
            <div class="lg:w-1/2">
                <div class="bg-blue-700 p-3 rounded-t-md">
                    <div >
                        <div class="grid sm:grid-cols-2">
                            <div class="col-span-1 flex flex-row">
                                <span class="text-white text-xl w-full sm:w-auto text-center font-bold">
                                    Personal Access Tokens
                                </span>
                            </div>
                            <div class="col-span-1 flex sm:flex-row-reverse">
                                <button
                                class="flex-row-reverse w-full sm:w-auto text-white bg-green-700 p-2 rounded-md border-black"
                                tabindex="-1"
                                @click="showCreateTokenForm">
                                    Create New Token
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-gray-300 p-3 rounded-b-md">
                    <!-- No Tokens Notice -->
                    <p v-if="tokens.length === 0">
                        You have not created any personal access tokens.
                    </p>

                    <!-- Personal Access Tokens -->
                    <table class="w-full" v-if="tokens.length > 0">
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
                                    {{ token.name }}
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

        <!-- Access Token Modal -->
        <div :class="!showModal ? ['opacity-0', 'pointer-events-none', 'modal-active'] : ''" class="my-modal fixed w-full h-full top-0 left-0 flex items-center justify-center">
            <div class="modal-overlay absolute w-full h-full bg-gray-900 opacity-50"></div>

            <div class="modal-container bg-white w-11/12 md:max-w-md mx-auto rounded shadow-lg z-50 overflow-y-auto">

                <div class="modal-close absolute top-0 right-0 cursor-pointer flex flex-col items-center mt-4 mr-4 text-white text-sm z-50">
                    <svg class="fill-current text-white" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
                    <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
                    </svg>
                    <span class="text-sm">(Esc)</span>
                </div>

                <!-- Add margin if you want to see some of the overlay behind the modal-->
                <div class="modal-content py-4 text-left px-6">
                    <!--Title-->
                    <div class="flex justify-between items-center pb-3">
                    <p class="text-2xl font-bold">Create Token!</p>
                    <div class="modal-close cursor-pointer z-50">
                        <svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
                        <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
                        </svg>
                    </div>
                    </div>

                    <!--Body-->
                    <div class="modal fade" id="modal-create-token" tabindex="-1" role="dialog">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <!-- Form Errors -->
                                    <div class="alert alert-danger" v-if="form.errors.length > 0">
                                        <p class="mb-0"><strong>Whoops!</strong> Something went wrong!</p>
                                        <br>
                                        <ul>
                                            <li v-for="error in form.errors">
                                                {{ error }}
                                            </li>
                                        </ul>
                                    </div>

                                    <!-- Create Token Form -->
                                    <form role="form" @submit.prevent="store">
                                        <!-- Name -->
                                        <div class="form-group row">
                                            <label class="col-md-4 col-form-label">Name</label>

                                            <div class="col-md-6">
                                                <input id="create-token-name" type="text" class="form-control" name="name" v-model="form.name">
                                            </div>
                                        </div>

                                        <!-- Scopes -->
                                        <div class="form-group row" v-if="scopes.length > 0">
                                            <label class="col-md-4 col-form-label">Scopes</label>

                                            <div class="col-md-6">
                                                <div v-for="scope in scopes">
                                                    <div class="checkbox">
                                                        <label>
                                                            <input type="checkbox"
                                                                @click="toggleScope(scope.id)"
                                                                :checked="scopeIsAssigned(scope.id)">

                                                                {{ scope.id }}
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <!-- Modal Actions -->
                                <div class="modal-footer">
                                    <button type="button" class="bg-blue-600 rounded-lg px-3 p-y-2 text-white font-bold" @click="store">
                                        Create
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <p>
                        Here is your new personal access token. This is the only time it will be shown so don't lose it!
                        You may now use this token to make API requests.
                    </p>
                    <textarea class="form-control" rows="10">{{ accessToken }}</textarea>

                    <!--Footer-->
                    <div class="flex justify-end pt-2">
                        <button class="px-4 bg-transparent p-3 rounded-lg text-indigo-500 hover:bg-gray-100 hover:text-indigo-400 mr-2">Action</button>
                        <button class="modal-close px-4 bg-indigo-500 p-3 rounded-lg text-white hover:bg-indigo-400" @click="hideCreateTokenForm">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        /*
         * The component's data.
         */
        data() {
            return {
                accessToken: null,

                tokens: [],
                scopes: [],

                form: {
                    name: '',
                    scopes: [],
                    errors: []
                },
                showModal: false
            };
        },

        /**
         * Prepare the component (Vue 1.x).
         */
        ready() {
            this.prepareComponent();
        },

        /**
         * Prepare the component (Vue 2.x).
         */
        mounted() {
            this.prepareComponent();
        },

        methods: {
            /**
             * Prepare the component.
             */
            prepareComponent() {
                this.getTokens();
                this.getScopes();

                $('#modal-create-token').on('shown.bs.modal', () => {
                    $('#create-token-name').focus();
                });
            },

            /**
             * Get all of the personal access tokens for the user.
             */
            getTokens() {
                axios.get('/oauth/personal-access-tokens')
                        .then(response => {
                            this.tokens = response.data;
                        });
            },

            /**
             * Get all of the available scopes.
             */
            getScopes() {
                axios.get('/oauth/scopes')
                        .then(response => {
                            this.scopes = response.data;
                        });
            },

            /**
             * Show the form for creating new tokens.
             */
            showCreateTokenForm() {
                this.showModal = true;
            },

            /**
             * Hide the form for creating new tokens.
             */
            hideCreateTokenForm() {
                this.showModal = false;
            },

            /**
             * Create a new personal access token.
             */
            store() {
                this.accessToken = null;

                this.form.errors = [];

                axios.post('/oauth/personal-access-tokens', this.form)
                        .then(response => {
                            this.form.name = '';
                            this.form.scopes = [];
                            this.form.errors = [];

                            this.tokens.push(response.data.token);

                            this.showAccessToken(response.data.accessToken);
                        })
                        .catch(error => {
                            if (typeof error.response.data === 'object') {
                                this.form.errors = _.flatten(_.toArray(error.response.data.errors));
                            } else {
                                this.form.errors = ['Something went wrong. Please try again.'];
                            }
                        });
            },

            /**
             * Toggle the given scope in the list of assigned scopes.
             */
            toggleScope(scope) {
                if (this.scopeIsAssigned(scope)) {
                    this.form.scopes = _.reject(this.form.scopes, s => s == scope);
                } else {
                    this.form.scopes.push(scope);
                }
            },

            /**
             * Determine if the given scope has been assigned to the token.
             */
            scopeIsAssigned(scope) {
                return _.indexOf(this.form.scopes, scope) >= 0;
            },

            /**
             * Show the given access token to the user.
             */
            showAccessToken(accessToken) {
                $('#modal-create-token').modal('hide');

                this.accessToken = accessToken;

                $('#modal-access-token').modal('show');
            },

            /**
             * Revoke the given token.
             */
            revoke(token) {
                axios.delete('/oauth/personal-access-tokens/' + token.id)
                        .then(response => {
                            this.getTokens();
                        });
            }
        }
    }
</script>
