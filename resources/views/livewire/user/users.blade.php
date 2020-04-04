<div class="bg-gray-800">
    <div class="">
        <table class="table-auto text-white font-bold">
        <thead>
            <tr>
            <th class="px-4 py-2">User</th>
            <th class="px-4 py-2">email</th>
            <th class="px-4 py-2">Options</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td class="border px-4 py-2">{{ $user->name }}</td>
                    <td class="border px-4 py-2">{{ $user->email }}</td>
                    <td class="border px-4 py-2"></td>
                </tr>
            @endforeach
        </tbody>
        </table>
    </div>
</div>
