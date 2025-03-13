@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Добавить жанр</h1>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('genre.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Название жанра</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Добавить жанр</button>
        </form>
    </div>
@endsection
