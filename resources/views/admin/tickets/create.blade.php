@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="my-4">Создание билета</h1>
    
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
    <form action="{{ route('admin.tickets.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="schedule_id">Введите ID расписания:</label>
            <input type="text" name="schedule_id" id="schedule_id" class="form-control" placeholder="Например: 1" value="{{ old('schedule_id') }}">
        </div>

        <div class="form-group">
            <label for="hall_seat_id">Введите ID места в зале:</label>
            <input type="text" name="hall_seat_id" id="hall_seat_id" class="form-control" placeholder="Например: 5" value="{{ old('hall_seat_id') }}">
        </div>

        <div class="form-group">
            <label for="category">Выберите категорию:</label>
            <select name="category" id="category" class="form-control">
                <option value="standard">Стандарт</option>
                <option value="premium">Премиум</option>
                <option value="vip">VIP</option>
            </select>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">Создать билет</button>
        </div>
    </form>
</div>
@endsection
