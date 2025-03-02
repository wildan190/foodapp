<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Users') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">

                @if (session('success'))
                    <div
                        class="alert alert-success p-4 mb-4 bg-green-100 dark:bg-green-800 text-green-800 dark:text-green-200 border border-green-300 dark:border-green-700 rounded">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('status'))
                    <div
                        class="alert alert-success p-4 mb-4 bg-green-100 dark:bg-green-800 text-green-800 dark:text-green-200 border border-green-300 dark:border-green-700 rounded">
                        {{ session('status') }}
                    </div>
                @endif

                <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg overflow-hidden">
                    <div class="border-b border-gray-200 dark:border-gray-700 flex justify-between items-center p-4">
                        <h6 class="text-xl font-bold text-gray-800 dark:text-gray-200">{{ __('Users') }}</h6>
                        @if (Auth::user()->hasRole('Admin'))
                            <a href="{{ route('users.create') }}"
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                {{ __('Create User') }}
                            </a>
                        @elseif (Auth::user()->hasRole('Manager'))
                            <a href="{{ route('users.create') }}"
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                {{ __('Create User') }}
                            </a>
                        @endif

                    </div>
                    <div class="p-4">
                        <div class="overflow-x-auto">
                            <table class="min-w-full bg-white dark:bg-gray-800 shadow-md rounded-lg">
                                <thead>
                                    <tr>
                                        <th
                                            class="px-6 py-3 text-left text-sm font-medium text-gray-500 dark:text-gray-400">
                                            {{ __('No.') }}</th>
                                        <th
                                            class="px-6 py-3 text-left text-sm font-medium text-gray-500 dark:text-gray-400">
                                            {{ __('Name') }}</th>
                                        <th
                                            class="px-6 py-3 text-left text-sm font-medium text-gray-500 dark:text-gray-400">
                                            {{ __('Email') }}</th>
                                        <th
                                            class="px-6 py-3 text-left text-sm font-medium text-gray-500 dark:text-gray-400">
                                            {{ __('Roles') }}</th>
                                        <th
                                            class="px-6 py-3 text-left text-sm font-medium text-gray-500 dark:text-gray-400">
                                            {{ __('Email Verified') }}</th>
                                        <th
                                            class="px-6 py-3 text-left text-sm font-medium text-gray-500 dark:text-gray-400">
                                            {{ __('Created At') }}</th>
                                        <th
                                            class="px-6 py-3 text-left text-sm font-medium text-gray-500 dark:text-gray-400">
                                            {{ __('Updated At') }}</th>
                                        @if (Auth::user()->hasRole('Admin'))
                                            <th
                                                class="px-6 py-3 text-left text-sm font-medium text-gray-500 dark:text-gray-400">
                                                {{ __('Action') }}</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr
                                            class="border-b border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700">
                                            <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-100">
                                                {{ $loop->iteration }}</td>
                                            <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-100">
                                                {{ $user->name }}</td>
                                            <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-100">
                                                {{ $user->email }}</td>
                                            <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-100">
                                                {{ $user->roles->pluck('name')->join(', ') }}
                                            </td>
                                            <td class="px-6 py-4 text-sm">
                                                <span
                                                    class="inline-block px-2 py-1 rounded-full {{ $user->email_verified_at ? 'bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200' : 'bg-red-100 dark:bg-red-900 text-red-800 dark:text-red-200' }}">
                                                    {{ $user->email_verified_at ? 'Verified' : 'Unverified' }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-100">
                                                {{ $user->created_at }}</td>
                                            <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-100">
                                                {{ $user->updated_at }}</td>
                                            @if (Auth::user()->hasRole('Admin'))
                                                <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-100">
                                                    <a href="{{ route('users.edit', $user->id) }}"
                                                        class="text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-200 font-medium">
                                                        {{ __('Edit') }}
                                                    </a>
                                                </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="mt-4">
                    <div class="mx-auto">
                        {!! $users->links() !!}
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
