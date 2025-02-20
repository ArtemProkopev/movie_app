@extends('layouts.app')

@section('title', 'Movie List')

@section('content')
    <section class="movie-list">
        @foreach($movies as $movie)
            <article class="movie-item">
                <div class="card">
                    <img src="{{ $movie->image_url }}" class="card-img-top" alt="{{ $movie->title }}">
                    <div class="card-body">
                        <h2 class="card-title">{{ $movie->title }}</h2>
                        <p class="card-text">{{ $movie->description }}</p>
                    </div>
                </div>
            </article>
        @endforeach
    </section>

    <nav class="pagination">
        {{ $movies->links() }}
    </nav>
@endsection
