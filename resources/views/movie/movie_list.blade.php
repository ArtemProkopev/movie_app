@extends('layouts.app')

@section('title', 'Movie List')

@section('content')
    <section class="movie-list">
        @foreach($movies as $movie)
            <article class="movie-item">
                <div class="card">
                    <img src="{{ $movie->image_url }}" class="card-img-top" alt="{{ $movie->title }}">
                    <div class="card-body">
                        <h2 class="card-title">
                            <a href="{{ route('movie.show', ['id' => $movie->id]) }}" 
                               class="text-blue-600 hover:text-blue-800">
                                {{ $movie->title }}
                            </a>
                        </h2>
                        <p class="card-text">{{ Str::limit($movie->description, 100) }}</p>
                    </div>
                </div>
            </article>
        @endforeach
    </section>

    <nav class="pagination">
        {{ $movies->links() }}
    </nav>
@endsection