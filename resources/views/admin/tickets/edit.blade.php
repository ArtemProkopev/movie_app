@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <h2>Редактировать билет</h2>
        <form action="{{ route('admin.tickets.update', $ticket) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label class="form-label">Расписание</label>
                <select name="schedule_id" class="form-control" required>
                    @foreach($schedules as $schedule)
                        <option value="{{ $schedule->id }}" {{ $ticket->schedule_id == $schedule->id ? 'selected' : '' }}>
                            {{ $schedule->id }} (другие данные расписания)
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Место</label>
                <select name="hall_seat_id" class="form-control" required>
                    @foreach($hallSeats as $hallSeat)
                        <option value="{{ $hallSeat->id }}" {{ $ticket->hall_seat_id == $hallSeat->id ? 'selected' : '' }}>
                            {{ $hallSeat->id }} (другие данные места)
                        </option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Обновить</button>
        </form>
    </div>
@endsection