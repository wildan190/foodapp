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

            {{-- Judul Halaman --}}
            <h2 class="mb-4">{{ __('Create Permission') }}</h2>

            {{-- Form Create Permission --}}
            <form action="{{ route('permissions.store') }}" method="POST">
                @csrf

                {{-- Input Nama Permission --}}
                <div class="mb-3">
                    <label for="name" class="form-label">{{ __('Permission Name') }}</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" placeholder="{{ __('Permission Name') }}" class="form-control @error('name') is-invalid @enderror" required>
                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                {{-- Tombol Submit dan Cancel --}}
                <div class="d-flex justify-content-between mt-4">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> {{ __('Create') }}
                    </button>
                    <a href="{{ route('permissions.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> {{ __('Cancel') }}
                    </a>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection  {{-- Akhir bagian konten --}}
