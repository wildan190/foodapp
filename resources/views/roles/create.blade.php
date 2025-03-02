<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create Role') }}
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
                        <h6 class="text-xl font-bold text-gray-800 dark:text-gray-200 p-4">{{ __('Create Role') }}</h6>
                    </div>
                    <div class="p-4">
                        <form action="{{ route('roles.store') }}" method="POST">
                            @csrf

                            <div class="mb-4">
                                <label for="name" class="block text-gray-700 dark:text-gray-300">{{ __('Role Name') }}</label>
                                <input type="text" name="name" id="name" value="{{ old('name') }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:bg-gray-700 dark:text-gray-300 @error('name') border-red-500 @enderror" placeholder="{{ __('Role Name') }}" required>
                                @error('name')
                                    <div class="text-sm text-red-500 mt-1">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label class="block text-gray-700 dark:text-gray-300">{{ __('Permissions') }}</label>
                                <div class="space-y-2">
                                    @foreach($permissions as $permission)
                                        <div class="flex items-center">
                                            <input type="checkbox" name="permissions[]" value="{{ $permission->id }}" id="permissions_{{ $permission->id }}" class="form-checkbox h-5 w-5 text-indigo-500 dark:text-indigo-400">
                                            <label for="permissions_{{ $permission->id }}" class="ml-2 text-gray-600 dark:text-gray-300">{{ $permission->name }}</label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <div class="flex justify-between mt-4">
                                <button type="submit" class="px-6 py-2 bg-indigo-600 text-white rounded-md shadow-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    {{ __('Create') }}
                                </button>
                                <a href="{{ route('roles.index') }}" class="px-6 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                                    {{ __('Cancel') }}
                                </a>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
