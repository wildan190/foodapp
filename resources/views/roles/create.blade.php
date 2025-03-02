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

            <h2 class="mb-3">{{ __('Create Role') }}</h2>

            <form action="{{ route('roles.store') }}" method="POST">
                @csrf

                {{-- Input Nama Role --}}
                <div class="mb-3">
                    <label for="name" class="form-label">{{ __('Role Name') }}</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" 
                        class="form-control @error('name') is-invalid @enderror" 
                        placeholder="{{ __('Role Name') }}" required>
                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                {{-- Checkbox Permissions --}}
                <div class="mb-3">
                    <label class="form-label">{{ __('Permissions') }}</label>
                    <div class="row">
                        @foreach($permissions as $permission)
                            <div class="col-md-4 mb-2">
                                <div class="form-check">
                                    <input type="checkbox" name="permissions[]" value="{{ $permission->id }}" 
                                        id="permissions_{{ $permission->id }}" 
                                        class="form-check-input">
                                    <label for="permissions_{{ $permission->id }}" class="form-check-label">
                                        {{ $permission->name }}
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- Tombol Submit dan Cancel --}}
                <div class="d-flex justify-content-between mt-4">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> {{ __('Create') }}
                    </button>
                    <a href="{{ route('roles.index') }}" class="btn btn-secondary">
                        <i class="fas fa-times"></i> {{ __('Cancel') }}
                    </a>
                </div>

            </form>

        </div>
    </div>
</div>
@endsection  {{-- Akhir bagian konten --}}
