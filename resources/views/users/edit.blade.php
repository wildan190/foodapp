@extends('layouts.app')  {{-- Memanggil layout utama --}}

@section('content')  {{-- Mulai bagian konten --}}
<div class="container py-4">

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

    {{-- Card utama --}}
    <div class="card shadow-sm">
        <div class="card-header">
            <h5 class="mb-0">{{ __('Edit User') }}</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('users.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- Input Nama --}}
                <div class="mb-3">
                    <label for="name" class="form-label">{{ __('Name') }}</label>
                    <input type="text" name="name" id="name" value="{{ $user->name }}" class="form-control @error('name') is-invalid @enderror" required>
                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                {{-- Input Email --}}
                <div class="mb-3">
                    <label for="email" class="form-label">{{ __('Email') }}</label>
                    <input type="email" name="email" id="email" value="{{ $user->email }}" class="form-control @error('email') is-invalid @enderror" required>
                    @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                {{-- Input Roles --}}
                <div class="mb-3">
                    <label class="form-label">{{ __('Roles') }}</label>
                    @foreach($roles as $role)
                        <div class="form-check">
                            <input type="checkbox" name="roles[]" id="role-{{ $role->id }}" value="{{ $role->id }}" 
                            class="form-check-input" {{ $user->roles->contains($role->id) ? 'checked' : '' }} onchange="checkRole(this)">
                            <label for="role-{{ $role->id }}" class="form-check-label">{{ $role->name }}</label>
                        </div>
                    @endforeach
                </div>

                {{-- Script untuk cek hanya satu role yang bisa dipilih --}}
                <script>
                    function checkRole(checkbox) {
                        const checkedRoles = document.querySelectorAll("input[name='roles[]']:checked");
                        if (checkedRoles.length > 1 && checkbox.checked) {
                            alert("Hanya bisa pilih salah satu");
                            checkbox.checked = false;
                        }
                    }
                </script>

                {{-- Tombol Submit dan Cancel --}}
                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> {{ __('Update') }}
                    </button>
                    <a href="{{ route('users.index') }}" class="btn btn-secondary">
                        <i class="fas fa-times"></i> {{ __('Cancel') }}
                    </a>
                </div>

            </form>
        </div>
    </div>

</div>
@endsection  {{-- Akhir bagian konten --}}
