@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="my-4">Создание билета</h1>
    
    <!-- Вывод сообщений об ошибках -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
    <!-- Форма для создания билета -->
    <form action="{{ route('admin.tickets.store') }}" method="POST">
        @csrf

        <!-- Поле для расписания -->
        <div class="form-group">
            <label for="schedule_id">Введите ID расписания:</label>
            <input type="text" name="schedule_id" id="schedule_id" class="form-control" placeholder="Например: 1" value="{{ old('schedule_id') }}">
        </div>

        <!-- Поле для места в зале -->
        <div class="form-group">
            <label for="hall_seat_id">Введите ID места в зале:</label>
            <input type="text" name="hall_seat_id" id="hall_seat_id" class="form-control" placeholder="Например: 5" value="{{ old('hall_seat_id') }}">
        </div>

        <!-- Кнопка отправки -->
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Создать билет</button>
        </div>
    </form>
</div>
@endsection
