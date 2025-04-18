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
                <ul class="nav align-items-center">
                    <li class="nav-item"><a class="nav-link text-light" href="{{ route('movie.list') }}">Фильмы</a></li>
                    <li class="nav-item"><a class="nav-link text-light" href="#">Сеансы</a></li>
                    
                    @auth
                    <li class="nav-item dropdown ms-3">
                        <a class="nav-link dropdown-toggle text-light d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown">
                            <span class="me-2">{{ Auth::user()->name }}</span>
                            <i class="bi bi-person-circle"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="{{ route('profile.show') }}"><i class="bi bi-person me-2"></i>Мой профиль</a></li>
                            <li><a class="dropdown-item" href="#"><i class="bi bi-ticket-perforated me-2"></i>Мои билеты</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item"><i class="bi bi-box-arrow-right me-2"></i>Выйти</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                    @else
                    <li class="nav-item ms-3">
                        <div class="d-flex">
                            <a class="btn btn-outline-light me-2" href="{{ route('login') }}">Войти</a>
                            <a class="btn btn-warning" href="{{ route('register') }}">Регистрация</a>
                        </div>
                    </li>
                    @endauth
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
                            <a href="{{ route('movies.show', ['slug' => $movie->slug]) }}" class="btn btn-warning btn-sm">Подробнее</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

        @auth
    <section class="container mt-5 mb-5">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3 class="text-white">Мои последние билеты</h3>
            <a href="{{ route('profile.show') }}" class="btn btn-outline-light">Все билеты</a>
        </div>
        
        @php
            $recentTickets = auth()->user()->tickets()
                ->with(['schedule.movie', 'schedule.hall', 'hallSeat'])
                ->latest()
                ->take(3)
                ->get();
        @endphp

        @if($recentTickets->isEmpty())
            <div class="alert alert-info">
                У вас пока нет купленных билетов. <a href="{{ route('movie.list') }}" class="alert-link">Посмотреть фильмы</a>
            </div>
        @else
            <div class="row g-4">
                @foreach($recentTickets as $ticket)
                    <div class="col-md-4">
                        <div class="card ticket-card h-100 border-warning">
                            <div class="card-body">
                                @if($ticket->schedule && $ticket->schedule->movie)
                                    <h5 class="card-title">{{ $ticket->schedule->movie->title }}</h5>
                                    <p class="card-text">
                                        <i class="bi bi-calendar"></i> {{ $ticket->schedule->getFormattedDate() }}<br>
                                        <i class="bi bi-clock"></i> {{ $ticket->schedule->time_from }}<br>
                                        @if($ticket->schedule->hall)
                                            <i class="bi bi-geo-alt"></i> Зал {{ $ticket->schedule->hall->name }}<br>
                                        @endif
                                        @if($ticket->hallSeat)
                                            <i class="bi bi-ticket-perforated"></i> Ряд {{ $ticket->hallSeat->row }}, Место {{ $ticket->hallSeat->seat }}
                                        @endif
                                    </p>
                                @else
                                    <p class="text-danger">Информация о сеансе недоступна</p>
                                @endif
                            </div>
                            <div class="card-footer bg-transparent">
                                <small class="text-muted">Куплен: {{ $ticket->created_at->format('d.m.Y H:i') }}</small>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </section>
    @endauth

    @push('styles')
    <style>
        .movie-card {
            transition: transform 0.3s ease;
        }
        .movie-card:hover {
            transform: translateY(-5px);
        }
        .ticket-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border-left: 4px solid #ffc107;
        }
        .ticket-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }
        .hero {
            background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url('https://via.placeholder.com/1920x1080') no-repeat center center;
            background-size: cover;
            padding: 100px 0;
            margin-bottom: 50px;
        }
    </style>
    @endpush
@endsection