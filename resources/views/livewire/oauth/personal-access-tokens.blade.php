<div class="flex justify-center w-screen"
    x-data="personalAccessTokens()"
    x-init="getTokens"
>
    <div class="w-full sm:max-w-lg lg:w-1/2 p-3">
        <div class="bg-blue-700 p-3 rounded-t-md">
            <div>
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
            <p x-show="hasResponse && tokens.length === 0">
                You have not created any personal access tokens.
            </p>

            <!-- Personal Access Tokens -->
            <table class="w-full" x-show="tokens.length > 0 && hasResponse">
                <thead>
                <tr>
                    <th class="px-4 py-2">Name</th>
                    <th class="px-4 py-2">Action</th>
                </tr>
                </thead>

                <tbody>
                <template x-for="(token, index) in tokens" :key="index">
                    <tr class="bg-gray-400 border-8 border-gray-600">
                        <!-- Client Name -->
                        <td class="text-lg px-4 py-2" x-text="token.name">
                        </td>

                        <!-- Delete Button -->
                        <td class="px-4 py-2">
                            <button class="bg-red-700 rounded px-3 text-white" @click="revoke(token)">
                                Delete
                            </button>
                        </td>
                    </tr>
                </template>

                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    function personalAccessTokens() {
        return {
            accessToken: null,

            tokens: [],
            scopes: [],

            form: {
                name: '',
                scopes: [],
                errors: []
            },

            showFormModal: false,
            hasResponse:false,

            getTokens() {
                axios.get('/oauth/personal-access-tokens')
                    .then(response => {
                        this.tokens = response.data;
                        this.hasResponse = true;
                    });
            },
            revoke(token) {
                axios.delete('/oauth/personal-access-tokens/' + token.id)
                    .then(response => {
                        this.getTokens();
                    });
            },
            open() {
                this.showFormModal = true
            },
            close() {
                this.showFormModal = false;
                this.accessToken = null;
            },
            isOpen() {
                return this.showFormModal === true
            },
            store() {
                if (! this.isValidForm() ) {
                    return;
                }

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
            showAccessToken(accessToken) {
                this.accessToken = accessToken;
            },
            copyToClipboard() {
                document.querySelector('#accessToken').select();
                document.execCommand("copy")
            },
            isValidForm() {
                return this.form.name.length > 1;
            }
        }
    }
</script>

@push('metas')
    {{-- This element is to prevent cache in this component --}}
    <meta name="turbolinks-cache-control" content="no-cache">
@endpush
