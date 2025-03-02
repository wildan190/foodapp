@extends('layouts.app')  {{-- Memanggil layout utama --}}

@section('content')  {{-- Mulai bagian konten --}}
<div class="container py-4">
    <div class="card shadow-sm">
        <div class="card-body">

            {{-- Alert sukses --}}
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            {{-- Alert status --}}
            @if (session('status'))
                <div class="alert alert-success mb-4" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            {{-- Judul dan Tombol Create --}}
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h2 class="mb-0">{{ __('Permissions') }}</h2>
                <a href="{{ route('permissions.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Create Permission
                </a>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>{{ __('No.') }}</th>
                            <th>{{ __('Name') }}</th>
                            <th>{{ __('Created At') }}</th>
                            <th>{{ __('Updated At') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($permissions as $permission)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $permission->name }}</td>
                                <td>{{ $permission->created_at->format('d M Y') }}</td>
                                <td>{{ $permission->updated_at->format('d M Y') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            <div class="mt-4 d-flex justify-content-center">
                {!! $permissions->links('pagination::bootstrap-5') !!}
            </div>

        </div>
    </div>
</div>
@endsection  {{-- Akhir bagian konten --}}
