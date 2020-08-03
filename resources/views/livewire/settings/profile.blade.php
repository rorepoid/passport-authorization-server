<div x-show.transition.in="step === 1">
    <div class="mb-5 text-center">
        <div class="mx-auto w-32 h-32 mb-2 border rounded-full bg-gray-100 mb-4 shadow-inset">
            <img id="image" class="object-cover w-full h-32 rounded-full" src="{{ $avatar }}" alt=""/>
        </div>
        <form enctype="multipart/form-data">
        @csrf
            <label for="fileInput" type="button" class="max-w-sm cursor-pointer inine-flex justify-between items-center focus:outline-none border py-2 px-4 rounded-lg shadow-sm text-left text-gray-600 bg-white hover:bg-gray-100 font-medium">
                <svg xmlns="http://www.w3.org/2000/svg" class="inline-flex flex-shrink-0 w-6 h-6 -mt-1 mr-1" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="0" y="0" width="24" height="24" stroke="none"></rect>
                    <path d="M5 7h1a2 2 0 0 0 2 -2a1 1 0 0 1 1 -1h6a1 1 0 0 1 1 1a2 2 0 0 0 2 2h1a2 2 0 0 1 2 2v9a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-9a2 2 0 0 1 2 -2" />
                    <circle cx="12" cy="13" r="3" />
                </svg>
            <input
                class="cursor-pointer absolute hidden opacity-0 pin-r pin-t"
                name="avatar"
                accept="image/*"
                type="file"
                id="fileInput"
                @change="let file = document.getElementById('fileInput').files[0];
                var reader = new FileReader();
                reader.onload = (e) => image = e.target.result;
                reader.readAsDataURL(file);">
                Browse Photo
            </label>
        </form>
    </div>
    <div class="md:border-gray-600 md:border-2 md:border-r-0 md:border-l-0 md:py-4 px-2">
    <div class="grid md:grid-cols-2">
        <div class="mb-2 md:mx-2">
            <label for="username" class="font-bold mb-1 text-gray-700 block">Username</label>
            <input
                wire:model="username"
                type="text"
                name="username"
                class="w-full px-4 py-3 rounded-lg shadow-sm focus:outline-none focus:shadow-outline text-black text-lg"
                placeholder="Enter your username...">
            @error('username') <span class="text-red-700 font-bold">{{ $message }}</span> @enderror
        </div>
        <div class="mb-2 md:mx-2">
            <label for="name" class="font-bold mb-1 text-gray-700 block">Name</label>
            <input
                type="text"
                value="{{ $name }}"
                class="w-full px-4 py-3 rounded-lg shadow-sm focus:outline-none focus:shadow-outline text-black text-lg"
                placeholder="Enter your name... ">
        </div>

        <div class="mb-2 md:mx-2">
            <label for="email" class="font-bold mb-1 text-gray-700 block">Email</label>
            <input
                type="email"
                wire:model="email"
                class="w-full px-4 py-3 rounded-lg shadow-sm focus:outline-none focus:shadow-outline text-black text-lg"
                placeholder="Enter your email address...">
            @error('email') <span class="text-red-700 font-bold">{{ $message }}</span> @enderror
        </div>

    </div>
    <div class="mt-2 w-full">
        <button class="w-2/4 sm:w-32 bg-green-700 rounded-lg p-2 mx-2 text-white font-bold">Save changes</button>
    </div>
</div>
</div>

<script>
    var photoInput = document.getElementById('fileInput');
    photoInput.addEventListener('input', () => {
        var avatar = photoInput.files[0];
    let formData = new FormData();
        formData.append('avatar', avatar);
        formData.append('_token', '{{ csrf_token() }}');
        axios.post('/api/avatar',
            formData,
            {
                headers: {
                    'Content-Type': 'multipart/form-data',
                    'Accept': 'application/json'
                }
            }
        ).then(response => {
            url = response.data.url;
            livewire.emit('updateAvatar', url);
        })
    });
</script>
