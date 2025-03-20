@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <h2>Добавить билет</h2>
        <form action="{{ route('admin.tickets.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">Расписание</label>
                <input type="number" name="schedule_id" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Место</label>
                <input type="number" name="hall_seat_id" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-success">Добавить</button>
        </form>
    </div>
@endsection
