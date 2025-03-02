@extends('layouts.app')  {{-- Memanggil layout utama --}}

@section('content')  {{-- Mulai bagian konten --}}
<div class="container py-4">
    <div class="card shadow-sm">
        <div class="card-body">

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if (session('status'))
                <div class="alert alert-success mb-4" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <h2 class="mb-3">Role List</h2>
            <a href="{{ route('roles.create') }}" class="btn btn-primary mb-3">
                <i class="fas fa-plus"></i> Add New Role
            </a>

            <!-- Tabel Desktop -->
            <div class="table-responsive d-none d-md-block">
                <table class="table table-bordered table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>No.</th>
                            <th>Name</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($roles as $role)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $role->name }}</td>
                                <td>{{ $role->created_at->format('d M Y') }}</td>
                                <td>{{ $role->updated_at->format('d M Y') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">No roles found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Tampilan Mobile (List/Card) -->
            <div class="d-md-none">
                @forelse ($roles as $role)
                    <div class="card mb-3 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">{{ $role->name }}</h5>
                            <p class="card-text">
                                <strong>Created At:</strong> {{ $role->created_at->format('d M Y') }} <br>
                                <strong>Updated At:</strong> {{ $role->updated_at->format('d M Y') }}
                            </p>
                        </div>
                    </div>
                @empty
                    <div class="alert alert-info">No roles found.</div>
                @endforelse
            </div>

            <!-- Pagination -->
            <div class="mt-4">
                {!! $roles->links('pagination::bootstrap-5') !!}
            </div>

        </div>
    </div>
</div>
@endsection  {{-- Akhir bagian konten --}}
