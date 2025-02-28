@extends('layouts.app')

@section('title', 'Кинотеатр')

@section('content')
    <header class="bg-dark py-3 shadow">
        <div class="container d-flex justify-content-between align-items-center">
            <h1 class="text-warning fw-bold">КиноПоиск</h1>
            <form class="d-flex w-50">
                <input class="form-control me-2" type="search" placeholder="Поиск фильмов..." aria-label="Search">
                <button class="btn btn-outline-warning" type="submit">Найти</button>
            </form>
            <nav>
                <ul class="nav">
                    <li class="nav-item"><a class="nav-link text-light" href="{{ route('movie.list') }}">Фильмы</a></li>
                    <li class="nav-item"><a class="nav-link text-light" href="#">Сеансы</a></li>
                    <li class="nav-item"><a class="nav-link text-light" href="#">О нас</a></li>
                    <li class="nav-item"><a class="nav-link text-light" href="#">Контакты</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <section class="hero">
        <div class="container text-center text-white">
            <h2 class="display-4 fw-bold">Лучшие фильмы, топовые новинки</h2>
            <p class="lead">Откройте для себя самые ожидаемые премьеры и любимые классические фильмы.</p>
            <a href="{{ route('movie.list') }}" class="btn btn-warning btn-lg mt-3">Смотреть фильмы</a>
        </div>
    </section>

    <section class="container mt-5">
        <h3 class="text-white">Популярные фильмы</h3>
        <div class="row g-4">
            @foreach ($movies as $movie)
                <div class="col-md-4 col-sm-6">
                    <div class="card movie-card shadow-lg">
                        <img src="{{ $movie->poster }}" class="card-img-top" alt="{{ $movie->title }}">
                        <div class="card-body">
                            <h5 class="card-title text-dark">{{ $movie->title }}</h5>
                            <p class="card-text text-muted">{{ $movie->year }}</p>
                            <a href="{{ route('movie.show', $movie->id) }}" class="btn btn-warning btn-sm">Подробнее</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
@endsection
