<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit User') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">

                @if (session('success'))
                    <div class="alert alert-success border-left-success alert-dismissible fade show p-4 mb-4 bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200 border border-green-300 dark:border-green-700 rounded">
                        {{ session('success') }}
                        <button type="button" class="close text-green-600 dark:text-green-400 hover:text-green-800 dark:hover:text-green-200" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                @if (session('status'))
                    <div class="alert alert-success p-4 mb-4 bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200 border border-green-300 dark:border-green-700 rounded">
                        {{ session('status') }}
                    </div>
                @endif

                <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg overflow-hidden">
                    <div class="border-b border-gray-200 dark:border-gray-700">
                        <h6 class="text-xl font-bold text-gray-800 dark:text-gray-200 p-4">{{ __('Edit User') }}</h6>
                    </div>
                    <div class="p-4">
                        <form action="{{ route('users.update', $user->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-4">
                                <label for="name" class="block text-gray-700 dark:text-gray-300 text-sm font-semibold mb-2">{{ __('Name') }}</label>
                                <input type="text" name="name" id="name" value="{{ $user->name }}" class="w-full p-3 rounded-lg border border-gray-300 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:bg-gray-700 dark:text-gray-300" required>
                                @error('name')
                                    <p class="text-red-500 dark:text-red-300 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="email" class="block text-gray-700 dark:text-gray-300 text-sm font-semibold mb-2">{{ __('Email') }}</label>
                                <input type="email" name="email" id="email" value="{{ $user->email }}" class="w-full p-3 rounded-lg border border-gray-300 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:bg-gray-700 dark:text-gray-300" required>
                                @error('email')
                                    <p class="text-red-500 dark:text-red-300 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label class="block text-gray-700 dark:text-gray-300 text-sm font-semibold mb-2">{{ __('Roles') }}</label>
                                @foreach($roles as $role)
                                    <div class="flex items-center mb-2">
                                        <input type="checkbox" name="roles[]" id="role-{{ $role->id }}" value="{{ $role->id }}" 
                                        class="mr-2" {{ $user->roles->contains($role->id) ? 'checked' : '' }} onchange="checkRole(this)">
                                        <label for="role-{{ $role->id }}" class="text-gray-700 dark:text-gray-300">{{ $role->name }}</label>
                                    </div>
                                @endforeach
                            </div>

                            <script>
                                function checkRole(checkbox) {
                                    if($("input[name='roles[]']:checked").length > 1 && checkbox.checked) {
                                        alert("Hanya bisa pilih salah satu");
                                        checkbox.checked = false;
                                    }
                                }
                            </script>

                            <div class="flex justify-between mt-6">
                                <button type="submit" class="bg-indigo-600 text-white py-2 px-4 rounded-lg hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">{{ __('Update') }}</button>
                                <a href="{{ route('users.index') }}" class="bg-gray-500 text-white py-2 px-4 rounded-lg hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-400">{{ __('Cancel') }}</a>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
