@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Список жанров</h1>

        <ul>
            @foreach($genres as $genre)
                <li>{{ $genre->name }}</li>
            @endforeach
        </ul>
    </div>
@endsection
