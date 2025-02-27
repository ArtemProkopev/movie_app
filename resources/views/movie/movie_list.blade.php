@extends('layouts.app')
@section('title', 'Movie List')
@section('content')
    <section class="movie-list container mx-auto px-4">
        <div class="grid md:grid-cols-3 sm:grid-cols-2 grid-cols-1 gap-6">
            @foreach($movies as $movie)
                <article class="movie-item">
                    <div class="card bg-white shadow-lg rounded-lg overflow-hidden flex flex-col h-full">
                        <img src="{{ $movie->image_url }}" class="w-full h-64 object-cover" alt="{{ $movie->title }}">
                        <div class="card-body p-4 flex flex-col flex-grow">
                            <h2 class="card-title text-lg font-semibold mb-2">
                                <a href="{{ route('movie.show', ['id' => $movie->id]) }}" 
                                   class="text-blue-600 hover:text-blue-800">
                                    {{ $movie->title }}
                                </a>
                            </h2>
                            <p class="card-text flex-grow">{{ Str::limit($movie->description, 100) }}</p>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>
    </section>

    <nav class="pagination mt-6">
        {{ $movies->links() }}
    </nav>

    <div class="mt-8 text-center">
        <a href="{{ route('admin.dashboard') }}" 
           class="inline-block bg-gray-700 text-white px-6 py-3 rounded-lg hover:bg-gray-800 transition">
            Вернуться на админку
        </a>
    </div>
@endsection
