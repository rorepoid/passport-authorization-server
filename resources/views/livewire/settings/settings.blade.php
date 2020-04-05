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
                <div x-show.transition.in="step === 1">
						<div class="mb-5 text-center">
							<div class="mx-auto w-32 h-32 mb-2 border rounded-full bg-gray-100 mb-4 shadow-inset">
								<img id="image" class="object-cover w-full h-32 rounded-full" src="{{ $photo_src }}" alt=""/>
							</div>
							<form enctype="multipart/form-data" wire:submit.prevent="uploadPhoto">
                            @csrf
                                <label for="fileInput" type="button" class="max-w-sm cursor-pointer inine-flex justify-between items-center focus:outline-none border py-2 px-4 rounded-lg shadow-sm text-left text-gray-600 bg-white hover:bg-gray-100 font-medium">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="inline-flex flex-shrink-0 w-6 h-6 -mt-1 mr-1" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <rect x="0" y="0" width="24" height="24" stroke="none"></rect>
                                        <path d="M5 7h1a2 2 0 0 0 2 -2a1 1 0 0 1 1 -1h6a1 1 0 0 1 1 1a2 2 0 0 0 2 2h1a2 2 0 0 1 2 2v9a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-9a2 2 0 0 1 2 -2" />
                                        <circle cx="12" cy="13" r="3" />
                                    </svg>
                                <input
                                    class="cursor-pointer absolute block opacity-0 pin-r pin-t"
                                    name="photo"
                                    accept="image/*"
                                    type="file"
                                    id="fileInput"
                                    @change="let file = document.getElementById('fileInput').files[0];
                                    var reader = new FileReader();
                                    reader.onload = (e) => image = e.target.result;
                                    reader.readAsDataURL(file);">
                                    Browse Photo
                                </label>

                                <div class="mx-auto w-48 text-xs text-center mt-1">
                                    <button type="submit">Save Contact</button>
                                </div>
                            </form>
						</div>

						<div class="mb-5">
							<label for="firstname" class="font-bold mb-1 text-gray-700 block">Firstname</label>
							<input
                                type="text"
								class="w-full px-4 py-3 rounded-lg shadow-sm focus:outline-none focus:shadow-outline text-gray-600 font-medium"
								placeholder="Enter your firstname...">
						</div>

						<div class="mb-5">
							<label for="email" class="font-bold mb-1 text-gray-700 block">Email</label>
							<input type="email"
								class="w-full px-4 py-3 rounded-lg shadow-sm focus:outline-none focus:shadow-outline text-gray-600 font-medium"
								placeholder="Enter your email address...">
						</div>

					</div>
                </div>
            </div>
        </div>
    </div>
    <script>
        var photoInput = document.getElementById('fileInput');
        photoInput.addEventListener('input', () => {
            var file = photoInput.files[0];
        let formData = new FormData();
            formData.append('file', file);
            formData.append('_token', '{{ csrf_token() }}');
            axios.post('/api/uploadPhoto',
                formData,
                {
                    headers: {
                        'Content-Type': 'multipart/form-data',
                        'Accept': 'application/json'
                    }
                }
            ).then(response => {
                url = response.data.url;
                console.log(url);
                livewire.emit('updatePhoto', url);
            })
        });
    </script>

</div>
