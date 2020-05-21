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
                }
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
