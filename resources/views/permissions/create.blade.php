<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Create Permission') }}
            </h2>
        </div>
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

                <!-- Create Permission Form -->
                <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg overflow-hidden">
                    <div class="border-b border-gray-200 dark:border-gray-700">
                        <h6 class="text-xl font-bold text-gray-800 dark:text-gray-200 p-4">{{ __('Create Permission') }}</h6>
                    </div>
                    <div class="p-4">
                        <form action="{{ route('permissions.store') }}" method="POST">
                            @csrf

                            <!-- Permission Name Input -->
                            <div class="mb-4">
                                <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-200">{{ __('Permission Name') }}</label>
                                <input type="text" name="name" id="name" value="{{ old('name') }}" placeholder="{{ __('Permission Name') }}" class="mt-1 block w-full px-4 py-2 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 dark:focus:ring-indigo-600 dark:focus:border-indigo-500 @error('name') border-red-500 dark:border-red-500 @enderror" required>
                                @error('name')
                                    <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Submit and Cancel buttons -->
                            <div class="mt-6 flex justify-between">
                                <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-md shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:bg-blue-700 dark:hover:bg-blue-800 dark:focus:ring-blue-600">
                                    {{ __('Create') }}
                                </button>
                                <a href="{{ route('permissions.index') }}" class="px-6 py-2 bg-gray-500 text-white rounded-md shadow-md hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 dark:bg-gray-700 dark:hover:bg-gray-600 dark:focus:ring-gray-500">
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
