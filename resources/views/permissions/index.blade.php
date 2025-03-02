<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Permissions') }}
            </h2>
            <a href="{{ route('permissions.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded-md shadow-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 ml-4">
                <span class="mr-2">
                    <i class="fas fa-plus"></i>
                </span>
                <span>{{ __('Create Permission') }}</span>
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

                <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg overflow-hidden">
                    <div class="border-b border-gray-200 dark:border-gray-700">
                        <h6 class="text-xl font-bold text-gray-800 dark:text-gray-200 p-4">{{ __('Permissions') }}</h6>
                    </div>
                    <div class="p-4">
                        <div class="overflow-x-auto">
                            <table class="table-auto w-full text-left border-collapse">
                                <thead>
                                    <tr class="bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-200">
                                        <th class="px-6 py-3 text-left">{{ __('No.') }}</th>
                                        <th class="px-6 py-3 text-left">{{ __('Name') }}</th>
                                        <th class="px-6 py-3 text-left">{{ __('Created At') }}</th>
                                        <th class="px-6 py-3 text-left">{{ __('Updated At') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($permissions as $permission)
                                        <tr class="border-b dark:border-gray-700">
                                            <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-100">{{ $loop->iteration }}</td>
                                            <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-100">{{ $permission->name }}</td>
                                            <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-100">{{ $permission->created_at->format('d M Y') }}</td>
                                            <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-100">{{ $permission->updated_at->format('d M Y') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="mt-4">
                    <div class="mx-auto">
                        {!! $permissions->links() !!}
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
