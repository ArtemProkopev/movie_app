@extends('layouts.app')

@section('title', $movie->title)

@section('content')
    <section class="movie-detail">
        <div class="max-w-4xl mx-auto bg-white rounded-lg shadow-md overflow-hidden">
            <!-- Отображаем изображение постера -->
            <img src="{{ $movie->image_url }}" alt="{{ $movie->title }}" class="w-full h-96 object-cover">
            
            <div class="p-6">
                <h1 class="text-3xl font-bold mb-4">{{ $movie->title }}</h1>
                
                <div class="grid grid-cols-2 gap-4 mb-6">
                    <div>
                        <p class="text-gray-600">Год выпуска:</p>
                        <p class="font-semibold">{{ $movie->year }}</p>
                    </div>
                    <div>
                        <p class="text-gray-600">Рейтинг:</p>
                        <p class="font-semibold">{{ $movie->rating }}/10</p>
                    </div>
                </div>

                <div class="mb-6">
                    <p class="text-gray-600">Описание:</p>
                    <p class="text-gray-800 leading-relaxed">{{ $movie->description }}</p>
                </div>

                <a href="{{ route('movie.list') }}" 
                   class="inline-block bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">
                    ← Назад к списку фильмов
                </a>
            </div>
        </div>
    </section>
@endsection
