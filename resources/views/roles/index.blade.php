<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Roles') }}
            </h2>
            <a href="{{ route('roles.create') }}" class="inline-block bg-indigo-600 text-white py-2 px-4 rounded-md shadow-md hover:bg-indigo-700 focus:ring-4 focus:ring-indigo-500 ml-4 mr-4">
                <span class="mr-2">
                    <i class="fas fa-plus"></i>
                </span>
                <span>{{ __('Create Role') }}</span>
            </a>
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

                <table class="min-w-full bg-white dark:bg-gray-800 shadow-md rounded-lg">
                    <thead>
                        <tr class="bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-200">
                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 dark:text-gray-400">
                                No.
                            </th>
                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 dark:text-gray-400">
                                Name
                            </th>
                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 dark:text-gray-400">
                                Created At
                            </th>
                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 dark:text-gray-400">
                                Updated At
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($roles as $role)
                            <tr class="border-b border-gray-200 dark:border-gray-700">
                                <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-100">{{ $loop->iteration }}</td>
                                <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-100">{{ $role->name }}</td>
                                <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-100">{{ $role->created_at->format('d M Y') }}</td>
                                <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-100">{{ $role->updated_at->format('d M Y') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="mt-4 px-6">
                    {!! $roles->links() !!}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
